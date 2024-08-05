<?php
require 'vendor/autoload.php'; 
use Dompdf\Dompdf;
use Dompdf\Options;

// Mengatur opsi Dompdf
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isRemoteEnabled', true);

// Membuat instance Dompdf
$dompdf = new Dompdf($options);

// Memulai buffer output untuk menangkap output HTML dari cetak_pdf.php
ob_start();
include('cetak_pdf.php');
$html = ob_get_clean();

// Memuat HTML ke Dompdf
$dompdf->loadHtml($html);

// (Optional) Mengatur ukuran kertas dan orientasi
$dompdf->setPaper('A4', 'portrait');

// Merender HTML menjadi PDF
$dompdf->render();

// Mengambil output PDF sebagai string
$output = $dompdf->output();

// Menentukan nama file dan path untuk menyimpan PDF
$file_name = ".pdf";
$save_path = "C:/xampp/htdocs/otp/before_enkrip/" . $file_name;

// // Menyimpan file PDF ke server
if(file_put_contents($save_path, $output)) {
    echo "<script>
            window.location.href = 'hasil.php?id=27'; 
          </script>";
} else {
    echo "Failed to save the PDF file.";
}
exit;
?>
