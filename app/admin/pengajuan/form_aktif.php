<?php
include '../../config/f_pengajuan.php';
$id_pengajuan = $_GET['id'];
$query     = mysqli_query($conn, "SELECT * FROM tb_pengajuan WHERE id_pengajuan='$id_pengajuan'");
$result    = mysqli_fetch_array($query);
if ($result['nim']) {

    $sql = "select * from tb_mahasiswa where nim = '$result[nim]'";
    $hasil = mysqli_query($conn, $sql);
    while ($data = mysqli_fetch_array($hasil)) {
        $nim = $data['nim'];
        $id_doswal = $data['id_doswal'];
        $id_kajur = $data['id_kajur'];
        $nama = $data['nama'];
        $kelas = $data['kelas'];
        $alamat = $data['alamat'];
        $no_telp = $data['no_telp'];
        $ttd_mhs = $data['ttd'];
    }
}

// ambil data doswal
if (is_null($result['status'])) {
    $sql2 = mysqli_query($conn, "select p.nama, p.ttd, p.nip_npak from tb_doswal as d, tb_pegawai as p WHERE d.nip_npak=p.nip_npak AND id_doswal='$id_doswal'");
    while ($data_doswal = mysqli_fetch_array($sql2)) {
        $nama_doswal = $data_doswal['nama'];
        $nip_doswal = $data_doswal['nip_npak'];
        $ttd_doswal = $data_doswal['ttd'];
    }
} else {
    $sql2 = mysqli_query($conn, "select p.nama, p.ttd, p.nip_npak, v.status from tb_pegawai as p, tb_doswal as d, tb_verifikasi as v WHERE p.nip_npak=d.nip_npak AND p.nip_npak=v.nip_npak AND id_doswal='$id_doswal'");
    while ($data_doswal = mysqli_fetch_array($sql2)) {
        $nama_doswal = $data_doswal['nama'];
        $nip_doswal = $data_doswal['nip_npak'];
        $ttd_doswal = $data_doswal['ttd'];
        $status_doswal = $data_doswal['status'];
    }
}
// ambil data kajur
if ($result['status'] > '2') {
    $kajur = mysqli_query($conn, "select p.nama, p.ttd, p.nip_npak, k.nm_jurusan, v.status from tb_pegawai as p, tb_kajur as k, tb_verifikasi as v WHERE p.nip_npak=k.nip_npak AND p.nip_npak=v.nip_npak AND id_kajur='$id_kajur'");
    while ($data_kajur = mysqli_fetch_array($kajur)) {
        $nama_kajur = $data_kajur['nama'];
        $nm_jurusan = $data_kajur['nm_jurusan'];
        $nip_kajur = $data_kajur['nip_npak'];
        $ttd_kajur = $data_kajur['ttd'];
        $status_kajur = $data_kajur['status'];
    }
} else {
    $kajur = mysqli_query($conn, "select p.nama, p.ttd, p.nip_npak, k.nm_jurusan from tb_pegawai as p, tb_kajur as k WHERE p.nip_npak=k.nip_npak AND id_kajur='$id_kajur'");
    while ($data_kajur = mysqli_fetch_array($kajur)) {
        $nama_kajur = $data_kajur['nama'];
        $nm_jurusan = $data_kajur['nm_jurusan'];
        $nip_kajur = $data_kajur['nip_npak'];
        $ttd_kajur = $data_kajur['ttd'];
    }
}
// ambil wadir 1
if ($result['status'] < '4') {
    $sql3 = mysqli_query($conn, "select p.nama, p.ttd, p.nip_npak from tb_pegawai as p, tb_hak_akses as hak, tb_jabatan as jb WHERE p.nip_npak = hak.nip_npak AND hak.id_jabatan = jb.id_jabatan AND jb.nama_jabatan = 'Wakil Direktur 1' AND p.status = 'Aktif'");
    while ($data_wadir = mysqli_fetch_array($sql3)) {
        $nama_wadir1 = $data_wadir['nama'];
        $nip_wadir1 = $data_wadir['nip_npak'];
        $ttd_wadir1 = $data_wadir['ttd'];
    }
} else {
    $sql3 = mysqli_query($conn, "select p.nama, p.ttd, p.nip_npak, v.status from tb_pegawai as p, tb_pengajuan as pj, tb_verifikasi as v, tb_hak_akses as hak, tb_jabatan as jb WHERE pj.id_pengajuan = v.id_pengajuan AND p.nip_npak=v.nip_npak AND p.nip_npak = hak.nip_npak AND hak.id_jabatan = jb.id_jabatan AND jb.nama_jabatan = 'Wakil Direktur 1' AND v.id_pengajuan='$id_pengajuan'");
    while ($data_wadir = mysqli_fetch_array($sql3)) {
        $nama_wadir1 = $data_wadir['nama'];
        $nip_wadir1 = $data_wadir['nip_npak'];
        $ttd_wadir1 = $data_wadir['ttd'];
        $status_wadir1 = $data_wadir['status'];
    }
}


error_reporting(0);
?>
<!DOCTYPE html>
<html>

<head>
    <title></title>
    <style type="text/css">
        table {
            border-style: double;
            border-width: 4px;
            border-color: white;
        }

        table tr,
        td .text2 {
            vertical-align: top !important;
            text-align: justify;
            font-size: 16px;
        }

        .parent {
            position: relative;
            top: 0;
            left: 0;
        }

        .image1 {
            position: relative;
            top: 0;
            left: 0;
        }

        .image2 {
            position: absolute;
            top: 0px;
            left: 85px;

        }

        /* Kode CSS Untuk PAGE ini dibuat oleh http://jsfiddle.net/2wk6Q/1/ */
        body {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            background-color: #FAFAFA;
            font: 12pt "Times New Roman";
        }

        * {
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }

        .page {
            width: 210mm;
            min-height: 297mm;

        }

        @page {
            size: A4;
            /* margin: 0; */
        }

        @media print {

            html,
            body {
                width: 210mm;
                height: 297mm;
            }

            .page {
                margin: 20mm 20mm 20mm 30mm;
                border: initial;
                border-radius: initial;
                width: initial;
                min-height: initial;
                box-shadow: initial;
                background: initial;
                page-break-after: always;
            }
        }
    </style>
</head>

<body>
    <center>
        <div class="page">
            <table width="600">
                <tr>
                    <td>
                        <center>
                            <font size="4"><strong>SURAT PERMOHONAN IZIN AKTIF AKADEMIK</strong> </font>
                        </center>
                    </td>
                </tr>
                <tr></tr>
                <tr></tr>
            </table>

            <table width="600">
                <tr>
                    <td width="250">Kepada</td>
                    <td width=""></td>
                    <td width="200"></td>
                </tr>
                <tr>
                    <td width="250">
                        Direktur Politeknik Negeri Cilacap
                    </td>
                    <td width="20"></td>
                    <td width="200"></td>
                </tr>
            </table>
            <table width="600">
                <tr>
                    <td>
                        <font size="3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Yang bertanda tangan di bawah ini, saya:</font>
                    </td>
                </tr>
            </table>

            <table width="600">
                <tr>
                    <td width="150">nama</td>
                    <td width="20"><span>:</span>
                    <td>
                    <td width=""><?= $nama; ?></td>
                </tr>
                <tr>
                    <td width="150">NPM</td>
                    <td width="20"><span>:</span>
                    <td>
                    <td width=""><?= $nim; ?></td>
                </tr>
                <tr>
                    <td width="150">kelas/semester</td>
                    <td width="20"><span>:</span>
                    <td>
                    <td width=""><?= $kelas; ?> / <?= $result['semester_cuti']; ?></td>
                </tr>
                <tr>
                    <td width="150">jurusan</td>
                    <td width="20"><span>:</span>
                    <td>
                    <td width=""><?= $nm_jurusan; ?></td>
                </tr>
                <tr>
                    <td width="150">no. telp/handphone</td>
                    <td width="20"><span>:</span>
                    <td>
                    <td width=""><?= $no_telp; ?></td>
                </tr>
                <tr>
                    <td width="150">alamat lengkap</td>
                    <td width="20"><span>:</span>
                    <td>
                    <td width=""><?= $alamat; ?></td>
                </tr>

            </table>

            <table width="600">
                <tr>
                    <td>
                        <font size="3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; dengan ini mengajukan izin aktif kembali untuk mengikuti kegiatan akademik mulai</font>
                    </td>
                </tr>
            </table>

            <table width="600">
                <tr>
                    <td width="150">semester</td>
                    <td width="20">:
                    <td>
                    <td width="450"> <?= $result['semester_cuti']; ?> </td>
                </tr>
                <tr>
                    <td width="150">tahun akademik</td>
                    <td width="20">:
                    <td>
                    <td width="450"><?= $result['thn_akademik']; ?></td>
                </tr>
            </table>

            <table width="600">
                <tr>
                    <td>
                        <font size="3">Sebagai bahan pertimbangan, bersama ini kami lampirkan:<br></font>
                        <font size="3">1. Bukti pembayaran SPP terakhir <br></font>
                        <font size="3">2. KTM yang masih berlaku <br></font>
                        <font size="3">3. Kartu perpustakaan <br></font>
                        <font size="3">4. Surat keterangan lain yang relevan (surat keterangan sakit, surat keterangan bekerja, dll)</font>
                    </td>
                </tr>
            </table>
            <table width="600">
                <tr>
                    <td>
                        <font size="3">&nbsp;&nbsp;&nbsp; Demikian surat permohonan aktif kembali ini kami buat. Atas perhatian dan kebijaksanaannya kami ucapkan terima kasih.</font>
                    </td>
                </tr>
            </table>

            <table width="600">
                <tr>
                    <td width=""></td>
                    <td width="80"></td>
                    <td width="">Cilacap, <?= tgl($result['tgl_pengajuan']); ?></td>
                </tr>
                <tr>
                    <td colspan="3">
                        <font size="3">Mengetahui</font>
                    </td>
                </tr>
                <tr>
                    <td align="center">
                        <font size="3">Orang Tua/Wali</font>
                    </td>
                    <td></td>
                    <td align="center">
                        <font size="3">Pemohon</font>
                    </td>
                </tr>

                <tr>
                    <?php
                    if (empty($result['ttd_ortu'])) {
                        $result['ttd_ortu'] = "";
                    } else { ?>

                        <td align="center">
                            <div class="parent">
                                <img src="../../../public/dist/img/materai.jpg" class="image1" width="60" height="60" alt="tanda tangan orang tua mahasiswa">
                                <img src="../../mahasiswa/pengajuan/img/<?= $result['ttd_ortu']; ?>" class="image2" width="100" height="70">
                            </div>
                        </td>
                    <?php
                    }
                    ?>
                    <td></td>
                    <?php
                    if (empty($ttd_mhs)) { ?>
                        <td align="center" width="60" height="60"></td>
                    <?php } else { ?>
                        <td align="center"><img src="../mahasiswa/img/<?= $ttd_mhs ?>" width="60" height="60" alt="tanda tangan mahasiswa"></td>
                    <?php
                    }
                    ?>
                </tr>

                <tr>
                    <td align="center"><?= $result['nama_ortu']; ?></td>
                    <td></td>
                    <td align="center"><?= $nama ?></td>
                </tr>
                <tr>
                    <td></td>
                    <td align="center">Mengetahui</td>
                    <td></td>
                </tr>
                <tr>
                    <td align="center">
                        <?php if ($nm_jurusan == 'Teknik Pengendalian Pencemaran Lingkungan') {
                            echo "Koodinator Program Studi";
                        } else {
                            echo "Ketua Jurusan";
                        } ?>
                    </td>
                    <td></td>
                    <td align="center">Wali Kelas</td>
                </tr>
                <tr>
                    <td align="center">
                        <?= $nm_jurusan; ?>
                    </td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <?php
                    if (($result['status']) >= '3' and $status_kajur == 'Diterima') {
                    ?>
                        <td align="center"><img src="../pegawai/img/<?= $ttd_kajur; ?>" width="60" height="60" alt="tanda tangan kajur"></td>
                    <?php
                    } else { ?>
                        <td align="center" width="60" height="60"></td>
                    <?php
                    }
                    ?>
                    <td></td>
                    <?php
                    if (!(is_null(($result['status']))) and $status_doswal == 'Diterima') {
                    ?>
                        <td align="center"><img src="../pegawai/img/<?= $ttd_doswal; ?>" width="60" height="60" alt="tanda tangan doswal"></td>
                    <?php
                    } else { ?>
                        <td align="center" width="60" height="60"></td>
                    <?php
                    }
                    ?>
                </tr>
                <tr>
                    <td align="center"><?= $nama_kajur; ?></td>
                    <td></td>
                    <td align="center"><?= $nama_doswal; ?></td>
                </tr>
                <tr>
                    <td align="center">NIP/NPAK. <?= $nip_kajur; ?></td>
                    <td></td>
                    <td align="center">NIP/NPAK. <?= $nip_doswal; ?></td>
                </tr>
            </table>
            <table>
                <tr>
                    <td width="200"></td>
                    <td align="center">Menyetujui</td>
                    <td width="200"></td>
                </tr>
                <tr>
                    <td></td>
                    <td align="center">Wakil Direktur 1</td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <?php
                    if ($result['status'] > '2' and $status_wadir1 == 'Diterima') {
                    ?>
                        <td align="center"><img src="../pegawai/img/<?= $ttd_wadir1; ?>" width="60" height="60" alt="tanda tangan wadir1"></td>
                    <?php
                    } else { ?>
                        <td align="center" width="60" height="60"></td>
                    <?php
                    }
                    ?>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td align="center"><?= $nama_wadir1; ?></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td align="center">NIP/NPAK. <?= $nip_wadir1; ?></td>
                    <td></td>
                </tr>
            </table>
        </div>
    </center>


    <!-- <div style="page-break-before:always;">
        <embed src="../../mahasiswa/pengajuan/img/<?= $result['lampiran']; ?>" type="application/pdf" width="100%" height="600px" />
    </div> -->

</body>

</html>
<script>
    window.print();
</script>