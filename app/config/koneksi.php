<?php 
$conn = mysqli_connect("localhost","root","","si_cuti");

if (mysqli_connect_error()){
    echo "Koneksi Database Gagal" .  mysqli_connect_error();
}
