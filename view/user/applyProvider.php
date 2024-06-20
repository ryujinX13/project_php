<?php
include ('../../connect/connection.php');
session_start();

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $prov_id = mysqli_real_escape_string($conn, $_POST['prov_id']);
    $prov_username = mysqli_real_escape_string($conn, $_POST['prov_username']);
    $prov_password = $_POST['prov_password'];
    $prov_name = mysqli_real_escape_string($conn, $_POST['prov_name']);
    $prov_gender = mysqli_real_escape_string($conn, $_POST['prov_gender']);
    $prov_birthday = mysqli_real_escape_string($conn, $_POST['prov_birthday']);
    $prov_address = mysqli_real_escape_string($conn, $_POST['prov_address']);
    $prov_addressnow = mysqli_real_escape_string($conn, $_POST['prov_addressnow']);
    $prov_nationality = mysqli_real_escape_string($conn, $_POST['prov_nationality']);
    $prov_religion = mysqli_real_escape_string($conn, $_POST['prov_religion']);
    $prov_email = mysqli_real_escape_string($conn, $_POST['prov_email']);
    $prov_phone = mysqli_real_escape_string($conn, $_POST['prov_phone']);
    $prov_study = mysqli_real_escape_string($conn, $_POST['prov_study']);

    if ($prov_gender != '0' && $prov_gender != '1') {
        die("เกิดข้อผิดพลาด: เพศไม่ถูกต้อง");
    }

    $sql = "INSERT INTO Provider (Prov_id, Prov_username, Prov_password, Prov_name, Prov_gender, Prov_birthday, Prov_address, Prov_addressnow, Prov_nationality, Prov_religion, Prov_email, Prov_phone, Prov_study) 
        VALUES ('$prov_id', '$prov_username', '$prov_password', '$prov_name', '$prov_gender', '$prov_birthday', '$prov_address', '$prov_addressnow', '$prov_nationality', '$prov_religion', '$prov_email', '$prov_phone', '$prov_study')";

    if ($conn->query($sql) == TRUE) {
        echo '<script>alert("ลงทะเบียนสำเร็จ");</script>';
    } else {
        echo "เกิดข้อผิดพลาด: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สมัครงาน</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .tab-bar {
            display: flex;
            align-items: center;
            background-color: #96B6C5;
            padding: 10px 0;
            justify-content: center;
        }

        .tab-bar img {
            height: 70px;
            margin-right: 500px;
        }

        .tab-link {
            padding: 10px 20px;
            text-decoration: none;
            color: black;
            border: 1px solid transparent;
            border-radius: 3px;
            margin: 0 10px;
            transition: background-color 0.3s, border-color 0.3s;
        }

        .tab-link:hover {
            background-color: #ccc;
            border-color: #bbb;
        }

        .tab-link.login {
            background-color: #F4CE14;
            color: black;
            border-radius: 10px;
        }

        .tab-link.register {
            background-color: #007bff;
            color: white;
            border-radius: 10px;
        }

        .tab-link.login:hover,
        .tab-link.register:hover {
            background-color: #F4CE14;
            color: white;
        }

        .container {
            width: 45%;
            margin: 30px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 10px;
        }

        input[type="text"],
        input[type="password"],
        input[type="email"],
        input[type="tel"],
        textarea,
        select {
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            width: 20%;
            padding: 15px;
            background-color: #F4CE14;
            border: none;
            border-radius: 20px;
            color: white;
            cursor: pointer;
            display: block;
            margin: 20px auto;
            transition: background-color 0.3s;
            font-size: 16px;
            ;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .gender-label {
            display: inline-block;
            margin-bottom: 10px;
        }

        .gender-input {
            display: none;
        }

        .gender-input+label {
            cursor: pointer;
            background-color: #f0f0f0;
            border-radius: 5px;
            padding: 8px 16px;
            margin-right: 10px;
        }

        .gender-input:checked+label {
            background-color: #007bff;
            color: white;
        }

        .gender-input+label:hover {
            background-color: #ddd;
        }

        p {
            text-align: center;
            margin-top: 20px;
        }

        p a {
            color: #007bff;
            text-decoration: none;
        }

        p a:hover {
            text-decoration: underline;
        }

        .input-field {
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 50%;
        }
    </style>
</head>

<body>
    <div class="tab-bar">
        <img src="../../img/logo1.png" alt="Logo">
        <a href="../../index.php" class="tab-link">หน้าแรก</a>
        <a href="select_provider.php" class="tab-link">การจอง</a>
        <a href="booking_list.php" class="tab-link">รายการจอง</a>
        <a href="history.php" class="tab-link">ประวัติ</a>
        <a href="applyProvider.php" class="tab-link">สมัครงาน</a>
        <a href="login.php" class="tab-link login">เข้าสู่ระบบ</a>
        <a href="register.php" class="tab-link register">ลงทะเบียน</a>
    </div>

    <div class="container">
        <h1>สมัครงาน</h1>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="prov_id">รหัสบัตรประจำตัวประชาชนผู้ให้บริการ :</label>
            <input type="text" id="prov_id" name="prov_id" required>

            <label for="prov_username">ชื่อผู้ใช้งาน :</label>
            <input type="text" id="prov_username" name="prov_username" required>

            <label for="prov_password">รหัสผ่าน :</label>
            <input type="password" id="prov_password" name="prov_password" required>

            <label for="prov_name">ชื่อสกุล :</label>
            <input type="text" id="prov_name" name="prov_name" required>
            <br>
            <div class="gender-label">
                <span>เพศ:</span>
                <input type="radio" id="male" class="gender-input" name="prov_gender" value="0" required>
                <label for="male">ชาย</label>
                <input type="radio" id="female" class="gender-input" name="prov_gender" value="1" required>
                <label for="female">หญิง</label>
            </div><br>

            <label for="prov_birthday" class="form-label">วันเกิด :</label>
            <div class="input-wrapper">
                <input type="date" id="prov_birthday" name="prov_birthday" class="input-field" required>

            </div>


            <label for="prov_address">ที่อยู่ :</label>
            <input type="text" id="prov_address" name="prov_address" required>

            <label for="prov_addressnow">ที่อยู่ปัจจุบัน :</label>
            <input type="text" id="prov_addressnow" name="prov_addressnow" required>

            <label for="prov_nationality">สัญชาติ :</label>
            <input type="text" id="prov_nationality" name="prov_nationality" required>

            <label for="prov_religion">ศาสนา :</label>
            <input type="text" id="prov_religion" name="prov_religion" required>

            <label for="prov_email">อีเมล์ :</label>
            <input type="email" id="prov_email" name="prov_email" required>

            <label for="prov_phone">เบอร์โทรศัพท์ :</label>
            <input type="tel" id="prov_phone" name="prov_phone" required>

            <label for="prov_study">สถาบันการศึกษา :</label>
            <input type="text" id="prov_study" name="prov_study" required>

            <label for="prov_image">รูปภาพ:</label>
            <input type="file" id="prov_image" name="prov_image" accept="image/*" required>


            <input type="submit" value="สมัครงาน">
        </form>

        <p>มีบัญชีผู้ใช้แล้วหรือไม่? <a href="login.php">เข้าสู่ระบบที่นี่</a>.</p>
    </div>

</body>

</html>