<?php
require 'lib/aes.php';
require 'lib/aesctr.php';

$key = $_POST['kunci'];
$namaFile = file_get_contents($_FILES['doc']['tmp_name']);
$encFile = AesCtr::encrypt($namaFile, $key, 128);
$enkrip = file_put_contents("hasil_enkrip/" . $_FILES['doc']['name'], $encFile);

if ($enkrip) {
    echo "<script>
            alert('File Berhasil Dikunci');
            window.location.href = 'home-admin.php'; // Redirect to a desired page
          </script>";
} else {
    echo "<script>
            alert('File Tidak Berhasil Dibuka');
            window.history.back(); // Go back to the previous page
          </script>";
}
?>
