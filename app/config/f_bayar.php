<?php
$conn = mysqli_connect("localhost", "root", "", "sistem_cuti");


function tambah($data)
{
    global $conn;
    $nim = $data["nim"];
    $ukt_smt = $data["ukt_smt"];
    $jumlah = $data["jumlah"];
    $tgl_bayar = $data["tgl_bayar"];
    $bukti = upload_bukti();
    if (!$bukti) {
        return false;
    }


    $query = "INSERT INTO tb_bayar 
                (nim, ukt_smt, jumlah, tgl_bayar, bukti) 
                VALUES 
                ('$nim', '$ukt_smt', '$jumlah', '$tgl_bayar', '$bukti')";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}


function upload_bukti()
{

    $namaFile   = $_FILES['bukti']['name'];
    $ukuranFile = $_FILES['bukti']['size'];
    $error      = $_FILES['bukti']['error'];
    $tmpName    = $_FILES['bukti']['tmp_name'];

    //cek apakah tidak ada gambar yang di upload
    if ($error === 4) {
        echo "<script>
        alert('Pilih File Bukti Bayar UKT Terlebih Dahulu!');
        </script>";
        return false;
    }

    //cek apakah yang boleh diupload
    $ekstensiValid = ['jpg', 'jpeg', 'png'];
    $ekstensi = explode('.', $namaFile);
    $ekstensi = strtolower(end($ekstensi));
    if (!in_array($ekstensi, $ekstensiValid)) {
        echo "<script>
        alert('Tolong Upload File (jpg/jpeg/png) Bukti Bayar UKT!!');
        </script>";
        return false;
    }

    //cek jika  ukuran  file   terlalu besar
    if ($ukuranFile > 10000000) {
        echo "<script>
        alert('Ukuran File Bukti Bayar UKT Terlalu Besar (MAX 10MB) ');
        </script>";
        return false;
    }

    //lolos pengecekan
    //nama baru

    $nim = $_POST['nim'];

    $namaFileBaru = ("bukti_" . uniqid() . $nim);
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensi;


    move_uploaded_file($tmpName, '../bayar_ukt/img/' . $namaFileBaru);
    return $namaFileBaru;
}




//untuk select
function sql($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}


function hapus($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM tb_bayar WHERE id_bayar = '$id'");

    return mysqli_affected_rows($conn);
}


function tgl($tanggal)
{
    // membuat sebuah variabel dengan nama bulanIndo dimana akan memuat array dari nama-nama bulan Indonesia mulai dari Januari sampai Desember
    $bulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

    // membuat variabel dengan nama tahun dimana mengambil empet digit pertama dari format Date yaitu tahun
    $tahun = substr($tanggal, 0, 4);

    // membuat variabel dengan nama bulan dimana mengambil dua digit mulai dari digit ke lima dari format Date yaitu bulan
    $bulan = substr($tanggal, 5, 2);

    // membuat variabel dengan nama tgl dimana mengambil dua digit mulai dari digit ke delapan dari format Date yaitu tanggal
    $tgl   = substr($tanggal, 8, 2);

    // membuat variabel result dimana variabel ini membentuk format untuk tanggal Indonesia
    $result = $tgl . " " . $bulanIndo[(int)$bulan - 1] . " " . $tahun;
    return ($result);
}



function editBukti($data)
{
    global $conn;
    $id_bayar = $data["id_bayar"];

    $bukti = upload_bukti();
    if (!$bukti) {
        return false;
    }

    $query = "UPDATE tb_bayar SET bukti = '$bukti' WHERE id_bayar = '$id_bayar'";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function edit($data)
{
    global $conn;
    $id_bayar = $data["id"];
    $ukt_smt = $data["ukt_smt"];
    $jumlah = $data["jumlah"];


    $query = "UPDATE tb_bayar SET ukt_smt = '$ukt_smt', jumlah = '$jumlah' WHERE id_bayar = '$id_bayar'";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}
function validasi($data)
{
    global $conn;
    $id_bayar = $data["id_bayar"];
    $validasi = $data["validasi"];


    $query = "UPDATE tb_bayar SET validasi = '$validasi' WHERE id_bayar = '$id_bayar'";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}
