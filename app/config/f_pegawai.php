<?php
$conn = mysqli_connect("localhost", "root", "", "sistem_cuti");


function tambah($data)
{
    global $conn;
    $nip_npak = $data["nip"];
    $email = $data["email"];
    $password = $data["password"];
    $nama = $data["nama"];
    $jabatan = $data["jabatan"];
    $no_telp = $data["no_telp"];
    $thn_jabatan = $data["thn_jabatan"];
    $status = $data["status"];


    $query = "INSERT INTO tb_pegawai (nip_npak, email, password, nama, jabatan, thn_jabatan, status, no_telp) VALUES ('$nip_npak', '$email', '$password','$nama','$jabatan', '$thn_jabatan', '$status','$no_telp')";
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
    $jabatan = $data["jabatan"];
    $no_telp = $data["no_telp"];
    $thn_jabatan = $data["thn_jabatan"];
    $status = $data["status"];


    $query = "UPDATE tb_pegawai SET email='$email', password='$password', nama='$nama', jabatan='$jabatan', thn_jabatan='$thn_jabatan', status='$status', no_telp='$no_telp' WHERE nip_npak='$nip_npak'";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}



function hapus($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM tb_pegawai WHERE nip_npak = '$id'");

    return mysqli_affected_rows($conn);
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
