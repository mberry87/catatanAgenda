<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class ChatController extends Controller
{
    private function ensureChatAccess(): void
    {
        abort_unless(Auth::user() && Auth::user()->hasPermission('chat.access'), 403, 'Anda tidak memiliki hak akses fitur chat.');
    }

    private function formatUser(User $user, int $authId): array
    {
        $unreadCount = ChatMessage::where('sender_id', $user->id)
            ->where('receiver_id', $authId)
            ->whereNull('read_at')
            ->where('deleted_by_receiver', false)
            ->count();

        $lastMessage = ChatMessage::where(function ($q) use ($authId, $user) {
            $q->where('sender_id', $authId)
                ->where('receiver_id', $user->id)
                ->where('deleted_by_sender', false);
        })->orWhere(function ($q) use ($authId, $user) {
            $q->where('sender_id', $user->id)
                ->where('receiver_id', $authId)
                ->where('deleted_by_receiver', false);
        })->latest('id')->first();

        $avatar = $user->photo_profil
            ? asset('storage/photo_profil/' . $user->photo_profil)
            : asset('template/dist/img/avatar5.png');

        $isTyping = Cache::has("chat_typing_{$user->id}_to_{$authId}");

        return [
            'id'                => $user->id,
            'name'              => $user->name,
            'role'              => ucfirst($user->role),
            'avatar'            => $avatar,
            'is_online'         => $user->isOnline(),
            'status_text'       => $isTyping ? 'sedang mengetik...' : $user->lastSeenText(),
            'is_typing'         => $isTyping,
            'unread_count'      => $unreadCount,
            'last_message'      => $lastMessage
                ? ($lastMessage->message ?: ('📎 ' . $lastMessage->attachment_name))
                : 'Belum ada pesan',
            'last_message_time' => $lastMessage ? $lastMessage->created_at->format('H:i') : '',
            'last_message_at'   => $lastMessage ? $lastMessage->created_at->timestamp : 0,
        ];
    }

    private function formatMessage(ChatMessage $msg, int $authId): array
    {
        return [
            'id'              => $msg->id,
            'sender_id'       => $msg->sender_id,
            'is_mine'         => $msg->sender_id === $authId,
            'message'         => $msg->message,
            'has_attachment'  => (bool) $msg->attachment_path,
            'attachment_url'  => $msg->attachment_path ? route('chat.attachment', $msg->id) : null,
            'attachment_name' => $msg->attachment_name,
            'attachment_mime' => $msg->attachment_mime,
            'attachment_size' => $msg->attachment_size ? $this->humanFileSize($msg->attachment_size) : null,
            'is_image'        => $msg->isImage(),
            'is_read'         => $msg->read_at !== null,
            'time'            => $msg->created_at->format('H:i'),
            'date_label'      => $msg->created_at->isToday()
                ? 'Hari Ini'
                : ($msg->created_at->isYesterday() ? 'Kemarin' : $msg->created_at->format('d M Y')),
        ];
    }

    private function humanFileSize(int $bytes): string
    {
        if ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2) . ' MB';
        }
        if ($bytes >= 1024) {
            return number_format($bytes / 1024, 1) . ' KB';
        }
        return $bytes . ' B';
    }

    public function index()
    {
        $this->ensureChatAccess();

        $authUser = Auth::user();
        $authId = $authUser->id;
        $contacts = User::where('id', '!=', $authId)
            ->orderBy('name')
            ->get()
            ->map(fn (User $u) => $this->formatUser($u, $authId))
            ->sortByDesc('last_message_at')
            ->values();

        $canDeleteMessage = $authUser->hasPermission('chat.delete_message');
        $canClearConversation = $authUser->hasPermission('chat.clear_conversation');

        return view('backend.chat.index', compact('contacts', 'canDeleteMessage', 'canClearConversation'));
    }

    public function usersStatus()
    {
        $this->ensureChatAccess();

        $authUser = Auth::user();
        $authUser->timestamps = false;
        $authUser->last_seen_at = now();
        $authUser->save();
        $authUser->timestamps = true;

        $authId = $authUser->id;
        $contacts = User::where('id', '!=', $authId)
            ->orderBy('name')
            ->get()
            ->map(fn (User $u) => $this->formatUser($u, $authId))
            ->sortByDesc('last_message_at')
            ->values();

        return response()->json(['contacts' => $contacts]);
    }

    public function messages(User $user)
    {
        $this->ensureChatAccess();

        $authUser = Auth::user();
        $authId = $authUser->id;

        if ($user->id === $authId) {
            return response()->json(['error' => 'Tidak dapat chat dengan diri sendiri.'], 422);
        }

        // Update online status
        $authUser->timestamps = false;
        $authUser->last_seen_at = now();
        $authUser->save();
        $authUser->timestamps = true;

        // Tandai semua pesan dari lawan bicara sebagai sudah dibaca (centang 2)
        ChatMessage::where('sender_id', $user->id)
            ->where('receiver_id', $authId)
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        $messages = ChatMessage::where(function ($q) use ($authId, $user) {
            $q->where('sender_id', $authId)
                ->where('receiver_id', $user->id)
                ->where('deleted_by_sender', false);
        })->orWhere(function ($q) use ($authId, $user) {
            $q->where('sender_id', $user->id)
                ->where('receiver_id', $authId)
                ->where('deleted_by_receiver', false);
        })->orderBy('id')->get()->map(fn (ChatMessage $m) => $this->formatMessage($m, $authId));

        $isTyping = Cache::has("chat_typing_{$user->id}_to_{$authId}");

        return response()->json([
            'user' => [
                'id'          => $user->id,
                'name'        => $user->name,
                'role'        => ucfirst($user->role),
                'avatar'      => $user->photo_profil
                    ? asset('storage/photo_profil/' . $user->photo_profil)
                    : asset('template/dist/img/avatar5.png'),
                'is_online'   => $user->isOnline(),
                'is_typing'   => $isTyping,
                'status_text' => $isTyping ? 'sedang mengetik...' : $user->lastSeenText(),
            ],
            'messages' => $messages,
        ]);
    }

    public function send(Request $request, User $user)
    {
        $this->ensureChatAccess();

        $authId = Auth::id();
        if ($user->id === $authId) {
            return response()->json(['error' => 'Tidak dapat mengirim pesan ke diri sendiri.'], 422);
        }

        $request->validate([
            'message'    => 'nullable|string|max:5000',
            'attachment' => 'nullable|file|max:10240',
        ]);

        if (!filled($request->message) && !$request->hasFile('attachment')) {
            return response()->json(['error' => 'Pesan atau lampiran tidak boleh kosong.'], 422);
        }

        $attachmentData = [
            'attachment_path' => null,
            'attachment_name' => null,
            'attachment_mime' => null,
            'attachment_size' => null,
        ];

        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $path = $file->store('chat_attachments', 'public');
            $attachmentData = [
                'attachment_path' => $path,
                'attachment_name' => $file->getClientOriginalName(),
                'attachment_mime' => $file->getClientMimeType(),
                'attachment_size' => $file->getSize(),
            ];
        }

        Cache::forget("chat_typing_{$authId}_to_{$user->id}");

        $chatMessage = ChatMessage::create(array_merge([
            'sender_id'   => $authId,
            'receiver_id' => $user->id,
            'message'     => $request->message,
        ], $attachmentData));

        return response()->json([
            'message' => $this->formatMessage($chatMessage, $authId),
        ]);
    }

    public function typing(Request $request, User $user)
    {
        $this->ensureChatAccess();

        $authId = Auth::id();
        $key = "chat_typing_{$authId}_to_{$user->id}";

        if ($request->boolean('is_typing', true)) {
            Cache::put($key, true, now()->addSeconds(4));
        } else {
            Cache::forget($key);
        }

        return response()->json(['ok' => true]);
    }

    public function destroyMessage(ChatMessage $chatMessage)
    {
        $this->ensureChatAccess();
        abort_unless(Auth::user()->hasPermission('chat.delete_message'), 403, 'Anda tidak memiliki hak akses untuk menghapus pesan.');

        $authId = Auth::id();

        if ($chatMessage->sender_id !== $authId && $chatMessage->receiver_id !== $authId) {
            abort(403);
        }

        // Hapus permanen sehingga terhapus juga di sisi user lain
        if ($chatMessage->attachment_path && Storage::disk('public')->exists($chatMessage->attachment_path)) {
            Storage::disk('public')->delete($chatMessage->attachment_path);
        }
        $chatMessage->delete();

        return response()->json(['ok' => true]);
    }

    public function clearConversation(User $user)
    {
        $this->ensureChatAccess();
        abort_unless(Auth::user()->hasPermission('chat.clear_conversation'), 403, 'Anda tidak memiliki hak akses untuk menghapus seluruh pesan.');

        $authId = Auth::id();

        $messages = ChatMessage::where(function ($q) use ($authId, $user) {
            $q->where('sender_id', $authId)->where('receiver_id', $user->id);
        })->orWhere(function ($q) use ($authId, $user) {
            $q->where('sender_id', $user->id)->where('receiver_id', $authId);
        })->get();

        foreach ($messages as $msg) {
            if ($msg->attachment_path && Storage::disk('public')->exists($msg->attachment_path)) {
                Storage::disk('public')->delete($msg->attachment_path);
            }
            $msg->delete();
        }

        return response()->json(['ok' => true]);
    }

    public function attachment(ChatMessage $chatMessage)
    {
        $this->ensureChatAccess();

        $authId = Auth::id();
        if ($chatMessage->sender_id !== $authId && $chatMessage->receiver_id !== $authId) {
            abort(403);
        }

        if (!$chatMessage->attachment_path || !Storage::disk('public')->exists($chatMessage->attachment_path)) {
            abort(404);
        }

        $fullPath = Storage::disk('public')->path($chatMessage->attachment_path);

        if ($chatMessage->isImage()) {
            return response()->file($fullPath);
        }

        return response()->download($fullPath, $chatMessage->attachment_name);
    }
}
