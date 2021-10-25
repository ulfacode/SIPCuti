<?php
include "../../config/f_pengajuan.php";

$id = $_GET['id'];
$nip_npak = $_GET['nip_npak'];


// untuk tolak pengajuan
if (tolak($id, $nip_npak)) {
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
