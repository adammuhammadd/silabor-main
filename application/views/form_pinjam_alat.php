<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pinjam Alat</title>
    <!-- <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets_viho/assets/css/bootstrap.css" media="all"> -->
    <style>
        * {
            box-sizing: border-box;
        }

        @page {
            margin: 0px;
        }

        body {
            margin: 0;
            padding: 0;
        }

        .header {
            border-bottom: 2px solid black;
            padding-bottom: 25px;
        }

        .page {
            margin: 0;
            padding: 0;
        }

        .logo {
            margin-top: 30px;
            margin-left: 90px;
            max-width: 25%;
            /* border: 5px solid black */
        }

        .kop {
            max-width: 63%;
            font-size: 14pt;
            /* border: 5px solid black; */
            position: absolute;
            top: 10px;
            right: 100px
        }

        .kop>p {
            text-align: center;
            margin: 0;
        }

        .body {
            font-size: 12pt;
            font-family: Arial, Helvetica, sans-serif;
        }

        .ttd {
            position: absolute;
            bottom: 200px;
            right: 100px;
        }

        .black {
            width: 20%;
            border: 5px solid black;
            position: absolute;
            bottom: 30px;
            left: 0
        }

        .brown {
            width: 20%;
            border: 5px solid brown;
            position: absolute;
            bottom: 30px;
            left: 20%
        }

        .gold {
            width: 20%;
            border: 5px solid darkgoldenrod;
            position: absolute;
            bottom: 30px;
            left: 40%
        }

        .page_break {
            page-break-before: always;
        }

        table,
        th,
        td {
            border: 1px solid;
            text-align: center;
        }

        table {
            width: 80%;
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
        }
    </style>
</head>

<body>
    <div class="page">
        <div class="header">
            <div class="logo"><img width="100px" src="<?= base_url('assets_viho/assets/images/logo/logo-itera-lg.png') ?>"></div>
            <div class="kop">
                <p>KEMENTERIAN PENDIDIKAN, KEBUDAYAAN, RISET, DAN TEKNOLOGI</p>
                <p style="font-size: 12pt;">INSTITUT TEKNOLOGI SUMATERA</p>
                <p style="font-weight: bold; font-size: 12pt;">UPT LABORATORIUM TERPADU</p>
                <p style="font-size: 11pt;">Jalan Terusan Ryacudu Way Hui, Kecamatan Jati Agung, Lampung Selatan 35365</p>
                <p style="font-size: 11pt;">Telepon: (0721) 8030188</p>
                <p style="font-size: 11pt;">Email: <u>upt.labterpadu@itera.ac.id</u>, Website : www.ilab.itera.ac.id</p>
            </div>

        </div>
        <div class="body" style="margin-top: 10px;">
            <p style="text-align:center;font-weight:bold;font-size:12pt">FORMULIR PEMINJAMAN ALAT LABORATORIUM</p>
            <div class="underline" style="border-bottom: 1px solid black;margin-left:150px;margin-right:150px"></div>
            <div style="margin-left: 100px;margin-right: 100px;">
                <p style="margin-bottom: 0;margin-top: 60px;">Dengan ini menyatakan bahwa:</p>
                <div class="input" style="margin-left: 100px;">
                    <p>Nama&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?= $nama ?></p>
                    <p>NIM/NIP&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?= $nim ?></p>
                    <p>Prodi&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?= $prodi ?></p>
                </div>
                <p style="line-height: 1.8;">Mengajukan permohonan peminjaman alat laboratorium dengan rincian terlampir.
                    Peminjam bersedia memenuhi persyaratan yang ada di laboratorium dan jika terjadi kerusakan atau kehilangan barang yang dipinjam, maka peminjam bersedia untuk bertanggung jawab.
                </p>
            </div>
            <div class="ttd" style="position: absolute;bottom: 10%; right: 100px;">
                <p style="margin-bottom: 3px;">Lampung Selatan,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2021</p>
                <p style="margin-bottom: 10px;margin-top: 0">Peminjam,</p>
                <div style="position:relative;left: 60px;margin-bottom:10px"><img width="100px" src="<?= base_url('generate/qrcode/') . $kode_1 ?>"></div>
                <p style="margin: 0;"><?= $nama ?></p>
                <p style="margin: 0;"><?= $nim ?></p>
            </div>
        </div>
        <div class="black">
        </div>
        <div class="brown">
        </div>
        <div class="gold">
        </div>
        <div class="page_break"></div>
        <div class="header">
            <div class="logo"><img width="100px" src="<?= base_url('assets_viho/assets/images/logo/logo-itera-lg.png') ?>"></div>
            <div class="kop">
                <p>KEMENTERIAN PENDIDIKAN, KEBUDAYAAN, RISET, DAN TEKNOLOGI</p>
                <p style="font-size: 12pt;">INSTITUT TEKNOLOGI SUMATERA</p>
                <p style="font-weight: bold; font-size: 12pt;">UPT LABORATORIUM TERPADU</p>
                <p style="font-size: 11pt;">Jalan Terusan Ryacudu Way Hui, Kecamatan Jati Agung, Lampung Selatan 35365</p>
                <p style="font-size: 11pt;">Telepon: (0721) 8030188</p>
                <p style="font-size: 11pt;">Email: <u>upt.labterpadu@itera.ac.id</u>, Website : www.ilab.itera.ac.id</p>
            </div>
        </div>
        <div class="body" style="margin-top: 10%;">
            <p style="text-align:center;font-weight:bold;">DAFTAR ALAT YANG DIPINJAM</p>
            <table style="border-collapse: collapse;">
                <thead>
                    <tr>
                        <td rowspan="2" style="padding:2px">No.</td>
                        <td rowspan="2" style="padding:2px">Nama Alat</td>
                        <td rowspan="2" style="padding:2px">Jumlah</td>
                        <td colspan="2" style="padding:2px">Kondisi Alat</td>
                        <td rowspan="2" style="padding:2px">Tanggal Pengembalian</td>
                        <td rowspan="2" style="padding:2px">Validasi laboran</td>
                    </tr>
                    <tr>
                        <td>Awal</td>
                        <td>Akhir</td>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($list_data as $list) { ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $list->nama_alat ?></td>
                            <td><?= $list->jml_alat ?></td>
                            <td><?= $list->kondisi_awal ?></td>
                            <td> </td>
                            <td> </td>
                            <td><img width="20px" class="padding:5px" src="<?= base_url('assets_viho/assets/images/logo/check-1.png') ?>" alt=""></td>
                        </tr>
                    <?php } ?>

                </tbody>
            </table>
            <div class="ttd" style="position: absolute;bottom: 10%; right: 100px;">
                <p style="margin-bottom: 3px;">Lampung Selatan,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2021</p>
                <p style="margin-bottom: 10px;margin-top: 0">Menyetujui,</p>
                <div style="position:relative;left: 60px;margin-bottom:10px"><img width="100px" src="<?= base_url('generate/qrcode/') . $kode_2 ?>"></div>
                <p style=" margin: 0;">UPT Laboratorium Terpadu Itera</p>
            </div>
            <div class="black">
            </div>
            <div class="brown">
            </div>
            <div class="gold">
            </div>
        </div>
    </div>
</body>

</html>