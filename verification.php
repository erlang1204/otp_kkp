<?php
include ('./conn/conn.php');
session_start();
//user id didalam session
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
if (!$user_id) {
    header("Location: http://localhost:84/otp/index.php");
    exit(); // Pastikan untuk mengakhiri eksekusi skrip setelah pengalihan
}


if (!empty($user_id)) {
    $stmt = $conn->prepare("SELECT `first_name`,`tbl_user_id`, `email` FROM `tbl_user` WHERE `tbl_user_id` = :user_id");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();

    $check_user = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Psikotes PT.Sinar Metrindo Perkasa</title>

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
            justify-content: center;
            align-items: center;
            background-image: url("./asset/bg1.jpg");
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            height: 100vh;
        }

        .verification-form {
            backdrop-filter: blur(9px);
            color: rgb(255, 255, 255);
            padding: 40px;
            width: 500px;
            border: 2px solid;
            border-radius: 10px;
        }
    </style>
</head>

<body>

    <div class="main">
        <!-- Email Verification Area -->

        <div class="verification-container">
            <div class="verification-form" id="loginForm">
                <h2 class="text-center" >Verification OTP</h2>
                <p class="text-center">Please ask the admin for a verification code.</p>
                <form action="./endpoint/add-user.php" method="POST">
                    <input type="text" name="user_verification_id" value="<?= $check_user['tbl_user_id'] ?>">
                    <input type="text" name="first_name" value="<?php echo $check_user['first_name'] ?>">
                    <input type="number" class="form-control text-center" id="verification_code"
                        name="verification_code">
                    <button type="submit" class="btn btn-secondary login-btn form-control mt-4"
                        name="verify">Verify</button>
                </form>
            </div>

        </div>

    </div>

    <!-- Bootstrap Js -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>

</body>

</html>