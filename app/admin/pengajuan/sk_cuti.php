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
        $id_kajur = $data['id_kajur'];
        $nama = $data['nama'];
    }
}
// ambil nama jurusan
$kajur = mysqli_query($conn, "select nm_jurusan from tb_kajur WHERE id_kajur='$id_kajur'");
while ($data_kajur = mysqli_fetch_array($kajur)) {
    $nm_jurusan = $data_kajur['nm_jurusan'];
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
            /* font-size: 16px; */
        }

        /* Kode CSS Untuk PAGE ini dibuat oleh http://jsfiddle.net/2wk6Q/1/ */
        body {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            background-color: #FAFAFA;
            font-family: "Times New Roman";
            font-size: 12pt;
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
        }

        @media print {

            html,
            body {
                width: 210mm;
                height: 297mm;
                font-family: "Times New Roman";
                font-size: 12pt;
            }

            .page {
                margin: 1.5cm;
                border: initial;
                border-radius: initial;
                width: initial;
                min-height: initial;
                box-shadow: initial;
                background: initial;
                page-break-before: always;
            }
        }
    </style>
</head>

<body>
    <center>
        <div class="page">
            <table width="600">
                <tr>
                    <td><img src="../../../public/dist/img/PNC.png" width="80" height="80"></td>
                    <td>
                        <center>
                            KEMENTRIAN PENDIDIKAN DAN KEBUDAYAAN<br></font>
                            <strong>POLITEKNIK NEGERI CILACAP</strong><br></font>
                            Jl. Dr. Soetomo No.1, Sidakaya, Kec. Cilacap Sel., Kab. Cilacap, Jawa Tengah 53212<br>
                            Telepon: (0282)533329, Faksimile: (0282)537992<br>
                            Laman: www.politeknikcilacap.ac.id Email: poltec@politeknikcilacap.ac.id</font>
                        </center>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <hr>
                    </td>
                </tr>
            </table>
            <table width="600">
                <tr>
                    <td>
                        <center>
                            KEPUTUSAN DIREKTUR POLITEKNIK NEGERI CILACAP<br>
                            NOMOR :
                        </center>
                    </td>
                </tr>
            </table>
            <table width="600">
                <tr>
                    <td>
                        <center>
                            TENTANG
                        </center>
                    </td>
                </tr>
            </table>
            <table width="600">
                <tr>
                    <td>
                        <center>
                            PEMBERIAN CUTI KULIAH MAHASISWA a.n
                            <div style="text-transform:uppercase;"><?php echo $nama; ?></div>
                            <br>
                            <font style="text-transform:uppercase;">JURUSAN <?php echo "<a>" . $nm_jurusan . "</a>"; ?> <br>POLITEKNIK NEGERI CILACAP TAHUN AKADEMIK <?php echo $result['thn_akademik']; ?><br></font>
                        </center>
                    </td>
                </tr>
            </table>
            <table width="600">
                <tr>
                    <td>
                        <center>
                            DIREKTUR POLITEKNIK NEGERI CILACAP<br>
                        </center>
                    </td>
                </tr>
            </table>
            <table width="600">
                <tr class="text2">
                    <td width="100">Menimbang</td>
                    <td width="20"><span>:</span>
                    <td>
                    <td width="30">a.</td>
                    <td width="">bahwa berdasarkan surat permohonan cuti <?= $nama; ?> mahasiswa Jurusan <?= $nm_jurusan; ?>;</td>
                </tr>
                <tr class="text2">
                    <td width=""></td>
                    <td width="20"><span></span>
                    <td>
                    <td width="30">b.</td>
                    <td width="">bahwa berkenaan dengan butir a di atas, perlu diterbitkan Surat Keputusan Direktur Politeknik Negeri Cilacap.</td>
                </tr>

            </table>

            <table width="600">
                <tr class="text2">
                    <td width="100">Mengingat</td>
                    <td width="20"><span>:</span>
                    <td>
                    <td width="30">1.</td>
                    <td width="">Undang-Undang Nomor ................................................................ <br>
                        tentang ..........................................................................................;
                    </td>
                </tr>
                <tr class="text2">
                    <td width="100"></td>
                    <td width="20"><span></span>
                    <td>
                    <td width="30">2.</td>
                    <td width="">Peraturan Pemerintah Nomor ....................................................... <br>
                        tentang ..........................................................................................;
                    </td>
                </tr>
                <tr class="text2">
                    <td width="100"></td>
                    <td width="20"><span></span>
                    <td>
                    <td width="30">3.</td>
                    <td width="">Peraturan Menteri ...........................................................................
                        <br>
                        tentang ..........................................................................................;
                    </td>
                </tr>
                <tr class="text2">
                    <td width=""></td>
                    <td width="20"><span></span>
                    <td>
                    <td width="30">4.</td>
                    <td width="">Peraturan .......................................................................................
                        <br>
                        tentang ..........................................................................................
                    </td>
                </tr>

            </table>
            <table width="600">
                <tr class="text2">
                    <td>
                        <center>
                            MEMUTUSKAN :
                        </center>
                    </td>
                </tr>
            </table>
            <table width="600">
                <tr class="text2">
                    <td width="100">Menetapkan</td>
                    <td width="20"><span>:</span>
                    <td>
                    <td width="">
                        KEPUTUSAN DIREKTUR POLITEKNIK NEGERI CILACAP TENTANG
                        PEMBERIAN CUTI KULIAH MAHASISWA a.n
                        <span style="text-transform:uppercase;"><?php echo $nama; ?> JURUSAN <?= $nm_jurusan; ?></span>
                        TAHUN AKADEMIK <?= $result['thn_akademik']; ?>

                    </td>
                </tr>

            </table>
            <table width="600">
                <tr class="text2">
                    <td width="100">KESATU</td>
                    <td width="20"><span>:</span>
                    </td>
                    <td colspan="3">kepada mahasiswa di bawah ini:</td>
                </tr>
                <tr>
                    <td width="100"></td>
                    <td width="20"></td>
                    <td width="">Nama</td>
                    <td width="20">:</td>
                    <td><?= $nama; ?></td>
                </tr>
                <tr>
                    <td width="100"></td>
                    <td width="20"></td>
                    <td width="">NPM</td>
                    <td width="20">:</td>
                    <td><?= $nim; ?></td>
                </tr>
                <tr>
                    <td width="100"></td>
                    <td width="20"></td>
                    <td width="">Jurusan</td>
                    <td width="20">:</td>
                    <td><?= $nm_jurusan; ?></td>
                </tr>
                <tr>
                    <td width="100"></td>
                    <td width="20"></td>
                    <td width="100">Program Studi</td>
                    <td width="20">:</td>
                    <td><?= $result['nm_prodi']; ?></td>
                </tr>
                <tr>
                    <td width="100"></td>
                    <td width="20"></td>
                    <td width="100">Tingkat/Semester</td>
                    <td width="20">:</td>
                    <td><?= $result['tingkat']; ?> (.........) /<?= $result['semester_cuti']; ?> (.........) </td>
                </tr>
                <tr>
                    <td width="100"></td>
                    <td width="20"></td>
                    <td width="100">Tahun Akademik</td>
                    <td width="20">:</td>
                    <td><?= $result['thn_akademik']; ?></td>
                </tr>
                <tr class="text2">
                    <td width="100"></td>
                    <td width="20"></td>
                    <td colspan="3">diberikan ijin untuk cuti kuliah mulai ......................................................</td>
                </tr>
                <br>
                <tr class="text2">
                    <td width="100">KEDUA</td>
                    <td width="20"><span>:</span>
                    </td>
                    <td colspan="3">Mahasiswa tersebut pada diktum kesatu, wajib melaksanakan daftar ulang tiap semester ...............................................</td>
                </tr>
                <tr class="text2">
                    <td width="100">KETIGA</td>
                    <td width="20"><span>:</span>
                    </td>
                    <td colspan="3">Mahasiswa tersebut pada diktum kesatu wajib mengikuti kegiatan akademik mulai ....................................................</td>
                </tr>
                <tr class="text2">
                    <td width="100">KEEMPAT</td>
                    <td width="20"><span>:</span>
                    </td>
                    <td colspan="3">Keputusan Direktur ini mulai berlaku pada .............................................</td>
                </tr>
            </table>
        </div>

        <div class="page">


            <table width="600">
                <tr>
                    <td width="350"></td>
                    <td>Ditetapkan di Cilacap</td>
                </tr>
                <tr>
                    <td width="350"></td>
                    <td>
                        Pada tanggal
                        <?php echo
                        tgl($result['tgl_sk']);
                        ?>
                    </td>
                </tr>
                <tr>
                    <td width="350"></td>
                    <td>
                        Direktur Politeknik Negeri Cilacap
                        <br><br><br><br><br><br><br>
                    </td>
                </tr>

                <tr>
                    <td></td>
                    <!-- manual supaya kalau ganti direktur tidak perlu mengubah codingan -->
                    <td>...........................................................</td>
                </tr>
                <tr>
                    <td></td>
                    <td>NIP. ...................................................</td>
                </tr>
            </table>
            <div class="page">
    </center>
    <!-- </div> -->



</body>

</html>
<script>
    window.print();
</script>