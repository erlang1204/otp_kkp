<?php
include ('./conn/conn.php');
include ('./Aes.php');

session_start();
//user id didalam session
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
var_dump($user_id);
if (!$user_id) {
    header("Location: http://localhost:84/otp/index.php");
    exit(); // Pastikan untuk mengakhiri eksekusi skrip setelah pengalihan
}


$soal_id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM `tbl_soal` WHERE `id` = :id");
$stmt->bindParam(':id', $soal_id, PDO::PARAM_INT);
$stmt->execute();

$row = $stmt->fetch(PDO::FETCH_ASSOC); // Mengambil baris sebagai array asosiatif
if ($row) {
    $soalID = $row['id'];
    $gambar = $row['gambar'];
}
//mengambil jawaban user
$queryjawabanuser= $conn->prepare("SELECT  jawaban FROM `tbl_jawaban` WHERE `soal_id` = :soal_id AND `user_id` =:user_id limit 1");
$queryjawabanuser->bindParam(':soal_id', $soal_id, PDO::PARAM_INT);
$queryjawabanuser->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$queryjawabanuser->execute();

//nilai
$jawabanuser = $queryjawabanuser->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Psikotes PT.Sinar Metrindo Perkasa</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">


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
        }

        /* .card-title { */
        /* margin-bottom: 3.75rem;
        } */
        h5.card-title {
            color: black;
            font-size: 2rem;
        }

        .table {
            color: rgb(255, 255, 255) !important;
        }

        td button {
            font-size: 20px;
            width: 30px;
        }

        .card-text {
            text-align: justify;
        }
        .nomor {
            color: black;
            background-color: #007bff;
}
.timer-container {
            display: inline;
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            padding: 10px;
            border-radius: 5px;
            font-size: 18px;
        }   
    </style>
</head>

<body>
    
    <input type="text" value="<?php echo $user_id ?>">
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary" style="width: 100%;">
        <form action="action-logout.php" method="post" style="width:100%">
            <div style="display:flex; flex-direction:row;justify-content:space-between;width:100%">
            <div>
            <a class="navbar-brand ml-5">
                <img src="./asset/logo.png" alt="Logo" height="30" class="d-inline-block align-top mr-2">
                PT.Sinar Metrindo Perkasa
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
            </div>
            <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <button class="nav-link" type="submit" id="logoutButton" style="background:none; border:none;">Log Out</button>
                </li>
            </ul>
        </div>
                
            </div>
        
        </form>
        
    </nav>

    <div class="row" style="width: 100%; display:flex; justify-content:center; margin-top:1rem; height: 100vh">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-center mb-3" style="gap: 10px;">
                        <a class="btn btn-primary nomor" href="http://localhost:84/otp/soal_subtes.php?id=1"
                            style="width: 10rem;height: 4rem; display: flex;justify-content: center;align-items: center; background-color: #cfe4ff;">1</a>
                        <a class="btn btn-primary nomor" href="http://localhost:84/otp/soal_subtes.php?id=2"
                            style="width: 10rem;height: 4rem; display: flex;justify-content: center;align-items: center;background-color: #cfe4ff;">2</a>
                        <a class="btn btn-primary nomor" href="http://localhost:84/otp/soal_subtes.php?id=3"
                            style="width: 10rem;height: 4rem; display: flex;justify-content: center;align-items: center; background-color: #cfe4ff;">3</a>
                    </div>
                    <div class="d-flex justify-content-center mb-3" style="gap: 10px;">
                        <a class="btn btn-primary nomor" href="http://localhost:84/otp/soal_subtes.php?id=4"
                            style="width: 10rem;height: 4rem; display: flex;justify-content: center;align-items: center; background-color: #cfe4ff;">4</a>
                        <a class="btn btn-primary nomor" href="http://localhost:84/otp/soal_subtes.php?id=5"
                            style="width: 10rem;height: 4rem; display: flex;justify-content: center;align-items: center; background-color: #cfe4ff;">5</a>
                        <a class="btn btn-primary nomor" href="http://localhost:84/otp/soal_subtes.php?id=6"
                            style="width: 10rem;height: 4rem; display: flex;justify-content: center;align-items: center; background-color: #cfe4ff;">6</a>
                    </div>
                    <div class="d-flex justify-content-center mb-3" style="gap: 10px;">
                        <a class="btn btn-primary nomor" href="http://localhost:84/otp/soal_subtes.php?id=7"
                            style="width: 10rem;height: 4rem; display: flex;justify-content: center;align-items: center; background-color: #cfe4ff;">7</a>
                        <a class="btn btn-primary nomor" href="http://localhost:84/otp/soal_subtes.php?id=8"
                            style="width: 10rem;height: 4rem; display: flex;justify-content: center;align-items: center; background-color: #cfe4ff;">8</a>
                        <a class="btn btn-primary nomor" href="http://localhost:84/otp/soal_subtes.php?id=9"
                            style="width: 10rem;height: 4rem; display: flex;justify-content: center;align-items: center; background-color: #cfe4ff;">9</a>
                    </div>
                    <div class="d-flex justify-content-center mb-3" style="gap: 10px;">
                        <a class="btn btn-primary nomor" href="http://localhost:84/otp/soal_subtes.php?id=10"
                            style="width: 10rem;height: 4rem; display: flex;justify-content: center;align-items: center; background-color: #cfe4ff;">10</a>
                        <a class="btn btn-primary nomor" href="http://localhost:84/otp/soal_subtes.php?id=11"
                            style="width: 10rem;height: 4rem; display: flex;justify-content: center;align-items: center; background-color: #cfe4ff;">11</a>
                        <a class="btn btn-primary nomor" href="http://localhost:84/otp/soal_subtes.php?id=12"
                            style="width: 10rem;height: 4rem; display: flex;justify-content: center;align-items: center; background-color: #cfe4ff;">12</a>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="col-md-8" style="padding: 0">

            <div class="card">
                <div class="card-body" style="display:flex; flex-direction: column;">
                    <p class="card-title" style="margin-left: 3rem;"><?php echo $soalID ?>. Tugas anda adalah mengisi
                        kotak
                        yang masih kosong sesuai dengan pilihan yang tersedia. Perlu diingat bahwa setiap gambar pada
                        kotak tersebut memiliki pola tertentu. Anda perlu mengetahui pola tersebut untuk menjawab soal.
                        Pilih jawaban yang sesuai dengan pola.</p>
                    <img class="card-img-top"
                        style="width: 32rem; padding-top: 0rem; padding-bottom: 1rem; margin-left: 14rem;"
                        src="<?php echo $gambar ?>" alt="Card image cap">
                        <div class="d-flex justify-content-center mb-3" style="gap: 78px;">
                            <a id="a" class="btn answer-btn" style="width: 6rem;height: 4rem; display: flex;justify-content: center;align-items: center; background-color: #cfe4ff;">A</a>
                            <a id="b" class="btn answer-btn" style="width: 6rem;height: 4rem; display: flex;justify-content: center;align-items: center;  background-color: #cfe4ff;">B</a>
                            <a id="c" class="btn answer-btn" style="width: 6rem;height: 4rem; display: flex;justify-content: center;align-items: center;  background-color: #cfe4ff;">C</a>
                        </div>
                        <div class="d-flex justify-content-center mb-3" style="gap: 78px;">
                            <a id="d" class="btn answer-btn" style="width: 6rem;height: 4rem; display: flex;justify-content: center;align-items: center;   background-color: #cfe4ff;">D</a>
                            <a id="e" class="btn answer-btn" style="width: 6rem;height: 4rem; display: flex;justify-content: center;align-items: center;  background-color: #cfe4ff;">E</a>
                            <a id="f" class="btn answer-btn" style="width: 6rem;height: 4rem; display: flex;justify-content: center;align-items: center;  background-color: #cfe4ff;">F</a>
</div>
                </div>

                <!-- Modal Selesai -->
<div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Apakah Anda yakin sudah selesai?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary" id="confirmFinish">Ya, Selesai</button>
      </div>
    </div>
  </div>
</div>
                <?php  
if ($soalID == 1) {
?>
    <div class="d-flex justify-content-between" style="padding-bottom: 1rem">
        <div class="content" style="padding-left: 1rem">
            <a style="width: 8rem;height: 3rem; display: flex;justify-content: center;align-items: center;"></a>
        </div>
        <div style="padding-right: 1rem">
            <a id="next" class="btn btn-primary" style="width: 8rem;height: 3rem; display: flex;justify-content: center;align-items: center; background-color: #80bdff" data-url="http://localhost:84/otp/soal_subtes.php?id=<?php echo $soalID + 1 ?>">Selanjutnya</a>
        </div>
    </div>
<?php
} elseif ($soalID > 1 && $soalID < 12) {
?>
    <div class="d-flex justify-content-between" style="padding-bottom: 1rem">
        <div class="content" style="padding-left: 1rem">
            <a class="btn btn-danger" style="width: 8rem;height: 3rem; display: flex;justify-content: center;align-items: center;" href="http://localhost:84/otp/soal_subtes.php?id=<?php echo $soalID - 1 ?>">sebelumnya</a>
        </div>
        <div style="padding-right: 1rem">
            <a id="next" class="btn btn-primary" style="width: 8rem;height: 3rem; display: flex;justify-content: center;align-items: center; background-color: #80bdff" data-url="http://localhost:84/otp/soal_subtes.php?id=<?php echo $soalID + 1 ?>">Selanjutnya</a>
        </div>
    </div>
<?php
} elseif ($soalID == 12) {
?>
    <div class="d-flex justify-content-between" style="padding-bottom: 1rem">
        <div class="content" style="padding-left: 1rem">
            <a class="btn btn-danger" style="width: 8rem;height: 3rem; display: flex;justify-content: center;align-items: center;" href="http://localhost:84/otp/soal_subtes.php?id=<?php echo $soalID - 1 ?>">sebelumnya</a>
        </div>
        <div style="padding-right: 1rem">
            <a id="finish" class="btn btn-primary" style="width: 8rem; height: 3rem; display: flex; justify-content: center; align-items: center; background-color: #80bdff" data-toggle="modal" data-target="#confirmationModal" data-url="http://localhost:84/otp/home-user.php">Selesai</a>
        </div>
    </div>
<?php
}
?>

                
    </div>


            </div>

        </div>
    </div>
    <tbody>



        <!-- Bootstrap Js -->
        <!-- jQuery -->
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
        <!-- Popper.js (required for Bootstrap) -->
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>


        <script>
        document.getElementById('confirmFinish').addEventListener('click', function() {
        window.location.href = "http://localhost:84/otp/home-user.php";});
        </script>
        <script>
        $(document).ready(function() {
    const buttons = document.querySelectorAll('.answer-btn');
    var selectedAnswerId = "";
    var userId = <?php echo json_encode($user_id); ?>;
    var jawabanuser = <?php echo json_encode(!empty($jawabanuser) ? $jawabanuser['jawaban'] : ""); ?>;
    var soalId = <?php echo json_encode($soalID); ?>;

    // Function to set the background color of the selected button
    function setButtonColor(buttonId) {
        buttons.forEach(btn => btn.style.backgroundColor = '#cfe4ff');
        if (buttonId) {
            document.getElementById(buttonId).style.backgroundColor = 'blue';
        }
    }

    // Set the color of the selected button when the page loads
    setButtonColor(jawabanuser);

    buttons.forEach(button => {
        button.addEventListener('click', function() {
            setButtonColor(this.id);
            selectedAnswerId = this.id;
        });
    });

    $('#next').on('click', function(e) {
        e.preventDefault();
        var url = $(this).data('url');

        if (selectedAnswerId) {
            $.ajax({
                url: 'save_answer.php',
                type: 'POST',
                data: {
                    answerId: selectedAnswerId,
                    soalId: soalId,
                    userid: userId
                },
                success: function(response) {
                    console.log(response);
                    window.location.href = url;
                },
                error: function(xhr, status, error) {
                    console.error(xhr);
                    alert('Failed to save answer');
                }
            });
        } else {
            alert('Silakan pilih jawaban sebelum melanjutkan.');
        }
    });

    $('#finish').on('click', function(e) {
        e.preventDefault();
        var url = $(this).data('url');

        if (selectedAnswerId) {
            $.ajax({
                url: 'save_answer.php',
                type: 'POST',
                data: {
                    answerId: selectedAnswerId,
                    soalId: soalId,
                    userid: userId
                },
                success: function(response) {
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    console.error(xhr);
                    alert('Failed to save answer');
                }
            });
        } else {
            alert('Silakan pilih jawaban sebelum menyelesaikan.');
        }
    });
});

</script>


</body>

</html>