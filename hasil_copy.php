<?php 
include ('./conn/conn.php');

session_start();
//user id didalam session
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
var_dump($user_id);
if (!$user_id) {
    header("Location: http://localhost:84/otp/index.php");
    exit(); // Pastikan untuk mengakhiri eksekusi skrip setelah pengalihan
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login System with Email Verification</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap');

        * {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
        }

        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            height: 100vh;
        }

        .content {
            backdrop-filter: blur(77px);
            color: rgb(255, 255, 255);
            border: 2px solid;
            border-radius: 10px;
            padding: 20px;
            background: rgba(255, 255, 255, 0.7);
            margin-top: 20px;
        }

        h2 {
            color: black;
            font-size: 1.7rem;
            margin-bottom: 20px;
        }

        table {
            color: black;
            width: 100%;
            margin-bottom: 20px;
        }

        td {
            padding: 10px;
        }
    </style>
</head>

<body>

   

    <div class="content">
        <h2>HASIL PEMERIKSAAN PSIKOLOGIS CFIT</h2>
        <table>
            <?php 
                $id = $_GET['id'];
                $stmt = $conn->prepare("SELECT * FROM `tbl_user` WHERE `tbl_user_id` = :id");
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();
                
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($user) {
                    $username = $user['username'];
                    $email = $user['email'];
                    $contactNumber = $user['contact_number'];
            ?>
            <tr>
                <td>Name:</td>
                <td><?php echo $username; ?></td>
            </tr>
            <tr>
                <td>Email:</td>
                <td><?php echo $email; ?></td>
            </tr>
            <tr>
                <td>Handphone:</td>
                <td><?php echo $contactNumber; ?></td>
            </tr>
            <?php
                } else {
                    echo "<tr><td colspan='2'>No user data found.</td></tr>";
                }
            ?>
        </table>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">Soal</th>
                    <th scope="col">Jawaban</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $stmt = $conn->prepare("SELECT * FROM `tbl_jawaban` WHERE `user_id` = :id ORDER BY CAST(soal_id AS UNSIGNED)");
                    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                    $stmt->execute();
                    $result = $stmt->fetchAll();
                    
                    foreach ($result as $row) {
                        $soal = $row['soal_id'];
                        $jawaban = $row['jawaban'];
                        ?>
                <tr>
                    
                    <td><?php echo $soal; ?></td>
                    <td><?php echo $jawaban; ?></td>
                </tr>
                <?php
                    }
                    ?>
            </tbody>
        </table>
      <p style="font-size:2rem; color:black;">Nilai:</p>
    </div>

</body>

</html>
