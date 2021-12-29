<?php
$conn = mysqli_connect("localhost", "root", "", "sistem_cuti");

use PHPMailer\PHPMailer\PHPMailer;

include 'public/PHPMailer/Exception.php';
include 'public/PHPMailer/PHPMailer.php';
include 'public/PHPMailer/SMTP.php';

// kirim email dan update token
function lupa_password($data)
{
    global $conn;
    $email = $data["email"];
    $m_sql = mysqli_query($conn, "SELECT nim FROM tb_mahasiswa WHERE email = '$email'");
    $p_sql = mysqli_query($conn, "SELECT nip_npak FROM tb_pegawai WHERE email = '$email'");

    $token = md5(rand('10000', '999999'));

    if (mysqli_num_rows($m_sql) > 0) {
        $query = mysqli_query($conn, "UPDATE tb_mahasiswa set token = '$token' WHERE email = '$email'");

        if ($query) {
            //Instantiation and passing `true` enables exceptions
            $url = 'https://' . $_SERVER['SERVER_NAME'] . '/sipcuti/ganti_pass.php?token=' . $token . '&email=' . $email;
            $output = '<div>Silahkan mengklik link dibawah ini untuk mengaktifkan akun anda <br><br>' . $url . '</div>';
            $mail = new PHPMailer();

            //Server settings
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER; //Enable verbose debug output
            $mail->isSMTP(); //Send using SMTP
            $mail->Host = 'smtp.gmail.com'; //Set the SMTP server to send through
            $mail->SMTPAuth = true; //Enable SMTP authentication
            $mail->Username = 'ulfatunnasikhah29@gmail.com'; //SMTP username
            $mail->Password = 'ulfamail'; //SMTP password
            $mail->SMTPSecure = 'tls'; //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port = 587; //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            //Kalau ini pilihan, silahkan sesuai keinginan anda....
            $mail->setFrom('ulfatunnasikhah29@gmail.com', 'Localhost');
            $mail->addAddress($email, ''); //Add a recipient
            /*
            $mail->addAddress('ellen@example.com'); //Name is optional
            $mail->addReplyTo('info@example.com', 'Information');
            $mail->addCC('cc@example.com');
            $mail->addBCC('bcc@example.com');
            */

            //Attachments
            /*
            $mail->addAttachment('/var/tmp/file.tar.gz'); //Add attachments
            $mail->addAttachment('/tmp/image.jpg', 'new.jpg'); //Optional name
            */

            //Content
            $mail->isHTML(true); //Set email format to HTML
            $mail->Subject = 'Verifikasi Ganti Password';
            $mail->Body = $output;
            //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            if ($mail->send()) {
                //Jika berhasil
                return true;
            } else {
                //Jika PHP Mailer Gagal
                // echo "<script>console.log('jika PHP Mailer Gagal')</script>";
                return false;
            }
        }
    } elseif (mysqli_num_rows($p_sql) > 0) {
        $query = mysqli_query($conn, "UPDATE tb_pegawai set token = '$token' WHERE email = '$email'");

        if ($query) {
            //Instantiation and passing `true` enables exceptions
            $url = 'https://' . $_SERVER['SERVER_NAME'] . '/sipcuti/ganti_pass.php?token=' . $token . '&email=' . $email;
            $output = '<div>Silahkan mengklik link dibawah ini untuk mengaktifkan akun anda <br><br>' . $url . '</div>';
            $mail = new PHPMailer();

            //Server settings
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER; //Enable verbose debug output
            $mail->isSMTP(); //Send using SMTP
            $mail->Host = 'smtp.gmail.com'; //Set the SMTP server to send through
            $mail->SMTPAuth = true; //Enable SMTP authentication
            $mail->Username = 'ulfatunnasikhah29@gmail.com'; //SMTP username
            $mail->Password = 'ulfamail'; //SMTP password
            $mail->SMTPSecure = 'tls'; //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port = 587; //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            //Kalau ini pilihan, silahkan sesuai keinginan anda....
            $mail->setFrom('ulfatunnasikhah29@gmail.com', 'SistemPengajuanCuti');
            $mail->addAddress($email, ''); //Add a recipient
            /*
            $mail->addAddress('ellen@example.com'); //Name is optional
            $mail->addReplyTo('info@example.com', 'Information');
            $mail->addCC('cc@example.com');
            $mail->addBCC('bcc@example.com');
            */

            //Attachments
            /*
            $mail->addAttachment('/var/tmp/file.tar.gz'); //Add attachments
            $mail->addAttachment('/tmp/image.jpg', 'new.jpg'); //Optional name
            */

            //Content
            $mail->isHTML(true); //Set email format to HTML
            $mail->Subject = 'Verifikasi Ganti Password';
            $mail->Body = $output;
            //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            if ($mail->send()) {
                //Jika berhasil
                return true;
            } else {
                //Jika PHP Mailer Gagal
                // return false;
                echo "
            <script>
                alert('PHP Mailer gagal mengirim email!');
                document.location.href = 'index.php';
            </script>
            ";
            }
        }
        // jika berhasil update token
        // return true;
    }
    //jika email tidak ada di database   
    else {
        // return false;
        echo "
            <script>
                alert('Email tidak ada!');
                document.location.href = 'index.php';
            </script>
            ";
    }
}

// update password
function ganti_password($data)
{
    global $conn;

    $email = $data['email'];
    $password = $data['password'];
    $Repassword = $data['Repassword'];
    $token = $data['token'];


    // cek email ada di tabel mana
    // cek token ada tidak di tabel
    $m = mysqli_query($conn, "SELECT email, token FROM tb_mahasiswa WHERE email='$email'");
    $p = mysqli_query($conn, "SELECT email, token FROM tb_pegawai WHERE email='$email'");
    $data_m = mysqli_fetch_assoc($m);
    $data_p = mysqli_fetch_assoc($p);


    // cek password == konfirmasi password tidak
    if ($password != $Repassword) {
        echo "
            <script>
                alert('Konfirmasi Password Berbeda');
                document.location.href = 'ganti_pass.php?email=$email&token=$token';
            </script>
        ";
    } else {
        // jika email ada di tabel mahasiswa dan token ada di tabel mahasiswa sesuai email
        if ((mysqli_num_rows($m) > 0) and ($token == $data_m['token'])) {
            $query = mysqli_query($conn, "UPDATE tb_mahasiswa SET password='$password', token='' WHERE email = '$email'");
            echo "
            <script>
                alert('Password berhasil diganti');
                document.location.href = 'index.php';
            </script>
        ";
        }
        // jika email ada di tabel pegawai dan token ada di tabel pegawai sesuai email
        elseif ((mysqli_num_rows($p) > 0) and ($token == $data_p['token'])) {
            $query = mysqli_query($conn, "UPDATE tb_pegawai SET password='$password', token='' WHERE email = '$email'");
            echo "
            <script>
                alert('Password berhasil diganti');
                document.location.href = 'index.php';
            </script>
        ";
        } else {
            echo "
            <script>
                alert('Token tidak bisa digunakan atau email tidak tersedia');
                document.location.href = 'index.php';
            </script>
        ";
        }
    }
}
