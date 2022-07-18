<?php
include "../../config/f_pengajuan.php";

$id = $_GET['id'];
$id_pegawai = $_GET['id_pegawai'];


// untuk tolak pengajuan
if (tolak($id, $id_pegawai)) {
    echo "
            <script>
                alert('Data Berhasil Diverifikasi!');
                document.location.href = 'index.php';
            </script>
        ";
} else {
    echo "
            <script>
                alert('Data Gagal Diverifikasi!');
                document.location.href = 'index.php';
            </script>
        ";
}
