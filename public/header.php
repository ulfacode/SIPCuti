<?php
include "../../config/koneksi.php";
include "../halaman.php";

// fungsi isset () digunakan untuk memeriksa apakah suatu variabel sudah diatur atau belum
if (!isset($_SESSION["nama"])) {
    header("Location: ../../../index.php");
}

// saat masuk ke halaman dosen wali di cek session level masuknya siapa
// apabila dosen wali dan ketua jurusan maka session level nya diganti ke variabel lvl yang didapatkan dari multi_level.php (merubah level sesuai yang dipilih)
// if ($_SESSION['level'] == "Dosen Wali dan Ketua Jurusan") {
// $_SESSION['level'] = $_GET["lvl"];
//     $_SESSION['dua'] = "Dosen Wali dan Ketua Jurusan"; //untuk sidebar beralih akun
// } else {
//     $_SESSION['dua'] = ""; //yang tidak memiliki rangkap jabatan, tidak ada sidebar beralih akun
// }

// didapatkan dari halaman pemilihan akses
if ($_SESSION['level'] == "") {
    $_SESSION['level'] = $_GET["lvl"];
}

// pengecekan session level apakah sesuai dengan level yang ada di folder tersebut atau bukan
if ($level_halaman != $_SESSION['level']) {
    session_destroy();
    header("Location: ../../../index.php");
}



?>
<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="../dashboard/" class="nav-link">Home</a>
        </li>
        <!-- <li class="nav-item d-none d-sm-inline-block">
            <a href="../../../contact.php" class="nav-link">Contact</a>
        </li> -->
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
            <!-- <a href="../../../logout.php" class="btn">
                <i class="fas fa-power-off"></i>
            </a> -->
            <div class="navbar-search-block">
                <form class="form-inline">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                            <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>

        <!-- Notifications Dropdown Menu -->
        <?php
        // notifikasi admin
        if ($_SESSION['level'] == 'Administrator') {

            $jumlah_c = mysqli_query($conn, "SELECT count(*) AS jml FROM tb_pengajuan WHERE status = '3' AND jns_pengajuan = 'Cuti'");
            $hasil_c = mysqli_fetch_array($jumlah_c);

            $jumlah_a = mysqli_query($conn, "SELECT count(*) AS jml FROM tb_pengajuan WHERE status= '4' AND jns_pengajuan = 'Izin Aktif'");
            $hasil_a = mysqli_fetch_array($jumlah_a);

            $total = $hasil_c['jml'] + $hasil_a['jml'];

            // notifikasi bag. keuangan
        } elseif ($_SESSION['level'] == 'Bagian Keuangan') {
            $jumlah = mysqli_query($conn, "SELECT count(*) AS jml FROM tb_pengajuan WHERE jns_pengajuan = 'Cuti' AND status IS NULL");
            $hasil = mysqli_fetch_array($jumlah);

            $total = $hasil['jml'];

            // notifikasi doswal
        } elseif ($_SESSION['level'] == 'Dosen Wali') {
            $jumlah_c = mysqli_query($conn, "SELECT count(*) AS jml FROM tb_pengajuan AS p, tb_mahasiswa AS m, tb_doswal AS d, tb_pegawai AS pgw WHERE p.nim = m.nim AND m.id_doswal=d.id_doswal AND d.nip_npak=pgw.nip_npak AND pgw.nip_npak='$_SESSION[nip_npak]' AND p.jns_pengajuan = 'Cuti' AND p.status = '1'");
            $hasil_c = mysqli_fetch_array($jumlah_c);

            $jumlah_a = mysqli_query($conn, "SELECT count(*) AS jml FROM tb_pengajuan AS p, tb_mahasiswa AS m, tb_doswal AS d, tb_pegawai AS pgw WHERE p.nim = m.nim AND m.id_doswal=d.id_doswal AND d.nip_npak=pgw.nip_npak AND pgw.nip_npak='$_SESSION[nip_npak]' AND p.jns_pengajuan = 'Izin Aktif' AND p.status IS NULL");
            $hasil_a = mysqli_fetch_array($jumlah_a);

            $total = $hasil_c['jml'] + $hasil_a['jml'];

            // notifikasi kajur
        } elseif ($_SESSION['level'] == 'Ketua Jurusan') {
            $jumlah = mysqli_query($conn, "SELECT count(*) AS jml FROM tb_pengajuan AS p, tb_mahasiswa AS m, tb_kajur AS k, tb_pegawai AS pgw WHERE p.nim = m.nim AND m.id_kajur=k.id_kajur AND k.nip_npak=pgw.nip_npak AND pgw.nip_npak='$_SESSION[nip_npak]' AND p.status = '2'");
            $hasil = mysqli_fetch_array($jumlah);

            $total = $hasil['jml'];

            // notifikasi wadir1
        } elseif ($_SESSION['level'] == 'Wakil Direktur 1') {
            $jumlah = mysqli_query($conn, "SELECT count(*) AS jml FROM tb_pengajuan WHERE status = '3' AND jns_pengajuan = 'Izin Aktif'");
            $hasil = mysqli_fetch_array($jumlah);

            $total = $hasil['jml'];
        ?>
        <?php
        } else {
            $total = "";
        }
        ?>

        <!-- tampilan notif -->
        <?php
        if ($_SESSION['level'] == "Mahasiswa" or $_SESSION['level'] == "Ketua Akademik" or $_SESSION['level'] == "Bagian Perpustakaan" or $_SESSION['level'] == "Bagian Keuangan") {
            echo "&nbsp";
        } else {
        ?>
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-bell"></i>
                    <span class="badge badge-warning navbar-badge"><?= $total; ?></span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-item dropdown-header"><?= $total; ?> Notifications</span>
                    <div class="dropdown-divider"></div>
                    <a href="../pengajuan/" class="dropdown-item">
                        <i class="fas fa-envelope mr-2"></i> Verifikasi
                        <span class="float-right text-muted text-sm"><?= $total; ?> </span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                </div>
            </li>
        <?php
        }
        ?>
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>

    </ul>
</nav>
<!-- /.navbar -->