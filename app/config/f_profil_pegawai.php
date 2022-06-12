<?php
$conn = mysqli_connect("localhost", "root", "", "sistem_cuti");


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


function editFoto($data)
{
    global $conn;
    $nip = $data["nip"];

    $foto = upload_foto();
    if (!$foto) {
        return false;
    }

    $query = "UPDATE tb_pegawai SET foto = '$foto' WHERE nip_npak = '$nip'";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

// function editFoto($data)
// {
//     global $conn;
//     $nip = htmlspecialchars($data["nip"]);
//     $foto_lama = htmlspecialchars($data["foto_lama"]);


//     $foto = upload_foto();
//     if ($foto > 0) {
//         if (!$foto) {
//             return false;
//         }
//         if ($foto != $foto_lama) {
//             $target = "../../admin/pegawai/img/" . $foto_lama;


//             unlink($target);   //hapus foto lama

//         }

//         $query = "UPDATE tb_pegawai SET
//             foto = '$foto'
//             WHERE nip_npak = '$nip'";
//     } else {

//         $query = "UPDATE tb_pegawai SET
//         foto = '$foto_lama'
//         WHERE nip_npak = '$nip'";
//     }


//     mysqli_query($conn, $query);
//     return mysqli_affected_rows($conn);
// }


function editTTD($data)
{
    global $conn;
    $nip = $data["nip"];

    $ttd = upload_ttd();
    if (!$ttd) {
        return false;
    }

    $query = "UPDATE tb_pegawai SET ttd = '$ttd' WHERE nip_npak = '$nip'";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function upload_foto()
{
    $namaFile   = $_FILES['foto']['name'];
    $ukuranFile = $_FILES['foto']['size'];
    $error      = $_FILES['foto']['error'];
    $tmpName    = $_FILES['foto']['tmp_name'];

    //cek apakah tidak ada gambar yang di upload
    if ($error === 4) {
        echo "<script>
        alert('Pilih File Foto Terlebih Dahulu!');
        </script>";
        return false;
    }

    //cek apakah yang boleh diupload
    $ekstensiValid = ['jpg', 'jpeg', 'png'];
    $ekstensi = explode('.', $namaFile);
    $ekstensi = strtolower(end($ekstensi));
    if (!in_array($ekstensi, $ekstensiValid)) {
        echo "<script>
        alert('Tolong Upload File (jpg/jpeg/png) Foto!!');
        </script>";
        return false;
    }

    //cek jika  ukuran  file   terlalu besar
    if ($ukuranFile > 10000000) {
        echo "<script>
        alert('Ukuran File Foto Terlalu Besar (MAX 10MB)!');
        </script>";
        return false;
    }

    //lolos pengecekan
    //nama baru

    $nama = $_POST['nama'];

    $namaFileBaru = ("foto_" . uniqid() . $nama);
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensi;


    move_uploaded_file($tmpName, '../../admin/pegawai/img/' . $namaFileBaru);
    return $namaFileBaru;
}



function upload_ttd()
{

    $namaFile   = $_FILES['ttd']['name'];
    $ukuranFile = $_FILES['ttd']['size'];
    $error      = $_FILES['ttd']['error'];
    $tmpName    = $_FILES['ttd']['tmp_name'];

    //cek apakah tidak ada gambar yang di upload
    if ($error === 4) {
        echo "<script>
        alert('Pilih File TTD Terlebih Dahulu!');
        </script>";
        return false;
    }

    //cek apakah yang boleh diupload
    $ekstensiValid = ['jpg', 'jpeg', 'png'];
    $ekstensi = explode('.', $namaFile);
    $ekstensi = strtolower(end($ekstensi));
    if (!in_array($ekstensi, $ekstensiValid)) {
        echo "<script>
        alert('Tolong Upload File (jpg/jpeg/png) Foto!!');
        </script>";
        return false;
    }

    //cek jika  ukuran  file   terlalu besar
    if ($ukuranFile > 10000000) {
        echo "<script>
        alert('Ukuran File Tanda Tangan Terlalu Besar (MAX 10MB)!');
        </script>";
        return false;
    }

    //lolos pengecekan
    //nama baru

    $nama = $_POST['nama'];

    $namaFileBaru = ("ttd_" . uniqid() . $nama);
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensi;


    move_uploaded_file($tmpName, '../../admin/pegawai/img/' . $namaFileBaru);
    return $namaFileBaru;
}


function edit($data)
{
    global $conn;
    $nip = $data["nip"];
    $email = $data["email"];
    $password = $data["password"];
    $nama = $data["nama"];
    $no_telp = $data["no_telp"];

    $query = "UPDATE tb_pegawai SET email='$email', password='$password', nama='$nama', no_telp='$no_telp' WHERE nip_npak='$nip'";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}
