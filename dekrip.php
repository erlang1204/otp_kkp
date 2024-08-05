<?php
require 'lib/aes.php';
require 'lib/aesctr.php';

$key = $_POST['kunci'];
$namaFile = file_get_contents($_FILES['doc']['tmp_name']);
$encFile = AesCtr::decrypt($namaFile, $key, 128);

// Check if the decrypted content is valid
if ($encFile === false || empty($encFile)) {
    echo "<script>
            alert('Key Tidak Valid atau File Tidak Bisa Didekripsi');
            window.history.back(); // Go back to the previous page
          </script>";
    exit;
}

// Save the decrypted file temporarily
$tempFilePath = "hasil_dekrip/" . $_FILES['doc']['name'];
file_put_contents($tempFilePath, $encFile);

// Trigger the download
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . basename($tempFilePath) . '"');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($tempFilePath));
readfile($tempFilePath);

// Delete the temporary file after download
unlink($tempFilePath);
exit;
?>
