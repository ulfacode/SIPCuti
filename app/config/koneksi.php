<?php 
$conn = mysqli_connect("localhost","root","","sistem_cuti");

if (mysqli_connect_error()){
    echo "Koneksi Database Gagal" .  mysqli_connect_error();
}
