@extends('layouts.admin')

@section('title', 'Chat')

@section('breadcrumb')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h4 class="m-0">Chat</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Chat</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-outline card-primary dashboard-card overflow-hidden">
                <div class="row g-0" style="min-height: 580px;">
                    {{-- KOLOM KIRI: DAFTAR KONTAK --}}
                    <div class="col-md-4 col-lg-3 border-end d-flex flex-column bg-light-subtle">
                        <div class="p-3 border-bottom bg-white">
                            <div class="input-group input-group-sm">
                                <span class="input-group-text bg-light"><i class="bi bi-search"></i></span>
                                <input type="text" id="contactSearch" class="form-control" placeholder="Cari pengguna...">
                            </div>
                        </div>

                        <div id="contactsList" class="list-group list-group-flush overflow-auto flex-grow-1" style="max-height: 520px;">
                            @forelse ($contacts as $contact)
                                <button type="button"
                                    class="list-group-item list-group-item-action d-flex align-items-center gap-2 py-2 px-3 contact-item"
                                    data-user-id="{{ $contact['id'] }}"
                                    data-user-name="{{ strtolower($contact['name']) }}">
                                    <div class="position-relative flex-shrink-0">
                                        <img src="{{ $contact['avatar'] }}" alt="{{ $contact['name'] }}"
                                            class="rounded-circle border" style="width: 42px; height: 42px; object-fit: cover;">
                                        <span class="position-absolute bottom-0 end-0 p-1 border border-white rounded-circle contact-online-dot {{ $contact['is_online'] ? 'bg-success' : 'bg-secondary' }}"
                                            style="width: 11px; height: 11px;"></span>
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden text-start">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="fw-semibold text-truncate small text-dark">{{ $contact['name'] }}</span>
                                            <small class="text-muted ms-1 contact-time" style="font-size: 11px;">{{ $contact['last_message_time'] }}</small>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <small class="text-truncate contact-preview {{ $contact['is_typing'] ? 'text-success fw-semibold fst-italic' : 'text-muted' }}"
                                                style="font-size: 12px;">
                                                {{ $contact['is_typing'] ? 'sedang mengetik...' : $contact['last_message'] }}
                                            </small>
                                            <span class="badge rounded-pill bg-danger ms-1 contact-unread {{ $contact['unread_count'] > 0 ? '' : 'd-none' }}">
                                                {{ $contact['unread_count'] }}
                                            </span>
                                        </div>
                                    </div>
                                </button>
                            @empty
                                <div class="text-center text-muted py-5 small">
                                    <i class="bi bi-people fs-2 d-block mb-2"></i>
                                    Belum ada pengguna lain.
                                </div>
                            @endforelse
                        </div>
                    </div>

                    {{-- KOLOM KANAN: AREA CHAT --}}
                    <div class="col-md-8 col-lg-9 d-flex flex-column bg-white">
                        {{-- Empty State --}}
                        <div id="chatEmptyState" class="d-flex flex-column align-items-center justify-content-center flex-grow-1 text-muted p-4">
                            <i class="bi bi-chat-square-text fs-1 text-primary mb-3"></i>
                            <h5 class="fw-semibold text-dark">Mulai Percakapan</h5>
                            <p class="small text-center mb-0" style="max-width: 340px;">
                                Pilih pengguna di sebelah kiri untuk mengirim pesan, lampiran, atau emoji. Pesan tetap tersimpan meskipun penerima sedang offline.
                            </p>
                        </div>

                        {{-- Active Chat Pane --}}
                        <div id="chatActivePane" class="d-none flex-column flex-grow-1 h-100">
                            {{-- Header --}}
                            <div class="p-3 border-bottom d-flex justify-content-between align-items-center bg-white">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="position-relative">
                                        <img id="activeUserAvatar" src="{{ asset('template/dist/img/avatar5.png') }}"
                                            class="rounded-circle border" style="width: 40px; height: 40px; object-fit: cover;" alt="Avatar">
                                        <span id="activeUserDot" class="position-absolute bottom-0 end-0 p-1 border border-white rounded-circle bg-secondary"
                                            style="width: 10px; height: 10px;"></span>
                                    </div>
                                    <div>
                                        <div id="activeUserName" class="fw-bold text-dark lh-sm">Nama Pengguna</div>
                                        <small id="activeUserStatus" class="text-muted">Offline</small>
                                    </div>
                                </div>

                                @if ($canClearConversation)
                                    <button type="button" id="clearChatBtn" class="btn btn-outline-danger btn-sm">
                                        <i class="bi bi-trash me-1"></i> Hapus Semua Pesan
                                    </button>
                                @endif
                            </div>

                            {{-- Messages Container --}}
                            <div id="chatMessagesBox" class="flex-grow-1 p-3 overflow-auto bg-body-tertiary" style="height: 410px; max-height: 440px;">
                                {{-- Messages rendered via JS --}}
                            </div>

                            {{-- Typing Indicator Bar --}}
                            <div id="typingIndicatorBar" class="px-3 py-1 bg-body-tertiary small text-success fst-italic d-none">
                                <i class="bi bi-three-dots me-1"></i> <span id="typingUserName">Pengguna</span> sedang mengetik...
                            </div>

                            {{-- Attachment Preview --}}
                            <div id="attachmentPreviewBar" class="px-3 py-2 border-top bg-light d-none justify-content-between align-items-center">
                                <div class="small text-truncate">
                                    <i class="bi bi-paperclip me-1 text-primary"></i>
                                    <span id="attachmentPreviewName" class="fw-semibold"></span>
                                </div>
                                <button type="button" id="removeAttachmentBtn" class="btn btn-sm btn-link text-danger p-0 ms-2">
                                    <i class="bi bi-x-circle-fill"></i>
                                </button>
                            </div>

                            {{-- Emoji Picker Popover --}}
                            <div id="emojiPickerBox" class="p-2 border-top bg-white d-none" style="max-height: 140px; overflow-y: auto;">
                                <div class="d-flex flex-wrap gap-1" id="emojiGrid"></div>
                            </div>

                            {{-- Input Form --}}
                            <form id="chatSendForm" class="p-3 border-top bg-white">
                                <div class="input-group">
                                    <button type="button" id="toggleEmojiBtn" class="btn btn-outline-secondary" title="Emoji">
                                        <i class="bi bi-emoji-smile"></i>
                                    </button>
                                    <button type="button" id="attachFileBtn" class="btn btn-outline-secondary" title="Lampirkan File">
                                        <i class="bi bi-paperclip"></i>
                                    </button>
                                    <input type="file" id="chatAttachmentInput" class="d-none">
                                    <input type="text" id="chatMessageInput" class="form-control"
                                        placeholder="Tulis pesan..." autocomplete="off">
                                    <button type="submit" id="sendMessageBtn" class="btn btn-primary px-3">
                                        <i class="bi bi-send-fill"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const emojis = [
        '😀','😁','😂','🤣','😊','😍','😘','😎','🤔','😅',
        '😭','😡','👍','👎','🙏','👏','🤝','🎉','🔥','❤️',
        '✅','❌','⏰','📅','📌','📎','📄','📁','💼','👋'
    ];

    const contactsList = document.getElementById('contactsList');
    const contactSearch = document.getElementById('contactSearch');
    const chatEmptyState = document.getElementById('chatEmptyState');
    const chatActivePane = document.getElementById('chatActivePane');
    const activeUserAvatar = document.getElementById('activeUserAvatar');
    const activeUserDot = document.getElementById('activeUserDot');
    const activeUserName = document.getElementById('activeUserName');
    const activeUserStatus = document.getElementById('activeUserStatus');
    const chatMessagesBox = document.getElementById('chatMessagesBox');
    const typingIndicatorBar = document.getElementById('typingIndicatorBar');
    const typingUserName = document.getElementById('typingUserName');
    const chatSendForm = document.getElementById('chatSendForm');
    const chatMessageInput = document.getElementById('chatMessageInput');
    const chatAttachmentInput = document.getElementById('chatAttachmentInput');
    const attachFileBtn = document.getElementById('attachFileBtn');
    const attachmentPreviewBar = document.getElementById('attachmentPreviewBar');
    const attachmentPreviewName = document.getElementById('attachmentPreviewName');
    const removeAttachmentBtn = document.getElementById('removeAttachmentBtn');
    const toggleEmojiBtn = document.getElementById('toggleEmojiBtn');
    const emojiPickerBox = document.getElementById('emojiPickerBox');
    const emojiGrid = document.getElementById('emojiGrid');
    const clearChatBtn = document.getElementById('clearChatBtn');
    const canDeleteMessage = @json($canDeleteMessage);

    let activeUserId = null;
    let lastRenderedHash = '';
    let lastTypingSentAt = 0;

    // Populate Emoji Grid
    emojis.forEach(emoji => {
        const btn = document.createElement('button');
        btn.type = 'button';
        btn.className = 'btn btn-sm btn-light border-0 fs-5 p-1';
        btn.textContent = emoji;
        btn.addEventListener('click', function () {
            const start = chatMessageInput.selectionStart || chatMessageInput.value.length;
            const end = chatMessageInput.selectionEnd || chatMessageInput.value.length;
            const text = chatMessageInput.value;
            chatMessageInput.value = text.slice(0, start) + emoji + text.slice(end);
            chatMessageInput.focus();
            chatMessageInput.setSelectionRange(start + emoji.length, start + emoji.length);
            sendTypingSignal(true);
        });
        emojiGrid.appendChild(btn);
    });

    toggleEmojiBtn.addEventListener('click', function () {
        emojiPickerBox.classList.toggle('d-none');
    });

    attachFileBtn.addEventListener('click', function () {
        chatAttachmentInput.click();
    });

    chatAttachmentInput.addEventListener('change', function () {
        if (this.files && this.files[0]) {
            attachmentPreviewName.textContent = this.files[0].name;
            attachmentPreviewBar.classList.remove('d-none');
            attachmentPreviewBar.classList.add('d-flex');
        }
    });

    removeAttachmentBtn.addEventListener('click', function () {
        chatAttachmentInput.value = '';
        attachmentPreviewBar.classList.add('d-none');
        attachmentPreviewBar.classList.remove('d-flex');
    });

    // Contact Search
    contactSearch.addEventListener('input', function () {
        const q = this.value.trim().toLowerCase();
        document.querySelectorAll('.contact-item').forEach(item => {
            const name = item.getAttribute('data-user-name') || '';
            item.classList.toggle('d-none', q !== '' && !name.includes(q));
        });
    });

    // Select Contact
    function bindContactClicks() {
        document.querySelectorAll('.contact-item').forEach(item => {
            item.addEventListener('click', function () {
                const userId = parseInt(this.getAttribute('data-user-id'), 10);
                selectContact(userId);
            });
        });
    }
    bindContactClicks();

    function selectContact(userId) {
        activeUserId = userId;
        lastRenderedHash = '';
        document.querySelectorAll('.contact-item').forEach(el => {
            el.classList.toggle('active', parseInt(el.getAttribute('data-user-id'), 10) === userId);
        });
        chatEmptyState.classList.add('d-none');
        chatActivePane.classList.remove('d-none');
        chatActivePane.classList.add('d-flex');
        loadMessages(true);
    }

    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }

    function renderMessages(messages, scrollToBottom = false) {
        const hash = JSON.stringify(messages.map(m => [m.id, m.is_read, m.message, m.has_attachment]));
        if (hash === lastRenderedHash && !scrollToBottom) {
            return;
        }
        const wasAtBottom = (chatMessagesBox.scrollHeight - chatMessagesBox.scrollTop - chatMessagesBox.clientHeight) < 80;
        lastRenderedHash = hash;

        if (messages.length === 0) {
            chatMessagesBox.innerHTML = `
                <div class="text-center text-muted small py-5">
                    <i class="bi bi-chat-dots fs-3 d-block mb-2"></i>
                    Belum ada pesan. Mulai obrolan sekarang!
                </div>`;
            return;
        }

        let html = '';
        let currentDate = '';

        messages.forEach(msg => {
            if (msg.date_label !== currentDate) {
                currentDate = msg.date_label;
                html += `<div class="text-center my-2"><span class="badge bg-secondary-subtle text-secondary border">${escapeHtml(currentDate)}</span></div>`;
            }

            const alignClass = msg.is_mine ? 'justify-content-end' : 'justify-content-start';
            const bubbleClass = msg.is_mine ? 'bg-primary text-white' : 'bg-white text-dark border';
            const timeClass = msg.is_mine ? 'text-white-50' : 'text-muted';
            const tickIcon = msg.is_mine
                ? (msg.is_read
                    ? '<i class="bi bi-check-all ms-1 text-info" title="Dibaca"></i>'
                    : '<i class="bi bi-check ms-1" title="Terkirim (Belum dibaca)"></i>')
                : '';

            let attachmentHtml = '';
            if (msg.has_attachment) {
                if (msg.is_image) {
                    attachmentHtml = `
                        <div class="mb-1">
                            <a href="${msg.attachment_url}" target="_blank">
                                <img src="${msg.attachment_url}" alt="${escapeHtml(msg.attachment_name)}"
                                    class="img-fluid rounded border" style="max-height: 200px; object-fit: cover;">
                            </a>
                        </div>`;
                } else {
                    const fileTextClass = msg.is_mine ? 'text-white' : 'text-primary';
                    attachmentHtml = `
                        <div class="mb-1 p-2 rounded ${msg.is_mine ? 'bg-dark bg-opacity-25' : 'bg-light border'}">
                            <a href="${msg.attachment_url}" class="text-decoration-none ${fileTextClass} d-flex align-items-center gap-2 small">
                                <i class="bi bi-file-earmark-arrow-down fs-5"></i>
                                <span class="text-truncate" style="max-width: 190px;">${escapeHtml(msg.attachment_name)}</span>
                                <span class="opacity-75">(${escapeHtml(msg.attachment_size || '')})</span>
                            </a>
                        </div>`;
                }
            }

            const textHtml = msg.message ? `<div class="text-break" style="white-space: pre-wrap;">${escapeHtml(msg.message)}</div>` : '';

            html += `
                <div class="d-flex ${alignClass} mb-2 group-msg">
                    <div class="rounded-3 px-3 py-2 shadow-sm position-relative ${bubbleClass}" style="max-width: 72%;">
                        ${attachmentHtml}
                        ${textHtml}
                        <div class="d-flex align-items-center justify-content-end gap-2 mt-1" style="font-size: 11px;">
                            <span class="${timeClass}">${msg.time}${tickIcon}</span>
                            ${canDeleteMessage ? `
                                <button type="button" class="btn btn-link p-0 ${msg.is_mine ? 'text-white-50' : 'text-muted'} delete-msg-btn"
                                    data-msg-id="${msg.id}" title="Hapus pesan" style="font-size: 11px;">
                                    <i class="bi bi-trash"></i>
                                </button>
                            ` : ''}
                        </div>
                    </div>
                </div>`;
        });

        chatMessagesBox.innerHTML = html;

        if (scrollToBottom || wasAtBottom) {
            chatMessagesBox.scrollTop = chatMessagesBox.scrollHeight;
        }
    }

    async function loadMessages(scrollToBottom = false) {
        if (!activeUserId) return;
        try {
            const res = await fetch(`{{ url('chat/messages') }}/${activeUserId}`, {
                headers: { 'Accept': 'application/json' }
            });
            if (!res.ok) return;
            const data = await res.json();

            activeUserAvatar.src = data.user.avatar;
            activeUserName.textContent = data.user.name;
            activeUserDot.className = `position-absolute bottom-0 end-0 p-1 border border-white rounded-circle ${data.user.is_online ? 'bg-success' : 'bg-secondary'}`;

            if (data.user.is_typing) {
                activeUserStatus.textContent = 'sedang mengetik...';
                activeUserStatus.className = 'text-success fw-semibold fst-italic';
                typingUserName.textContent = data.user.name;
                typingIndicatorBar.classList.remove('d-none');
            } else {
                activeUserStatus.textContent = data.user.status_text;
                activeUserStatus.className = data.user.is_online ? 'text-success fw-semibold' : 'text-muted';
                typingIndicatorBar.classList.add('d-none');
            }

            renderMessages(data.messages, scrollToBottom);
        } catch (e) {
            // silent retry on next poll
        }
    }

    async function refreshContacts() {
        try {
            const res = await fetch(`{{ route('chat.usersStatus') }}`, {
                headers: { 'Accept': 'application/json' }
            });
            if (!res.ok) return;
            const data = await res.json();

            data.contacts.forEach(c => {
                const item = document.querySelector(`.contact-item[data-user-id="${c.id}"]`);
                if (!item) return;

                const dot = item.querySelector('.contact-online-dot');
                if (dot) {
                    dot.className = `position-absolute bottom-0 end-0 p-1 border border-white rounded-circle contact-online-dot ${c.is_online ? 'bg-success' : 'bg-secondary'}`;
                }

                const preview = item.querySelector('.contact-preview');
                if (preview) {
                    preview.textContent = c.is_typing ? 'sedang mengetik...' : c.last_message;
                    preview.className = `text-truncate contact-preview ${c.is_typing ? 'text-success fw-semibold fst-italic' : 'text-muted'}`;
                }

                const timeEl = item.querySelector('.contact-time');
                if (timeEl) timeEl.textContent = c.last_message_time;

                const unreadEl = item.querySelector('.contact-unread');
                if (unreadEl) {
                    unreadEl.textContent = c.unread_count;
                    unreadEl.classList.toggle('d-none', c.unread_count <= 0 || c.id === activeUserId);
                }
            });
        } catch (e) {
            // silent
        }
    }

    async function sendTypingSignal(isTyping = true) {
        if (!activeUserId) return;
        const now = Date.now();
        if (isTyping && now - lastTypingSentAt < 1800) return;
        lastTypingSentAt = now;

        try {
            await fetch(`{{ url('chat/typing') }}/${activeUserId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ is_typing: isTyping })
            });
        } catch (e) {}
    }

    chatMessageInput.addEventListener('input', function () {
        sendTypingSignal(this.value.trim().length > 0);
    });

    // Send Message
    chatSendForm.addEventListener('submit', async function (e) {
        e.preventDefault();
        if (!activeUserId) return;

        const text = chatMessageInput.value.trim();
        const file = chatAttachmentInput.files[0];
        if (!text && !file) return;

        const formData = new FormData();
        if (text) formData.append('message', text);
        if (file) formData.append('attachment', file);

        chatMessageInput.value = '';
        chatAttachmentInput.value = '';
        attachmentPreviewBar.classList.add('d-none');
        attachmentPreviewBar.classList.remove('d-flex');
        emojiPickerBox.classList.add('d-none');

        try {
            const res = await fetch(`{{ url('chat/send') }}/${activeUserId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: formData
            });
            if (res.ok) {
                await loadMessages(true);
                await refreshContacts();
            }
        } catch (e) {}
    });

    // Delete single message
    chatMessagesBox.addEventListener('click', async function (e) {
        const btn = e.target.closest('.delete-msg-btn');
        if (!btn) return;
        const msgId = btn.getAttribute('data-msg-id');

        const confirmDelete = await Swal.fire({
            title: 'Hapus pesan ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus',
            cancelButtonText: 'Batal'
        });

        if (!confirmDelete.isConfirmed) return;

        const res = await fetch(`{{ url('chat/message') }}/${msgId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            }
        });
        if (res.ok) {
            await loadMessages(false);
            await refreshContacts();
        }
    });

    // Clear entire conversation
    if (clearChatBtn) {
        clearChatBtn.addEventListener('click', async function () {
            if (!activeUserId) return;

            const confirmClear = await Swal.fire({
                title: 'Hapus seluruh pesan?',
                text: 'Semua pesan dalam percakapan ini akan dihapus untuk kedua belah pihak.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus semua',
                cancelButtonText: 'Batal'
            });

            if (!confirmClear.isConfirmed) return;

            const res = await fetch(`{{ url('chat/conversation') }}/${activeUserId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                }
            });
            if (res.ok) {
                lastRenderedHash = '';
                await loadMessages(true);
                await refreshContacts();
            }
        });
    }

    // Polling every 2.5 seconds
    setInterval(function () {
        if (activeUserId) {
            loadMessages(false);
        }
        refreshContacts();
    }, 2500);

    // Auto-select contact if ?user=ID is in URL
    const initialUserId = new URLSearchParams(window.location.search).get('user');
    if (initialUserId) {
        const targetBtn = document.querySelector(`.contact-item[data-user-id="${initialUserId}"]`);
        if (targetBtn) {
            targetBtn.click();
        }
    }
});
</script>
@endpush
