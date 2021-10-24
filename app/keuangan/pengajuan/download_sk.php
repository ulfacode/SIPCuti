<?php
if (isset($_GET['filename'])) {
    $filename    = $_GET['filename'];

    // direktori SK ada di pengguna ADMIN
    $back_dir    = "../../mahasiswa/pengajuan/img/";
    $file = $back_dir . $_GET['filename'];

    if (file_exists($file)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($file));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: private');
        header('Pragma: private');
        header('Content-Length: ' . filesize($file));
        ob_clean();
        flush();
        readfile($file);

        exit;
    } else {
        // $_SESSION['pesan'] = "Oops! File - $filename - not found ...";
        echo "File Tidak Ditemukan!";
        header("location:index.php");
    }
}
