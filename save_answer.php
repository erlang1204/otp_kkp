<?php
// saveAnswer.php
include ('./conn/conn.php');
session_start();
$first_name = isset($_SESSION['first_name']) ? $_SESSION['first_name'] : null;
if (!$first_name) {
    header("Location: http://localhost:84/otp/index.php");
    exit(); // Pastikan untuk mengakhiri eksekusi skrip setelah pengalihan
}

if (isset($_POST['soalId']) && isset($_POST['answerId'])) {
    $soalID = $_POST['soalId'];
    $jawaban = $_POST['answerId'];
    $userid = $_POST['userid'];

    // Periksa apakah jawaban sudah ada
    $stmt = $conn->prepare("SELECT COUNT(*) FROM `tbl_jawaban` WHERE `user_id` = :userid AND `soal_id` = :soalID");
    $stmt->bindParam(':userid', $userid, PDO::PARAM_STR);
    $stmt->bindParam(':soalID', $soalID, PDO::PARAM_STR);
    $stmt->execute();
    $count = $stmt->fetchColumn();

    try {
        if ($count > 0) {
            // Jika jawaban sudah ada, lakukan pembaruan
            $stmt = $conn->prepare("UPDATE `tbl_jawaban` SET `jawaban` = :jawaban WHERE `user_id` = :userid AND `soal_id` = :soalID");
            $stmt->bindParam(':userid', $userid, PDO::PARAM_STR);
            $stmt->bindParam(':soalID', $soalID, PDO::PARAM_STR);
            $stmt->bindParam(':jawaban', $jawaban, PDO::PARAM_STR);
            $stmt->execute();
            echo "Jawaban berhasil diperbarui.";
        } else {
            // Jika jawaban belum ada, lakukan penyisipan
            $stmt = $conn->prepare("INSERT INTO `tbl_jawaban` (`user_id`, `soal_id`, `jawaban`) VALUES (:userid, :soalID, :jawaban)");
            $stmt->bindParam(':userid', $userid, PDO::PARAM_STR);
            $stmt->bindParam(':soalID', $soalID, PDO::PARAM_STR);
            $stmt->bindParam(':jawaban', $jawaban, PDO::PARAM_STR);
            $stmt->execute();
            echo "Jawaban berhasil disimpan.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

} else {
    echo "Invalid request.";
}
?>