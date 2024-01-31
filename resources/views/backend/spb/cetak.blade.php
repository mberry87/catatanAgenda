{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak SPB</title>

    <style>
        .subpage-remove-when-needed {
            background-image: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' version='1.1' height='100px' width='100px'><text transform='translate(20, 100) rotate(-45)' fill='rgb(208,208,208)' font-size='30'>GRATIS</text></svg>"),
            url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' version='1.1' height='100px' width='100px'><text transform='translate(30, 100) rotate(-45)' fill='rgb(208,208,208)' font-size='7'>KECUALI PEMBAYARAN PNBP</text></svg>");
        }
        .valign-top {
            vertical-align: top;
        }
    </style>
</head>
<body>
    <div class="book">
        <div class="page">
            <div class="subpage">
                <table width="100%">
                    <tbody>
                        <tr>
                            <td colspan="2" style="vertical-align: top;width: 25%;">

                            </td>
                            <td colspan="2" style="text-align: center;vertical-align: top;width: 50%;">
                                <img src="{{ asset('image/garuda.png') }}" width="100"/><br/>
                            </td>
                            <td colspan="2" style="text-align:right;font-weight:bold;text-transform:uppercase; vertical-align: top;width: 25%;">
                                TANJUNG PINANG<br/><span style="">SPB.IDTNJ.0124.0000413</span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6" style="text-align:center;">
                                <b><u>SURAT PERSETUJUAN BERLAYAR</u></b><br/>
                                <i>PORT CLEARANCE</i><br/>
                                <div style=" margin: 5px 0;">No. : SPB.IDTNJ.0124.0000413</div>
                                Berdasarkan UU No 17 Tahun 2008 Pasal 219 ayat 1<br/>
                                <i>Under This Shipping Act No.17, 2008 Article 219 (1)</i><br/><br/>
                            </td>
                        </tr>
                    </tbody>
                </table>
                @foreach ($cetakspb as $data)
                <table width="100%" style="border-spacing: 0 1em;">
                    <tbody>
                        <tr style="margin-bottom: 20px;">
                            <td width="120" style="vertical-align:top;">Nama Kapal <br/> <i>Ship Name</i></td>
                            <td style="vertical-align:top;">{{ $data->kapal->nama }}</td>
                            <td width="120" style="vertical-align:top;">Tonnase Kotor <br/> <i>Gross Tonnage</i></td>
                            <td style="vertical-align:top;">{{ $data->gt }}</td>
                        </tr>
                        <tr style="margin-bottom: 20px;">
                            <td style="vertical-align:top;">Bendera Kebangsaan<br/> <i>Nationality Flag</i></td>
                            <td style="vertical-align:top;">{{ $data->bendera }}</td>
                            <td style="vertical-align:top;">Nakhoda <br/> <i>Master</i></td>
                            <td style="vertical-align:top;">{{ $data->nakhoda }}</td>


                        </tr>
                        <tr style="margin-bottom: w0px;">
                            <td style="vertical-align:top;">Nomor IMO <br/> <i>IMO Number</i></td>
                            <td style="vertical-align:top;">{{$data->no_imo}}</td>
                            <td style="vertical-align:top;">Tanda Panggilan<br/> <i>Call Sign</i></td>
                            <td style="vertical-align:top;">{{ $data->call_sign }}</td>
                        </tr>
                    </tbody>
                </table>
                <p style="font-size: 12px;margin-bottom: 5px;">Sesuai dengan Surat Pernyataan Keberangkatan Kapal yang dibuat oleh Nakhoda kapal tanggal 15 Jan 2024 Pukul 10:56:08 WS,<br/>
                    <i>In accordance with Sailing Declaration issued by Master on dated 15 Jan 2024 Time 10:56:08 LT,</i></p>
                <table width="100%">
                    <tr>
                        <td style="text-align: center;">Bahwa kapal telah memenuhi seluruh ketentuan pada pasal 219 (3) UU No. 17 Tahun 2008</td>
                    </tr>
                    <tr>
                        <td style="text-align: center;font-style: italic;">That ship has fully comply with the provision of article 219 (3) Shipping Act. 17, 2008</td>
                    </tr>
                </table>
                <table width="100%" style="margin-top: 5px;">
                    <tr>
                        <td style="text-align: center;font-size: 16px;">Dengan ini kapal tersebut di atas disetujui untuk</td>
                    </tr>
                    <tr>
                        <td style="text-align: center;font-style: italic;font-size: 16px;">The above mentioned vessel is hereby granted for</td>
                    </tr>
                </table>
                <br/>
                <table width="100%" style="font-size: 12px;vertical-align: top;">
                    <tr>
                        <td width="150" class="valign-top">
                            <div>Bertolak dari</div>
                            <div><i>Departure from</i></div>
                        </td>
                        <td class="valign-top">:</td>
                        <td class="valign-top">{{ $data->bertolak }}</td>
                        <td class="valign-top">
                            <div>Pada tanggal / jam</div>
                            <div><i>on date/time</i></div>
                        </td>
                        <td class="valign-top">:</td>
                        <td class="valign-top">
                            <div>{{ $data->tgl_bertolak }}</div>
                            <div>{{ $data->jam_bertolak }}</div>
                        </td>
                        <td class="valign-top">
                            <div>Pelabuhan tujuan</div>
                            <div><i>Port of destination</i></div>
                        </td>
                        <td class="valign-top">:</td>
                        <td class="valign-top">{{$data->pelabuhan->nama }}</td>
                    </tr>
                    <tr>
                        <td class="valign-top">
                            <div>Jumlah awak kapal</div>
                            <div><i> Number Of Ship Crews</i></div>
                        </td>
                        <td class="valign-top">:</td>
                        <td colspan="4" class="valign-top">{{ $data->jml_crew }} ORANG TERMASUK NAKHODA</td>
                        <td class="valign-top">
                            <div>Dengan Muatan</div>
                            <div><i> With cargoes</i></div>
                        </td>
                        <td class="valign-top">:</td>
                        <td class="valign-top">{{ $data->muatan }}</td>
                    </tr>
                    <tr>
                        <td>Tempat diterbitkan <br/> <i>Place of Issued</i></td>
                        <td>:</td>
                        <td colspan="7">{{ $data->tmp_terbit }}</td>
                    </tr>
                    <tr>
                        <td>Pada Tanggal<br/> <i>Date</i></td>
                        <td>:</td>
                        <td colspan="4">{{ $data->tgl_terbit }}</td>
                        <td colspan="3" style="text-align: center;"><span style="font-size: 20px;text-decoration: underline;">{{ $data->pegawai->nama }}</span> <br/> HARBOUR MASTER</td>
                    </tr>
                    <tr>
                        <td>Jam <br/> <i> Time </i></td>
                        <td>:</td>
                        <td>{{ $data->jam_terbit }}</td>
                    </tr>
                </table>
                @endforeach
                <div style="margin-top: 10px;">
                    <span style="text-decoration: underline">Perhatian</span><span> &nbsp;:</span>
                </div>
                <div style="font-size: 12px;">
                    <ol>
                        <li>
                            <div>Surat Persetujuan Berlayar ini berlaku paling lama 24 jam sejak di terbitkan dan kapal wajib meninggalkan pelabuhan.</div>
                            <div style="font-style: italic;">This Port Clearance expired 24 hour due to date of issued and ship should leave of port.</div>
                        </li>
                        <li>
                            <div>Apabila dalam 24 jam Pemilik, agen atau Nakhoda Kapal tidak melayarkan kapalnya sejak Surat Persetujuan Berlayar diterbitkan, agar dikembalikan ke Syahbandar untuk penerbitan kembali, apabila perlu mengajukan permohonan Surat Persetujan Berlayar yang baru.</div>
                            <div style="font-style: italic;">Within 24 hours after issued the port clearance, the owner, agent or master of any vessel which fails to sails, Port Clearance shall be returned to the Harbour Master for the re-issued, and if so required, obtain a new port clearance.</div>
                        </li>
                        <li>
                            <div>Surat Persetujuan Berlayar ini tidak berlaku apabila terdapat coretan-coretan atau perubahan-perubahan.</div>
                            <div style="font-style: italic;">This Port Clearance expired if any corrections or deletions.</div>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
--}}

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
    @foreach ($cetakspb as $data)
        <div class="container-fluid">
            <header>
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
                    <P>SURAT PERSETUJUAN BERLAYAR <br>
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
            </header>

            <section>
                <div class="info_kapal mb-3">
                    <div class="row">
                        <div class="col col-md-6">
                            <div class="mb-3">
                                <p>Nama Kapal : {{ $data->kapal->nama }}
                                    <br> <span>Ship Name </span>
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
                <div class="isi_surat mb-3">
                    <p>Sesuai dengan Surat Pernyataan Keberangkatan Kapal yang dibuat oleh Nakhoda kapal tanggal
                        {{ $data->tgl_nakhoda }} Pukul {{ $data->jam_nakhoda }} WS, <br>
                        <span>In accordance with Sailing Declaration Issud by Master on dated {{ $data->tgl_nakhoda }}
                            Time
                            {{ $data->jam_nakhoda }} LT,</span>
                    </p>
                    <p class="text-center">Bawhwa kapal telah memenuhi seluruh ketentuan pada pasal 219 (3) UU No.17
                        Tahun
                        2008
                        <br>
                        <span>That ship has fully comply with the provision of article 219 (3) Shipping Act.
                            17,2008</span>
                    </p>
                    <p class="text-center legal">Dengan ini kapal tersebut diatas disetujui untuk <br>
                        <span class="fst-italic">The above mention vessel is hereby granted for</span>
                    </p>
                </div>
            </section>

            <section>
                <div class="info_spb">
                    <div class="row">
                        <div class="col col-md-4">
                            <p>Bertolak Dari :{{ $data->bertolak }} <br>
                                <span>Departure from</span>
                            </p>
                            <p>Jumlah Awak Kapal : {{ $data->jml_crew }}<br>
                                <span>Number Of Ship Crew</span>
                            </p>
                            <p>Tempat diterbitkan : {{ $data->tmp_terbit }} <br>
                                <span>Place Of Issued</span>
                            </p>
                            <p>Pada Tanggal : {{ $data->tgl_terbit }} <br>
                                <span>Date</span>
                            </p>
                            <p>Jam : {{ $data->jam_terbit }} <br>
                                <span>Time</span>
                            </p>
                        </div>
                        <div class="col col-md-4">
                            <p>Pada tanggal / jam : {{ $data->tgl_bertolak }} / {{ $data->jam_bertolak }} <br>
                                <span>on date / time</span>
                            </p>
                        </div>
                        <div class="col col-md-4">
                            <p>Pelabuhan Tujuan : {{ $data->pelabuhan->nama }}<br>
                                <span>Port of destination</span>
                            </p>
                            <p>Dengan Muatan : {{ $data->muatan }} <br>
                                <span>With Cargoes</span>
                            </p>
                            <p class="ttd text-center">SYAHBANDAR </p>
                            <p class="text-center">HARBOUR MASTER</p>
                            <br>
                            <br>
                            <p class="text-center pegawai">{{ $data->pegawai->nama }}</p>

                        </div>
                    </div>
                </div>
            </section>

            <section>
                <div class="list_surat">
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
                            dikembalikan ke Syahbandar untuk penerbitan kembali, apabika perlu mengajukan permohonan
                            Surat
                            Persetjuan Berlayar yang baru. <br>
                            <span>
                                Within 24 hour after issued the port clearance, the owner, agent or master fo any vessel
                                which
                                fails to sails, Port Clearance shall be <br> returned to the Harbour Master of the
                                re-issued,
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
        </div>
    @endforeach


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
