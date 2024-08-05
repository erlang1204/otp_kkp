<?php
include ('./conn/conn.php');

session_start();
$first_name = isset($_SESSION['first_name']) ? $_SESSION['first_name'] : null;
$userID = isset($_SESSION['userID']) ? $_SESSION['userID'] : null;

if (!$first_name || !$userID) {
    header("Location: http://localhost:84/otp/index.php");
    exit(); // Pastikan untuk mengakhiri eksekusi skrip setelah pengalihan
}

$start_time = date('Y-m-d H:i:s');

$sql = "INSERT INTO start_times (user_id, waktu_mulai) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param('is', $userID, $start_time);

if ($stmt->execute()) {
    header("Location: soal_subtes.php?id=1");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$stmt->close();
$conn->close();
?>
