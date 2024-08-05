<?php
include ('../conn/conn.php');
session_start();
$first_name = isset($_SESSION['first_name']) ? $_SESSION['first_name'] : null;
if (!$first_name) {
    header("Location: http://localhost:84/otp/index.php");
    exit(); // Pastikan untuk mengakhiri eksekusi skrip setelah pengalihan
}

if (isset($_GET['user'])) {
    $user = $_GET['user'];

    try {
        // Mulai transaksi
        $conn->beginTransaction();

        // Hapus baris terkait di tabel anak
        $query_child = "DELETE FROM `tbl_jawaban` WHERE `user_id` = :user";
        $stmt_child = $conn->prepare($query_child);
        $stmt_child->bindParam(':user', $user, PDO::PARAM_INT);
        $stmt_child->execute();

        // Hapus baris di tabel induk
        $query_parent = "DELETE FROM `tbl_user` WHERE `tbl_user_id` = :user";
        $stmt_parent = $conn->prepare($query_parent);
        $stmt_parent->bindParam(':user', $user, PDO::PARAM_INT);
        $query_execute = $stmt_parent->execute();

        // Commit transaksi
        $conn->commit();

        if ($query_execute) {
            echo "
            <script>
                alert('User Deleted Successfully');
                window.location.href = 'http://localhost:84/otp/home-admin.php';
            </script>
            ";
        } else {
            echo "
            <script>
                alert('User to Delete Subject');
                window.location.href = 'http://localhost:84/otp/home-admin.php';
            </script>
            ";
        }

    } catch (PDOException $e) {
        // Rollback transaksi jika terjadi kesalahan
        $conn->rollBack();
        echo "Error: " . $e->getMessage();
    }
}
?>
