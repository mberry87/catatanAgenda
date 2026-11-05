$agendaKegiatan = \App\Models\AgendaKegiatan::with(['pegawai', 'user'])->orderBy('tgl_mulai')->get();
$pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('backend.agenda.pdf', compact('agendaKegiatan'))->setPaper('a4', 'landscape');
file_put_contents('C:/Users/MyBook Pro M7T/AppData/Local/hermes/cache/scratch/laporan-test.pdf', $pdf->output());
echo "PDF bytes: " . filesize('C:/Users/MyBook Pro M7T/AppData/Local/hermes/cache/scratch/laporan-test.pdf');
