<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/my-app.css') }}">
</head>

<body>
    <header>
        <div class="container">
            <div class="row">
                <div class="col col-md-6">
                    <p>Nomor Registrasi : {{ $data->no_regis }}</p>
                </div>
                <div class="col col-md-6">
                    <p>Nomor : </p>
                </div>
            </div>
            <div class="hdr_surat text-center ">
                <img src="{{ asset('image/garuda.png') }}" alt="">
                <p>REPUBLIK INDONESIA <br>
                    <span>THE REPUBLIC OF INDONESIA</span>
                </p>
                <P>SURAT PERSETUJAUN BERLAYAR <br>
                    <span>PORT CLEREANCE</span>
                </P>
            </div>
            <div class="nmr_surat text-center">
                <p>No : {{ $data->no_surat }}<br>
                    <span>
                        Berdasarkan UU No.17 Tahun 2008 Pasal 219 ayat 1 <br>
                        Under The Shipping Act. No.17,2008 Article 219 (1)
                    </span>
                </p>

            </div>
        </div>
    </header>

    <section>
        <div class="container info_kapal">
            <div class="row">
                <div class="col col-md-6">
                    <div class="mb-3">
                        <p>Nama : {{ $data->pemohon }}
                            <br> <span>Ship Name : {{ $data->kapal->nama }} </span>
                        </p>
                    </div>
                    <div class="mb-3">
                        <p>Bendera Kebangsaan : {{ $data->bendera }}
                            <br> <span>Nationality Flag </span>
                        </p>
                    </div>
                    <div class="mb-3">
                        <p>Nomor IMO : {{ $data->no_imo }}
                            <br> <span>IMO Number </span>
                        </p>
                    </div>
                </div>

                <div class="col col-md-6">
                    <div class="mb-3">
                        <p>Tonase Kotor : {{ $data->gt }}
                            <br> <span>Gross Tonage </span>
                        </p>
                    </div>
                    <div class="mb-3">
                        <p>Nakhoda : {{ $data->nakhoda }}
                            <br> <span>Master </span>
                        </p>
                    </div>
                    <div class="mb-3">
                        <p>Tanda Panggilan : {{ $data->call_sign }}
                            <br> <span>Call Sign </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container isi_surat">
            <p>Sesuai dengan Surat Pernyataan Keberangkatan Kapal yang dibuat oleh Nakhoda kapal tanggal
                {{ $data->waktu_bertolak }} Pukul
                ...........WS, <br>
                <span>In accordance with Sailing Declaration Issud by Master on dated ........Time .........LT,</span>
            </p>
            <p class="text-center">Bawhwa kapal telah memenuhi seluruh ketentuan pada pasal 219 (3) UU No.17 Tahun 2008
                <br>
                <span>That ship has fully comply with the provision of article 219 (3) Shipping Act. 17,2008</span>
            </p>
            <p class="text-center fs-6 fw-semibold">Dengan ini kapal tersebut diatas disetujui untuk <br>
                <span class="fst-italic">The above mention vessel is hereby granted for</span>
            </p>
        </div>
    </section>

    <section>
        <div class="container info_spb">
            <div class="row">
                <div class="col col-md-4">
                    <p>Bertolak Dari :{{ $data->bertolak }} <br>
                        <span>Departure from</span>
                    </p>
                    <p>Jumlah Awak Kapal : {{ $data->jml_crew }}<br>
                        <span>Number Of Ship Crew</span>
                    </p>
                    <p>Tempat diterbitkan : <br>
                        <span>Place Of Issued</span>
                    </p>
                    <p>Pada Tanggal : <br>
                        <span>Date</span>
                    </p>
                    <p>Jam : <br>
                        <span>Time</span>
                    </p>
                </div>
                <div class="col col-md-4">
                    <p>Pada tanggal /jam : <br>
                        <span>on date / time</span>
                    </p>
                </div>
                <div class="col col-md-4">
                    <p>Pelabuhan Tujuan : <br>
                        <span>Port of destination</span>
                    </p>
                    <p>Dengan Muatan : <br>
                        <span>With Cargoes</span>
                    </p>
                    <p class="ttd text-center">SYAHBANDAR </p>
                    <p class="text-center">HARBOUR MASTER</p>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container list_surat">
            <p>Perhatian : </p>
            <ol>
                <li>Surat Persetujuan Berlayar ini berlaku paling lama 24 jam sejak di terbitkan dan kapal wajib
                    meninggalkan pelabuhan. <br>
                    <span>
                        This Port Clearance expired 24 hour due to date of issued and ship should leave of port.
                    </span>
                </li>
                <li>Apabila dalam 24 jam Pemilik, agen atau Nakhoda Kapal tidak melayarkan kapalya sejak Surat
                    Persetujuan Berlayar diterbitkan, agar <br>
                    dikembalikan ke Syahbandar untuk penerbitan kembali, apabika perlu mengajukan permohonan Surat
                    Persetjuan Berlayar yang baru. <br>
                    <span>
                        Within 24 hour after issued the port clearance, the owner, agent or master fo any vessel which
                        fails to sails, Port Clearance shall be <br> returned to the Harbour Master of the re-issued,
                        and if so required, obtain a new port clearance.
                    </span>
                </li>
                <li>
                    Surat Persetujuan Berlayar ini tidak berlaku apabila terdapat coretan-coretan atau
                    perubahan-perubahan. <br>
                    <span>
                        This Port Clearance expired if any corrections or deletions.
                    </span>
                </li>
            </ol>
        </div>
    </section>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
