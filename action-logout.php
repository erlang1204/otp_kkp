<?php
session_start();

// Hapus semua data sesi
session_unset();
session_destroy();

// Hapus cookie yang menyimpan data sesi (jika ada)
if (isset($_COOKIE['session_data'])) {
    setcookie('session_data', '', time() - 3600, '/'); // Mengatur masa berlaku cookie ke waktu lalu
}

// Redirect ke halaman login
header("Location: http://localhost:84/otp/index.php");
exit();
?>
