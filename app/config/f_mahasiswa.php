<?php
$conn = mysqli_connect("localhost", "root", "", "sistem_cuti");


function tambah($data)
{
    global $conn;
    $nim = $data["nim"];
    $doswal = $data["doswal"];
    $kajur = $data["kajur"];
    $username = $data["username"];
    $password = $data["password"];
    $nama = $data["nama"];
    $thn_angkatan = $data["thn_angkatan"];
    $kelas = $data["kelas"];
    $tempat_lhr = $data["tempat_lhr"];
    $tgl_lhr = $data["tgl_lhr"];
    $jk = $data["jk"];
    $alamat = $data["alamat"];
    $no_telp = $data["no_telp"];


    // $foto = upload_foto();
    // if (!$foto) {
    //     return false;
    // }


    // $ttd = upload_ttd();
    // if (!$ttd) {
    //     return false;
    // }


    $query = "INSERT INTO tb_mahasiswa (nim, id_doswal, id_kajur, username, password, nama, thn_angkatan, kelas, tempat_lhr, tgl_lhr, jk, alamat, no_telp) VALUES ('$nim', '$doswal', '$kajur', '$username', '$password','$nama',
    '$thn_angkatan', '$kelas', '$tempat_lhr', '$tgl_lhr', '$jk', '$alamat','$no_telp')";
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
        alert('Ukuran File Foto Terlalu Besar (MAX 10MB) ');
        </script>";
        return false;
    }

    //lolos pengecekan
    //nama baru

    $nama = $_POST['nama'];

    $namaFileBaru = ("foto_" . uniqid() . $nama);
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensi;


    move_uploaded_file($tmpName, '../mahasiswa/img/' . $namaFileBaru);
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
        alert('Ukuran File Tanda Tangan Terlalu Besar (MAX 10MB) ');
        </script>";
        return false;
    }

    //lolos pengecekan
    //nama baru

    $nama = $_POST['nama'];

    $namaFileBaru = ("ttd_" . uniqid() . $nama);
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensi;


    move_uploaded_file($tmpName, '../mahasiswa/img/' . $namaFileBaru);
    return $namaFileBaru;
}


function edit($data)
{
    global $conn;
    $nim = $data["nim"];
    $id_doswal = $data["id_doswal"];
    $id_kajur = $data["id_kajur"];
    $username = $data["username"];
    $password = $data["password"];
    $nama = $data["nama"];
    $thn_angkatan = $data["thn_angkatan"];
    $kelas = $data["kelas"];
    $tempat_lhr = $data["tempat_lhr"];
    $tgl_lhr = $data["tgl_lhr"];
    $jk = $data["jk"];
    $alamat = $data["alamat"];
    $no_telp = $data["no_telp"];

    $query = "UPDATE tb_mahasiswa SET id_doswal='$id_doswal', id_kajur='$id_kajur', username='$username', password='$password', nama='$nama', thn_angkatan='$thn_angkatan', kelas='$kelas', tempat_lhr='$tempat_lhr', tgl_lhr='$tgl_lhr', jk='$jk', alamat='$alamat', no_telp='$no_telp' WHERE nim='$nim'";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

// untuk menampilkan data nama doswal dan nama kajur dari database
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
    mysqli_query($conn, "DELETE FROM tb_mahasiswa WHERE nim = '$id'");

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
