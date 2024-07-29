<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>การยืนยันตัวตน</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <link rel="icon" href="Favicon.png">
    <style>
       body{
        background-color: #f1f1f1;
       }
        .login-form {
            padding-top: 50px;
            padding-bottom: 50px;
           
        }

        .card-header {
            background-color: #8ab7cc;
            color: #fff;
            font-weight: bold;
            font-size: 24px;
            text-align: center;
            
        }

        .card-body {
            background-color: #fff;
            border-radius: 20px;
        }

        .btn-primary {
            background-color: #F4CE14;
            border-color: #fff;
        }

        .btn-primary:hover {
            background-color: #013159;
            border-color: #013159;
        }

        .btn-primary:focus {
            box-shadow: 0 0 0 0.2rem rgba(1, 79, 134, 0.5);
        }

    </style>
</head>

<body>

    <main class="login-form">
        <div class="cotainer">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">การยืนยันตัวตน</div>
                        <div class="card-body">
                            <form action="#" method="POST">
                                <div class="form-group row">
                                    <label for="otp" class="col-md-4 col-form-label text-md-right">รหัส OTP</label>
                                    <div class="col-md-6">
                                        <input type="text" id="otp" class="form-control" name="otp_code" required
                                            autofocus>
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary" name="verify">ยืนยัน</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</body>

</html>


<?php
session_start();

include ('../../connect/connection.php');

if (isset($_POST["verify"])) {
    $otp = $_SESSION['otp'];
    $user_email = $_SESSION['user_email'];
    $otp_code = $_POST['otp_code'];

    if ($otp != $otp_code) {
        ?>
        <script>
            alert("Invalid OTP code");
        </script>
        <?php
    } else {
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        var_dump($user_email);

        $sql = "UPDATE user SET User_status = 1 WHERE User_email = '$user_email'";

        if (mysqli_query($conn, $sql)) {
            ?>
            <script>
                alert("Verify account done, you may sign in now");
                window.location.replace("../../index.php");
            </script>
            <?php
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
    }
}
?>