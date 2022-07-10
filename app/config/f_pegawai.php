<?php
$conn = mysqli_connect("localhost", "root", "", "sistem_cuti");


function tambah($data)
{
    global $conn;
    $nip_npak = $data["nip"];
    $email = $data["email"];
    $password = $data["password"];
    $nama = $data["nama"];
    $no_telp = $data["no_telp"];
    $thn_jabatan = $data["thn_jabatan"];
    $status = $data["status"];
    $id_jabatan = $data["id_jabatan"];
    $jml_jabatan = count($id_jabatan);

    // var_dump($id_jabatan);
    // var_dump($jml_jabatan);

    $query = "INSERT INTO tb_pegawai (nip_npak, email, password, nama, thn_jabatan, status, no_telp) VALUES ('$nip_npak', '$email', '$password','$nama', '$thn_jabatan', '$status','$no_telp')";
    mysqli_query($conn, $query);
    // return mysqli_affected_rows($conn);

    if (mysqli_affected_rows($conn) > 0) {
        for ($i = 0; $i < $jml_jabatan; $i++) {
            mysqli_query($conn, "INSERT INTO tb_hak_akses (nip_npak, id_jabatan) VALUES ('$nip_npak', '$id_jabatan[$i]')");
        }
        if (mysqli_affected_rows($conn) > 0) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
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


    move_uploaded_file($tmpName, '../pegawai/img/' . $namaFileBaru);
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


    move_uploaded_file($tmpName, '../pegawai/img/' . $namaFileBaru);
    return $namaFileBaru;
}


function edit($data)
{
    global $conn;
    $nip_npak = $data["nip_npak"];
    $email = $data["email"];
    $password = $data["password"];
    $nama = $data["nama"];
    $no_telp = $data["no_telp"];
    $thn_jabatan = $data["thn_jabatan"];
    $status = $data["status"];
    // $id_jabatan = $data["id_jabatan"];
    // $jml_jabatan = count($id_jabatan);

    // var_dump($nip_npak);
    // die();

    // $h = mysqli_query($conn, "SELECT * FROM tb_hak_akses WHERE nip_npak='$nip_npak'");
    // $result = mysqli_fetch_array($q);
    // $n = 0;
    // foreach ($h as $row) {
    //     echo '<pre>';
    //     var_dump($row['id_jabatan']);
    //     echo '</pre>';

    //     foreach ($id_jabatan as $id) {
    //         echo '<pre>';
    //         var_dump('xxxx' . $id);
    //         echo '</pre>';
    //     }

    // $n++;
    // }
    // die();

    $query = "UPDATE tb_pegawai SET email='$email', password='$password', nama='$nama', thn_jabatan='$thn_jabatan', status='$status', no_telp='$no_telp' WHERE nip_npak='$nip_npak'";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
    // if (mysqli_affected_rows($conn) > 0) {
    // for ($a = 0; $a < $jml_jabatan; $a++) {
    //     // var_dump($id_jabatan[$a]);
    //     mysqli_query($conn, "UPDATE tb_hak_akses SET id_jabatan = '$id_jabatan[$a]' WHERE nip_npak='$nip_npak'");
    // }
    // if (mysqli_affected_rows($conn) > 0) {
    //     return true;
    // } else {
    //     return false;
    // }
    // } else {
    //     return false;
    // }
}



function hapus($id)
{
    global $conn;
    // mysqli_query($conn, "DELETE FROM tb_hak_akses WHERE nip_npak = '$id'");
    // if (mysqli_affected_rows($conn) > 0) {

    mysqli_query($conn, "DELETE FROM tb_pegawai WHERE nip_npak = '$id'");

    // if (mysqli_affected_rows($conn) > 0) {
    return (mysqli_affected_rows($conn));
    //     } else {
    //         return false;
    //     }
    // } else {
    //     return false;
    // }
}



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// untuk kirim email
function kirim_email($email_penerima, $nama_penerima, $judul_email, $isi_email)
{

    $email_pengirim = "ulfatunnasikhah49@gmail.com";
    $nama_pengirim = "noreply";

    //Load Composer's autoloader
    require getcwd() . 'vendor/autoload.php';

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = $email_pengirim;                     //SMTP username
        $mail->Password   = 'secret';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom($email_pengirim, $nama_pengirim);
        $mail->addAddress($email_penerima, $nama_penerima);     //Add a recipient


        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $judul_email;
        $mail->Body    = $isi_email;
        $mail->send();
        return "sukses";
    } catch (Exception $e) {
        return "gagal: {$mail->ErrorInfo}";
    }
}
