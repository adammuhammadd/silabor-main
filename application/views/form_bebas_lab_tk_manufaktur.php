<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Bebas Laboratorium</title>
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
            <p style="text-align:center;font-weight:bold;font-size:12pt">SURAT KETERANGAN BEBAS LABORATORIUM</p>
            <div class="underline" style="border-bottom: 1px solid black;margin-left:150px;margin-right:150px"></div>
            <div style="margin-left: 100px;margin-right: 100px;">
                <p>Dengan ini menyatakan bahwa:</p>
                <div class="input" style="margin-left: 100px;">
                    <p style="margin:0">Nama&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?= $nama ?></p>
                    <p style="margin:0">NIM/NIP&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?= $nim ?></p>
                    <p style="margin:0">Prodi&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?= $prodi ?></p>
                    <p style="margin:0">Kode&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?= $kode_permohonan ?></p>
                </div>
                <p>Mahasiswa tersebut di atas telah menyelesaikan semua administrasi maupun peminjaman alat laboratorium yang ada di UPT Laboratorium Terpadu dan dinyatakan bebas dari tanggungan laboratorium:
                </p>
            </div>
        </div>
        <div class="black">
        </div>
        <div class="brown">
        </div>
        <div class="gold">
        </div>
        <div class="page_break"></div>
        <div class="table" style="margin-top: 150px">
            <table style="border-collapse: collapse;">
                <tr style="background-color:#B7C5E4; font-weight:bold">
                    <td style="padding: 10px; font-size: 10pt; min-width:200px">LAB. KIMIA</td>
                    <td style="padding: 10px; font-size: 10pt; min-width:200px">LAB. FISIKA</td>
                    <td style="padding: 10px; font-size: 10pt; min-width:200px">LAB. MULTIMEDIA</td>
                </tr>
                <tr>
                    <td><?php if ($data_kalab_kimia == '') { ?>
                            <p style="margin-top: 50px; margin-bottom:50px;font-size:9pt">Tidak Ada Riwayat Peminjaman</p>
                        <?php } else { ?>
                            <p style="font-size: 10pt;margin:0;padding:0">Koordinator Laboratorium</p>
                            <div><img width="100px" src="<?= base_url('generate/qrcode/') . $kode_kalab_kimia ?>"></div>
                            <p style="font-size: 10pt;margin:0;padding:0"><?= $data_kalab_kimia->nama_lengkap ?> </p>
                            <p style="font-size: 10pt;margin:0;padding:0">NIP. <?= $data_kalab_kimia->nim ?></p>
                        <?php } ?>
                    </td>
                    <td><?php if ($data_kalab_fisika == '') { ?>
                            <p style="margin-top: 50px; margin-bottom:50px;font-size:9pt">Tidak Ada Riwayat Peminjaman</p>
                        <?php } else { ?>
                            <p style="font-size: 10pt;margin:0;padding:0">Koordinator Laboratorium</p>
                            <div><img width="100px" src="<?= base_url('generate/qrcode/') . $kode_kalab_fisika ?>"></div>
                            <p style="font-size: 10pt;margin:0;padding:0"><?= $data_kalab_fisika->nama_lengkap ?> </p>
                            <p style="font-size: 10pt;margin:0;padding:0">NIP. <?= $data_kalab_fisika->nim ?></p>
                        <?php } ?>
                    </td>
                    <td><?php if ($data_kalab_multimedia == '') { ?>
                            <p style="margin-top: 50px; margin-bottom:50px;font-size:9pt">Tidak Ada Riwayat Peminjaman</p>
                        <?php } else { ?>
                            <p style="font-size: 10pt;margin:0;padding:0">Koordinator Laboratorium</p>
                            <div><img width="100px" src="<?= base_url('generate/qrcode/') . $kode_kalab_multimedia ?>"></div>
                            <p style="font-size: 10pt;margin:0;padding:0"><?= $data_kalab_multimedia->nama_lengkap ?> </p>
                            <p style="font-size: 10pt;margin:0;padding:0">NIP. <?= $data_kalab_multimedia->nim ?></p>
                        <?php } ?>
                    </td>
                </tr>

                <tr style="background-color:#B7C5E4; font-weight:bold">
                    <td style="padding: 10px; font-size: 10pt">LAB. BIOLOGI</td>
                    <td style="padding: 10px; font-size: 10pt">LAB. TEKNIK GEOLOGI</td>
                    <td style="padding: 10px; font-size: 10pt">LAB. TEKNIK GEOFISIKA</td>
                </tr>
                <tr>
                    <td><?php if ($data_kalab_biologi == '') { ?>
                            <p style="margin-top: 50px; margin-bottom:50px;font-size:9pt">Tidak Ada Riwayat Peminjaman</p>
                        <?php } else { ?>
                            <p style="font-size: 10pt;margin:0;padding:0">Koordinator Laboratorium</p>
                            <div><img width="100px" src="<?= base_url('generate/qrcode/') . $kode_kalab_biologi ?>"></div>
                            <p style="font-size: 10pt;margin:0;padding:0"><?= $data_kalab_biologi->nama_lengkap ?> </p>
                            <p style="font-size: 10pt;margin:0;padding:0">NIP. <?= $data_kalab_biologi->nim ?></p>
                        <?php } ?>
                    </td>
                    <td><?php if ($data_kalab_tk_geologi == '') { ?>
                            <p style="margin-top: 50px; margin-bottom:50px;font-size:9pt">Tidak Ada Riwayat Peminjaman</p>
                        <?php } else { ?>
                            <p style="font-size: 10pt;margin:0;padding:0">Koordinator Laboratorium</p>
                            <div><img width="100px" src="<?= base_url('generate/qrcode/') . $kode_kalab_tk_geologi ?>"></div>
                            <p style="font-size: 10pt;margin:0;padding:0"><?= $data_kalab_tk_geologi->nama_lengkap ?> </p>
                            <p style="font-size: 10pt;margin:0;padding:0">NIP. <?= $data_kalab_tk_geologi->nim ?></p>
                        <?php } ?>
                    </td>
                    <td><?php if ($data_kalab_tk_geofisika == '') { ?>
                            <p style="margin-top: 50px; margin-bottom:50px;font-size:9pt">Tidak Ada Riwayat Peminjaman</p>
                        <?php } else { ?>
                            <p style="font-size: 10pt;margin:0;padding:0">Koordinator Laboratorium</p>
                            <div><img width="100px" src="<?= base_url('generate/qrcode/') . $kode_kalab_tk_geofisika ?>"></div>
                            <p style="font-size: 10pt;margin:0;padding:0"><?= $data_kalab_tk_geofisika->nama_lengkap ?> </p>
                            <p style="font-size: 10pt;margin:0;padding:0">NIP. <?= $data_kalab_tk_geofisika->nim ?></p>
                        <?php } ?>
                    </td>
                </tr>

                <tr style="background-color:#B7C5E4; font-weight:bold">
                    <td style="padding: 10px; font-size: 10pt">LAB. TEKNIK MESIN</td>
                    <td style="padding: 10px; font-size: 10pt">LAB. TEKNIK INDUSTRI</td>
                    <td style="padding: 10px; font-size: 10pt">LAB. TEKNIK MATERIAL</td>
                </tr>
                <tr>
                    <td><?php if ($data_kalab_tk_mesin == '') { ?>
                            <p style="margin-top: 50px; margin-bottom:50px;font-size:9pt">Tidak Ada Riwayat Peminjaman</p>
                        <?php } else { ?>
                            <p style="font-size: 10pt;margin:0;padding:0">Koordinator Laboratorium</p>
                            <div><img width="100px" src="<?= base_url('generate/qrcode/') . $kode_kalab_tk_mesin ?>"></div>
                            <p style="font-size: 10pt;margin:0;padding:0"><?= $data_kalab_tk_mesin->nama_lengkap ?> </p>
                            <p style="font-size: 10pt;margin:0;padding:0">NIP. <?= $data_kalab_tk_mesin->nim ?></p>
                        <?php } ?>
                    </td>
                    <td><?php if ($data_kalab_tk_industri == '') { ?>
                            <p style="margin-top: 50px; margin-bottom:50px;font-size:9pt">Tidak Ada Riwayat Peminjaman</p>
                        <?php } else { ?>
                            <p style="font-size: 10pt;margin:0;padding:0">Koordinator Laboratorium</p>
                            <div><img width="100px" src="<?= base_url('generate/qrcode/') . $kode_kalab_tk_industri ?>"></div>
                            <p style="font-size: 10pt;margin:0;padding:0"><?= $data_kalab_tk_industri->nama_lengkap ?> </p>
                            <p style="font-size: 10pt;margin:0;padding:0">NIP. <?= $data_kalab_tk_industri->nim ?></p>
                        <?php } ?>
                    </td>
                    <td><?php if ($data_kalab_tk_material == '') { ?>
                            <p style="margin-top: 50px; margin-bottom:50px;font-size:9pt">Tidak Ada Riwayat Peminjaman</p>
                        <?php } else { ?>
                            <p style="font-size: 10pt;margin:0;padding:0">Koordinator Laboratorium</p>
                            <div><img width="100px" src="<?= base_url('generate/qrcode/') . $kode_kalab_tk_material ?>"></div>
                            <p style="font-size: 10pt;margin:0;padding:0"><?= $data_kalab_tk_material->nama_lengkap ?> </p>
                            <p style="font-size: 10pt;margin:0;padding:0">NIP. <?= $data_kalab_tk_material->nim ?></p>
                        <?php } ?>
                    </td>
                </tr>

                <tr style="background-color:#B7C5E4; font-weight:bold">
                    <td colspan="3" style="padding: 10px; font-size: 10pt">LAB. TEKNIK PERTAMBANGAN</td>
                </tr>
                <tr>
                    <td colspan="3"><?php if ($data_kalab_tk_pertambangan == '') { ?>
                            <p style="margin-top: 50px; margin-bottom:50px;font-size:9pt">Tidak Ada Riwayat Peminjaman</p>
                        <?php } else { ?>
                            <p style="font-size: 10pt;margin:0;padding:0">Koordinator Laboratorium</p>
                            <div><img width="100px" src="<?= base_url('generate/qrcode/') . $kode_kalab_tk_pertambangan ?>"></div>
                            <p style="font-size: 10pt;margin:0;padding:0"><?= $data_kalab_tk_pertambangan->nama_lengkap ?> </p>
                            <p style="font-size: 10pt;margin:0;padding:0">NIP. <?= $data_kalab_tk_pertambangan->nim ?></p>
                        <?php } ?>
                    </td>
                </tr>
            </table>
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
            <div style="margin-left:80px; margin-right:80px">
                <p>Catatan:</p>
                <div>
                    <p style="margin:0">1. Masing-masing Laboratorium harus diparaf oleh Laboran terlebih dahulu.</p>
                    <p style="margin:0">2. Surat keterangan bebas laboratorium berlaku selama 6 bulan sejak tanggal ditetapkan.</p>
                    <p style="margin:0">3. Melampirkan berita acara Sidang Komprehensif.</p>
                </div>
            </div>

            <div class="ttd" style="position: absolute;bottom: 10%; right: 100px;">
                <p style="margin-bottom: 3px;">Lampung Selatan,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $tgl_penerimaan; ?></p>
                <p style="margin-bottom: 10px;margin-top: 0">Mengetahui,</p>
                <p style="margin-bottom: 10px;margin-top: 0">Kepala UPT Laboratorium Terpadu</p>
                <?php if (isset($kode_kepala_upt)) { ?>
                    <div style="position:relative;left: 70px;margin-bottom:10px"><img width="100px" src="<?= base_url('generate/qrcode/') . $kode_kepala_upt ?>"></div>
                <?php } else { ?>
                    <div style="position:relative;left: 70px;margin-bottom:100px"></div>
                <?php } ?> <p style=" margin: 0;">UPT Laboratorium Terpadu Itera</p>
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