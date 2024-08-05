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
        }
        .td{
            color: black;
        }
        
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary" style="width: 100%;">
        <a class="navbar-brand ml-5" href="index.php">
            <img src="./asset/logo.png" alt="Logo" height="30" class="d-inline-block align-top mr-2">
            PT.Sinar Metrindo Perkasa
        </a>

    </nav>

    <div style="padding-bottom : 16px">

        <div class="content" style="margin-top: 1rem; display: flex;"> <!--  ini buat css ya nanti taro di atas-->
            <div class="card"
                style="width: 33rem; display: flex; align-items: center;background: rgba(255,255,255,0.5)">
                <h1 style="padding:1rem; color:black;">Cek Hasil Ujian Psikotes</h1>
                <div class="card-body">
                <form action="dekrip.php" method="post" enctype="multipart/form-data">
	                <table>
		                <tr>
		                	<td style="color:black;">Password</td>
			                <td><input type="text" name="kunci"></td>
	                    </tr>
		                <tr>
		                	<td style="color:black;">Upload Document</td>
		                	<td><input style="color:black;" type="file" name="doc"></td>
		                </tr>
		                <tr>
                        <td style="color:black;"><button type="submit" class="btn btn-primary btn-sm" style="margin-top: 11px;">Cek Hasil</button></td>
		                </tr>
	                </table>
                    <div>
                        <br>
                    <p style="color:black;">Kembali Kehalaman Login <a href="index.php" style="color:blue;">Disini.</a></p>
    </div>
                </form>
                    </div>
            </div>
        </div>
    </div>


    <tbody>



        <!-- Bootstrap Js -->
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>

</body>

</html>