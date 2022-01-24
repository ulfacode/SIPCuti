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
        $ttd = $data['ttd'];
    }
}

// ambil data doswal
$sql2 = mysqli_query($conn, "select p.nama, p.ttd, p.nip_npak from tb_doswal as d, tb_pegawai as p WHERE d.nip_npak=p.nip_npak AND id_doswal='$id_doswal'");
while ($data_doswal = mysqli_fetch_array($sql2)) {
    $nama_doswal = $data_doswal['nama'];
    $nip_doswal = $data_doswal['nip_npak'];
    $ttd_doswal = $data_doswal['ttd'];
}
// ambil data kajur
$kajur = mysqli_query($conn, "select p.nama, p.ttd, p.nip_npak, k.nm_jurusan from tb_pegawai as p, tb_kajur as k WHERE p.nip_npak=k.nip_npak AND id_kajur='$id_kajur'");
while ($data_kajur = mysqli_fetch_array($kajur)) {
    $nama_kajur = $data_kajur['nama'];
    $nm_jurusan = $data_kajur['nm_jurusan'];
    $nip_kajur = $data_kajur['nip_npak'];
    $ttd_kajur = $data_kajur['ttd'];
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
                            <font size="4"><strong>SURAT PERMOHONAN CUTI AKADEMIK</strong> </font>
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
                        <font size="3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; dengan ini mengajukan penghentian sementara (cuti akademik)</font>
                    </td>
                </tr>
            </table>

            <table width="600">
                <tr>
                    <td width="150">pada semester</td>
                    <td width="20">:
                    <td>
                    <td width="450"> <?= $result['semester_cuti']; ?> masuk kembali di semester <?= $result['semester_cuti']; ?></td>
                </tr>
                <tr>
                    <td width="150">tahun akademik</td>
                    <td width="20">:
                    <td>
                    <td width="450" colspan="2"><?= $result['thn_akademik']; ?></td>
                </tr>
                <tr>
                    <td width="150">alasan cuti</td>
                    <td width="20">:
                    <td>
                    <td width="450" colspan="2"><?= $result['alasan']; ?></td>
                </tr>

            </table>

            <table width="600">
                <tr class="text2">
                    <td>
                        <font size="3">Ketentuan: <br></font>
                        <font size="3">1. Jangka waktu cuti akademik adalah satu tahun (dua semester) <br></font>
                        <font size="3">2. Melakukan daftar ulang sebesar 25% dari biaya kuliah tiap semester</font>
                    </td>
                </tr>
            </table>
            <table width="600S">
                <tr class="text2">
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
                        <font size="3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Demikian surat permohonan cuti ini kami buat. Atas perhatian dan kebijaksanaannya kami ucapkan terima kasih.</font>
                    </td>
                </tr>
            </table>

            <table width="600">
                <tr>
                    <td width="230"></td>
                    <td width=""></td>
                    <td width="230">Cilacap, <?= tgl($result['tgl_pengajuan']); ?></td>
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
                    if (empty($result['ttd_ortu'])) { ?>
                        <td align="center" width="60" height="60"></td>
                    <?php } else { ?>

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
                    if (empty($ttd)) { ?>
                        <td align="center" width="60" height="60"></td>
                    <?php } else { ?>
                        <td align="center"><img src="../mahasiswa/img/<?= $ttd ?>" width="60" height="60" alt="tanda tangan mahasiswa"></td>
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
                    <td align="center">Menyetujui</td>
                    <td></td>
                </tr>
                <tr>
                    <td align="center">
                        Ketua Jurusan
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
                    if (($result['status']) > '1') {
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
                    if (!(is_null(($result['status'])))) {
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
                    <td align="center"><?= $nama_doswal ?></td>
                </tr>
                <tr>
                    <td align="center"><?= $nip_kajur; ?></td>
                    <td></td>
                    <td align="center"><?= $nip_doswal ?></td>
                </tr>
            </table>
        </div>
    </center>

    <!-- <div style="page-break-before:always;">
    </div> -->

</body>

</html>
<script>
    window.print();
</script>