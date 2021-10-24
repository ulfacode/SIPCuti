<?php
include "../../config/koneksi.php";
include "../../config/f_bayar.php";
$id = $_GET["id_bayar"];

if (hapus($id) > 0) {
    echo "
            <script>
                alert('Data Berhasil Dihapus!');
                document.location.href = 'index.php';
            </script>
        ";
} else {
    echo "
            <script>
                alert('Data Gagal Dihapus!');
                document.location.href = 'index.php';
            </script>
        ";
}
