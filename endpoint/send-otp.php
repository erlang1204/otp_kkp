<?php
include('../conn/conn.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

try {
    // Mulai transaksi
    $conn->beginTransaction();

    // Dapatkan email dan user id dari parameter POST atau GET
    if (isset($_GET['email']) && isset($_GET['id'])) {
        $email = $_GET['email'];
        $userID = $_GET['id'];
    } else {
        throw new Exception("Email atau ID tidak ditemukan.");
    }

    // Mengambil kode verifikasi dari database
    $stmt = $conn->prepare("SELECT `verification_code` FROM `tbl_user` WHERE `tbl_user_id` = :id");
    // $stmt->bindParam(':email', $email);
    $stmt->bindParam(':id', $userID);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $verification_code = $result['verification_code'];
    } else {
        throw new Exception("User tidak ditemukan atau email/ID tidak sesuai.");
    }

    // Konfigurasi PHPMailer
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'erlangbayu7@gmail.com';
    $mail->Password = 'hlrv hthv rwgl uaby'; // Pastikan ini benar dan aman
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    // Pengaturan email
    $mail->setFrom('erlangbayu7@gmail.com', 'PT. Sinar Metrindo Perkasa');
    $mail->addAddress($email);
    $mail->addReplyTo('erlangbayu7@gmail.com', 'PT. Sinar Metrindo Perkasa');
    $mail->isHTML(true);
    $mail->Subject = 'Verification Code';

    // Isi email dengan kode verifikasi
    $mail->Body = 'Your verification code is: ' . $verification_code;
    $mail->send();

    // Simpan OTP ke dalam database (sudah dilakukan saat pembuatan kode verifikasi)

    // Mulai sesi dan set user_verification_id
    session_start();
    $_SESSION['user_verification_id'] = $userID;

    // Commit transaksi
    $conn->commit();

   // Menampilkan alert dan redirect
   echo "
   <script>
       alert('OTP Berhasil Di Kirim.');
       window.location.href = 'http://localhost:84/otp/home-admin.php';
   </script>
   ";
} catch (Exception $e) {
    // Rollback transaksi jika terjadi kesalahan
    $conn->rollBack();
    echo "Failed to send verification code. Error: " . $e->getMessage();
}

?>
