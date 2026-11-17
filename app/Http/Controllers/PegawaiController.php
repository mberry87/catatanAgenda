<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // hubungkan data migration
        $pegawai = Pegawai::all();

        $title = 'Hapus Data!';
        $text = "Anda yakin ingin hapus data?";
        confirmDelete($title, $text);

        return view('backend.pegawai.index', compact('pegawai'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pegawai.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'nip' => 'required',
            'gol' => 'required',
        ]);


        Pegawai::create($validatedData);

        return redirect()->route('pegawai.index')->with('success', 'Data pegawai berhasil ditambah.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pegawai = Pegawai::find($id);

        if (!$pegawai) {
            // Jika pegawai dengan ID yang diberikan tidak ditemukan,
            abort(404);
        }

        return view('backend.pegawai.edit', compact('pegawai'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pegawai = Pegawai::find($id);

        if (!$pegawai) {
            // Jika pegawai dengan ID yang diberikan tidak ditemukan,
            abort(404);
        }

        $request->validate([
            'nama' => 'required',
            'nip' => 'required',
            'gol' => 'required',
        ]);

        $pegawai->nama = $request->nama;
        $pegawai->nip = $request->nip;
        $pegawai->gol = $request->gol;
        $pegawai->save();

        return redirect()->route('pegawai.index')->with('success', 'Pegawai berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        $pegawai->delete();

        return redirect()->route('pegawai.index')->with('success', 'Data pegawai berhasil dihapus.');
    }

    public function importCsv(Request $request)
    {
        $request->validate([
            'file_csv' => 'required|file|mimes:csv,txt|max:5120',
        ]);

        $file = $request->file('file_csv');
        $path = $file->getRealPath();

        $handle = fopen($path, 'r');
        if ($handle === false) {
            return redirect()->route('pegawai.index')->with('error', 'Gagal membaca file CSV.');
        }

        // Deteksi delimiter (; atau ,) dari baris pertama
        $firstLine = fgets($handle);
        if ($firstLine === false) {
            fclose($handle);
            return redirect()->route('pegawai.index')->with('error', 'File CSV kosong.');
        }

        $firstLine = preg_replace('/^\xEF\xBB\xBF/', '', $firstLine); // Hapus UTF-8 BOM
        $delimiter = substr_count($firstLine, ';') >= substr_count($firstLine, ',') ? ';' : ',';

        rewind($handle);
        $headerRow = fgetcsv($handle, 0, $delimiter);
        if (!$headerRow) {
            fclose($handle);
            return redirect()->route('pegawai.index')->with('error', 'Header CSV tidak valid.');
        }

        $headerRow[0] = preg_replace('/^\xEF\xBB\xBF/', '', $headerRow[0]);
        $headers = array_map(function ($h) {
            return strtolower(trim($h));
        }, $headerRow);

        $namaIdx = array_search('nama', $headers, true);
        $nipIdx = array_search('nip', $headers, true);
        $golIdx = array_search('gol', $headers, true);
        $jabatanIdx = array_search('jabatan', $headers, true);
        $unitIdx = array_search('unit_kerja', $headers, true);
        $statusIdx = array_search('status', $headers, true);

        if ($namaIdx === false || $nipIdx === false) {
            fclose($handle);
            return redirect()->route('pegawai.index')->with('error', 'Kolom "Nama" dan "NIP" wajib ada pada file CSV.');
        }

        $inserted = 0;
        $updated = 0;

        while (($row = fgetcsv($handle, 0, $delimiter)) !== false) {
            $nama = isset($row[$namaIdx]) ? trim($row[$namaIdx]) : '';
            $nip = isset($row[$nipIdx]) ? trim($row[$nipIdx]) : '';

            if ($nama === '' || $nip === '') {
                continue;
            }

            $data = [
                'nama'       => $nama,
                'gol'        => ($golIdx !== false && isset($row[$golIdx]) && trim($row[$golIdx]) !== '') ? trim($row[$golIdx]) : null,
                'jabatan'    => ($jabatanIdx !== false && isset($row[$jabatanIdx]) && trim($row[$jabatanIdx]) !== '') ? trim($row[$jabatanIdx]) : null,
                'unit_kerja' => ($unitIdx !== false && isset($row[$unitIdx]) && trim($row[$unitIdx]) !== '') ? trim($row[$unitIdx]) : null,
                'status'     => ($statusIdx !== false && isset($row[$statusIdx]) && trim($row[$statusIdx]) !== '') ? trim($row[$statusIdx]) : null,
            ];

            $existing = Pegawai::where('nip', $nip)->first();
            if ($existing) {
                $existing->update($data);
                $updated++;
            } else {
                Pegawai::create(array_merge(['nip' => $nip], $data));
                $inserted++;
            }
        }

        fclose($handle);

        return redirect()->route('pegawai.index')
            ->with('success', "Import CSV selesai: {$inserted} pegawai baru ditambahkan, {$updated} pegawai diperbarui.");
    }
}
