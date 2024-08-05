<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Dompdf\Dompdf;
use Dompdf\Options;


require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

require './conn/conn.php';

if (isset($_POST['submit'])) {
    $user_id = $_POST['user_id'];
    $password = $_POST['kunci'];
}
?>
