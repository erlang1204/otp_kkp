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
            flex-direction: column;
            align-items: center;
            background-image: url("./asset/bg1.jpg");
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
    <input type="text" value="<?php echo $userVerificationID ?>">
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary" style="width: 100%;">
        <a class="navbar-brand ml-5" href="home.php">
            <img src="./asset/logo.png" alt="Logo" height="30" class="d-inline-block align-top mr-2">
            PT.Sinar Metrindo Perkasa
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarScroll"
            aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="http://localhost:84/otp/index.php" id="logoutButton">Log Out</a>
                </li>
            </ul>
        </div>
    </nav>

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

        <?php
        // Kode untuk penilaian nilai
        $stmt_kunci = $conn->prepare("SELECT id, jawaban FROM `tbl_soal` ORDER BY CAST(id AS UNSIGNED)");
        $stmt_kunci->execute();
        $jawaban = $stmt_kunci->fetchAll(PDO::FETCH_ASSOC);

        $nilai = 0;
        $total_soal = count($jawaban);

        foreach ($jawaban as $kunci) {
            $soal_id = $kunci['id'];
            $jawaban_benar = $kunci['jawaban'];
        
            foreach ($result as $jawaban_user) {
                if ($jawaban_user['soal_id'] == $soal_id) {
                    $jawaban_user = $jawaban_user['jawaban'];
        
                    // Bandingkan jawaban user dengan kunci jawaban (dapat disesuaikan dengan logika penilaian yang Anda inginkan)
                    if (strtolower($jawaban_user) == strtolower($jawaban_benar)) {
                        $nilai++;
                    }
                }
            }
        }

        // Hitung nilai akhir dalam persentase
        $nilai_persen = ($nilai / $total_soal) * 12;
        $nilai_bulat = round($nilai_persen);
        // Tampilkan hasil nilai
        
        echo '<p style="font-size: 2rem; color: black;">Nilai: ' . $nilai_bulat . '</p>';
        ?>
        <form action="test.php" method="post" enctype="multipart/form-data">
        <table>
		                <tr>
		                		<td><input type="file" class="form-control" name="uploadfile"></td>
		                </tr>
		                <tr>
		                		<td><button class="btn btn-primary mt-3" type="submit" name="submitfile">Unggah Hasil</button></td>
		                </tr>
		        </table>
        </form>
        <br>
        <a style="color:black;" href="proses_pdf.php?id=<?= $id ?>">Cetak PDF</a>
        <a style="color:black;" href="hasil.php?id=<?= $id ?>">Kembali</a>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
</body>

</html>
