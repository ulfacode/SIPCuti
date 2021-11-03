<?php
$conn = mysqli_connect("localhost", "root", "", "sistem_cuti");


// untuk menambahkan pengajuan cuti
function tambahCuti($data)
{
    global $conn;
    $nim = $data["nim"];
    $jns_pengajuan = $data["jns_pengajuan"];
    $tgl_pengajuan = $data["tgl_pengajuan"];
    $semester_cuti = $data["semester_cuti"];
    $tingkat = $data["tingkat"];
    $thn_akademik = $data["thn_akademik"];
    $nm_prodi = $data["nm_prodi"];
    $alasan = $data["alasan"];
    $nama_ortu = $data["nama_ortu"];

    $ttd_ortu = upload_ttd();
    if (!$ttd_ortu) {
        return false;
    }

    $lampiran = upload_lampiran();
    if (!$lampiran) {
        return false;
    }


    // cek pengajuan, jika ada akan gagal
    $Cuti = mysqli_query($conn, "SELECT * FROM tb_pengajuan WHERE nim = '$nim' AND jns_pengajuan = 'Cuti'");
    $status = mysqli_fetch_array($Cuti);

    // if ((mysqli_num_rows($Cuti) == NULL) OR $status['status']=="5") {
    if (mysqli_num_rows($Cuti) == NULL or ($status['status'] == "5")) {

        $query = "INSERT INTO tb_pengajuan 
                (nim, jns_pengajuan, tgl_pengajuan, semester_cuti, tingkat, thn_akademik, nm_prodi, alasan, lampiran, ttd_ortu, nama_ortu) 
                VALUES 
                ('$nim', '$jns_pengajuan', '$tgl_pengajuan', '$semester_cuti', '$tingkat', '$thn_akademik', '$nm_prodi', '$alasan', '$lampiran', '$ttd_ortu', '$nama_ortu')";
        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
    } else {
        echo "
            <script> 
                alert('Data Gagal Ditambahkan (Maksimal Pengajuan Satu Kali)!');
                document.location.href = 'index.php';
            </script>
        ";
    }
}


function tambahAktif($data)
{
    global $conn;
    $nim = $data["nim"];
    $jns_pengajuan = $data["jns_pengajuan"];
    $tgl_pengajuan = $data["tgl_pengajuan"];
    $semester_cuti = $data["semester_cuti"];
    $tingkat = $data["tingkat"];
    $thn_akademik = $data["thn_akademik"];
    $nm_prodi = $data["nm_prodi"];
    $nama_ortu = $data["nama_ortu"];

    $ttd_ortu = up_ttd_aktif();
    if (!$ttd_ortu) {
        return false;
    }

    $lampiran = up_lampiran_aktif();
    if (!$lampiran) {
        return false;
    }

    // cek pengajuan, jika ada akan gagal
    $Cuti = mysqli_query($conn, "SELECT * FROM tb_pengajuan WHERE nim = '$nim' AND jns_pengajuan = 'Cuti'");
    $status_cuti = mysqli_fetch_array($Cuti);

    $Aktif = mysqli_query($conn, "SELECT * FROM tb_pengajuan WHERE nim = '$nim' AND jns_pengajuan = 'Izin Aktif'");
    $status = mysqli_fetch_array($Aktif);

    if ((empty(mysqli_num_rows($Aktif)) or $status['status'] == '5') and ((!empty(mysqli_num_rows($Cuti))) and $status_cuti['status'] == '4')) {
        $query = "INSERT INTO tb_pengajuan 
                (nim, jns_pengajuan, tgl_pengajuan, semester_cuti, tingkat, thn_akademik, nm_prodi, lampiran, ttd_ortu, nama_ortu) 
                VALUES 
                ('$nim', '$jns_pengajuan', '$tgl_pengajuan', '$semester_cuti', '$tingkat', '$thn_akademik', '$nm_prodi', '$lampiran', '$ttd_ortu', '$nama_ortu')";
        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
    } else {
        echo "
            <script> 
                alert('Data Gagal Ditambahkan (Maksimal Pengajuan Satu Kali dan Pastikan Sudah Mengajukan Cuti)!');
                document.location.href = 'index.php';
            </script>
        ";
    }
}


// lampiran pengajuan cuti
function upload_lampiran()
{

    $namaFile   = $_FILES['lampiran']['name'];
    $ukuranFile = $_FILES['lampiran']['size'];
    $error      = $_FILES['lampiran']['error'];
    $tmpName    = $_FILES['lampiran']['tmp_name'];

    //cek apakah tidak ada gambar yang di upload
    if ($error === 4) {
        echo "<script>
        alert('Pilih File Lampiran Terlebih Dahulu!');
        </script>";
        return false;
    }

    //cek apakah yang boleh diupload
    $ekstensiValid = ['pdf'];
    $ekstensi = explode('.', $namaFile);
    $ekstensi = strtolower(end($ekstensi));
    if (!in_array($ekstensi, $ekstensiValid)) {
        echo "<script>
        alert('Tolong Upload File Lampiran dalam Bentuk PDF!!');
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

    $nim = $_POST['nim'];

    $namaFileBaru = ("lampiran_cuti" . uniqid() . $nim);
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensi;


    move_uploaded_file($tmpName, '../pengajuan/img/' . $namaFileBaru);
    return $namaFileBaru;
}

function upload_ttd()
{

    $namaFile   = $_FILES['ttd_ortu']['name'];
    $ukuranFile = $_FILES['ttd_ortu']['size'];
    $error      = $_FILES['ttd_ortu']['error'];
    $tmpName    = $_FILES['ttd_ortu']['tmp_name'];

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

    $nim = $_POST['nim'];

    $namaFileBaru = ("ortu_cuti" . uniqid() . $nim);
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensi;


    move_uploaded_file($tmpName, '../pengajuan/img/' . $namaFileBaru);
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
    mysqli_query($conn, "DELETE FROM tb_pengajuan WHERE id_pengajuan = '$id'");

    return mysqli_affected_rows($conn);
}


// lampiran pengajuan aktif
function up_lampiran_aktif()
{

    $namaFile   = $_FILES['lampiran']['name'];
    $ukuranFile = $_FILES['lampiran']['size'];
    $error      = $_FILES['lampiran']['error'];
    $tmpName    = $_FILES['lampiran']['tmp_name'];

    //cek apakah tidak ada gambar yang di upload
    if ($error === 4) {
        echo "<script>
            alert('Pilih File Lampiran Terlebih Dahulu!');
            </script>";
        return false;
    }

    //cek apakah yang boleh diupload
    $ekstensiValid = ['pdf'];
    $ekstensi = explode('.', $namaFile);
    $ekstensi = strtolower(end($ekstensi));
    if (!in_array($ekstensi, $ekstensiValid)) {
        echo "<script>
            alert('Tolong Upload File Lampiran dalam Bentuk PDF!!');
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

    $nim = $_POST['nim'];

    $namaFileBaru = ("lampiran_aktif" . uniqid() . $nim);
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensi;


    move_uploaded_file($tmpName, '../pengajuan/img/' . $namaFileBaru);
    return $namaFileBaru;
}

function up_ttd_aktif()
{

    $namaFile   = $_FILES['ttd_ortu']['name'];
    $ukuranFile = $_FILES['ttd_ortu']['size'];
    $error      = $_FILES['ttd_ortu']['error'];
    $tmpName    = $_FILES['ttd_ortu']['tmp_name'];

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

    $nim = $_POST['nim'];

    $namaFileBaru = ("ortu_aktif" . uniqid() . $nim);
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensi;


    move_uploaded_file($tmpName, '../pengajuan/img/' . $namaFileBaru);
    return $namaFileBaru;
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


// untuk edit pengajuan
function editP($data)
{
    global $conn;
    $id_pengajuan = $data["id_pengajuan"];
    $jns_pengajuan = $data["jns_pengajuan"];
    $semester_cuti = $data["semester_cuti"];
    $tingkat = $data["tingkat"];
    $thn_akademik = $data["thn_akademik"];
    $nm_prodi = $data["nm_prodi"];
    $nama_ortu = $data["nama_ortu"];
    $alasan = $data["alasan"];

    if ($jns_pengajuan == 'Izin Aktif') {
        $query = "UPDATE tb_pengajuan SET semester_cuti='$semester_cuti', tingkat='$tingkat', thn_akademik='$thn_akademik', nm_prodi='$nm_prodi', nama_ortu='$nama_ortu' WHERE id_pengajuan='$id_pengajuan'";
        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
    } else {
        $query = "UPDATE tb_pengajuan SET semester_cuti='$semester_cuti', tingkat='$tingkat', thn_akademik='$thn_akademik', nm_prodi='$nm_prodi', alasan='$alasan', nama_ortu='$nama_ortu' WHERE id_pengajuan='$id_pengajuan'";
        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
    }
}




// untuk edit lampiran
function editLampiran($data)
{
    global $conn;
    $id_pengajuan = $data["id_pengajuan"];
    $jns_pengajuan = $data["jns_pengajuan"];
    if ($jns_pengajuan == 'Izin Aktif') {
        $lampiran = up_lampiran_aktif();
        if (!$lampiran) {
            return false;
        }
    } else {
        $lampiran = upload_lampiran();
        if (!$lampiran) {
            return false;
        }
    }

    $query = "UPDATE tb_pengajuan SET lampiran = '$lampiran' WHERE id_pengajuan = '$id_pengajuan'";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

// untuk edit ttd
function editTTD($data)
{
    global $conn;
    $id_pengajuan = $data["id_pengajuan"];
    $jns_pengajuan = $data["jns_pengajuan"];
    if ($jns_pengajuan == "Izin Aktif") {
        $ttd_ortu = up_ttd_aktif();
        if (!$ttd_ortu) {
            return false;
        }
    } else {
        $ttd_ortu = upload_ttd();
        if (!$ttd_ortu) {
            return false;
        }
    }

    $query = "UPDATE tb_pengajuan SET ttd_ortu = '$ttd_ortu' WHERE id_pengajuan = '$id_pengajuan'";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}


// untuk ACC pengajuan 
function terima($id, $nip_npak, $jabatan)
{
    global $conn;
    // date_default_timezone_set('Asia/Jakarta');
    // $jam = date('G:i:s'); //akan menampilkan 18:07:10 WIB
    $tgl = date('Y-m-d');

    // verifikasi dosen wali
    if ($jabatan == "Dosen Wali") {
        mysqli_query($conn, "UPDATE tb_pengajuan SET status = '1' WHERE id_pengajuan = '$id'");

        if (mysqli_affected_rows($conn) > 0) {
            mysqli_query($conn, "INSERT INTO tb_verifikasi (id_pengajuan, nip_npak, tgl_verif) VALUES ('$id','$nip_npak','$tgl')");
            if (mysqli_affected_rows($conn) > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    // verifikasi ketua jurusan
    elseif ($jabatan == "Ketua Jurusan") {
        mysqli_query($conn, "UPDATE tb_pengajuan SET status = '2' WHERE id_pengajuan = '$id'");

        if (mysqli_affected_rows($conn) > 0) {
            mysqli_query($conn, "INSERT INTO tb_verifikasi (id_pengajuan, nip_npak, tgl_verif) VALUES ('$id','$nip_npak','$tgl')");
            if (mysqli_affected_rows($conn) > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    // verifikasi wadir1
    elseif ($jabatan == "Wakil Direktur 1") {
        mysqli_query($conn, "UPDATE tb_pengajuan SET status = '3' WHERE id_pengajuan = '$id'");

        if (mysqli_affected_rows($conn) > 0) {
            mysqli_query($conn, "INSERT INTO tb_verifikasi (id_pengajuan, nip_npak, tgl_verif) VALUES ('$id','$nip_npak','$tgl')");
            if (mysqli_affected_rows($conn) > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    // verifikasi BAAK
    elseif ($jabatan == "Administrator") {
        mysqli_query($conn, "UPDATE tb_pengajuan SET status = '4' WHERE id_pengajuan = '$id'");

        if (mysqli_affected_rows($conn) > 0) {
            mysqli_query($conn, "INSERT INTO tb_verifikasi (id_pengajuan, nip_npak, tgl_verif) VALUES ('$id','$nip_npak','$tgl')");
            if (mysqli_affected_rows($conn) > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    } else {
        return false;
    }
}


// untuk tolak pengajuan 
function tolak($id, $nip_npak)
{
    global $conn;
    $tgl = date("Y-m-d");

    mysqli_query($conn, "UPDATE tb_pengajuan SET status = '5' WHERE id_pengajuan = '$id'");

    if (mysqli_affected_rows($conn) > 0) {
        mysqli_query($conn, "INSERT INTO tb_verifikasi (id_pengajuan, nip_npak, tgl_verif) VALUES ('$id','$nip_npak','$tgl')");
        if (mysqli_affected_rows($conn) > 0) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}


// function upload_sk
function up_sk()
{

    $namaFile   = $_FILES['upload_sk']['name'];
    $ukuranFile = $_FILES['upload_sk']['size'];
    $error      = $_FILES['upload_sk']['error'];
    $tmpName    = $_FILES['upload_sk']['tmp_name'];

    //cek apakah tidak ada gambar yang di upload
    if ($error === 4) {
        echo "<script>
        alert('Pilih File Terlebih Dahulu!');
        </script>";
        return false;
    }

    //cek apakah yang boleh diupload
    $ekstensiValid = ['pdf'];
    $ekstensi = explode('.', $namaFile);
    $ekstensi = strtolower(end($ekstensi));
    if (!in_array($ekstensi, $ekstensiValid)) {
        echo "<script>
        alert('Tolong Upload File Dalam Bentuk PDF!');
        </script>";
        return false;
    }

    //cek jika  ukuran  file   terlalu besar
    if ($ukuranFile > 10000000) {
        echo "<script>
        alert('Ukuran File Terlalu Besar (MAX 10MB) ');
        </script>";
        return false;
    }

    //lolos pengecekan
    //nama baru

    $nim = $_POST['nim'];

    $namaFileBaru = ("sk_" . uniqid() . "_" . $nim);
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensi;


    move_uploaded_file($tmpName, '../pengajuan/surat_keputusan/' . $namaFileBaru);
    return $namaFileBaru;
}


// untuk upload SK yang sudah di ttd direktur dan cap pnc
function upload_sk($data)
{
    global $conn;
    $id_pengajuan = $data['id_pengajuan'];

    $sk = up_sk();
    if (!$sk) {
        return false;
    }

    mysqli_query($conn, "SELECT upload_sk FROM tb_pengajuan WHERE id_pengajuan = '$id_pengajuan'");
    if (mysqli_affected_rows($conn) > 0) {
        mysqli_query($conn, "UPDATE tb_pengajuan SET upload_sk = '$sk' WHERE id_pengajuan = '$id_pengajuan'");
        return mysqli_affected_rows($conn);
    } else {
        mysqli_query($conn, "INSERT INTO tb_pengajuan (upload_sk) VALUES ($sk)");
        return mysqli_affected_rows($conn);
    }
}
