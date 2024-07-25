<?php
session_start();
include ('../../connect/connection.php');

// ตรวจสอบว่าผู้ใช้ล็อคอินอยู่หรือไม่
if (!isset($_SESSION['username'])) {
    header('Location: login.php'); // เปลี่ยนเส้นทางไปยังหน้า login หากผู้ใช้ยังไม่ได้ล็อคอิน
    exit;
}

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ดึงข้อมูลของผู้ใช้ที่ล็อคอินอยู่
$user_username = $_SESSION['username']; // ใช้ session username
$sql = "SELECT User_id, User_Username, User_name, 
        User_gender, User_birthday, User_addressnow, User_email, 
        User_phone, user_photo FROM user WHERE User_Username = ?";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("s", $user_username);

if (!$stmt->execute()) {
    die("Execute failed: " . $stmt->error);
}

$result = $stmt->get_result();

if ($result === false) {
    die("Get result failed: " . $stmt->error);
}

$user = $result->fetch_assoc();

if ($user === null) {
    die("No user found with the username: " . htmlspecialchars($user_username));
}

$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>แก้ไขข้อมูลผู้ใช้งาน</title>
    <style>
       body {
    font-family: 'Arial', sans-serif;
    line-height: 1.6;
    background-color: #f5f5f5;
    margin: 0;
    padding: 0;
}
    .tab-bar {
    display: flex;
    align-items: center;
    background-color: #8ab7cc;
    padding: 20px 20px;
    justify-content: center;
    height: 70px;
}

.tab-bar img {
    height: 100px; 
    margin-left: 50px; 
}


.back-button {
    position: absolute;
    left: 10px; 
    background: none;
    border: none;
    font-size: 3em;
    color: black;
    cursor: pointer;
    transition: color 0.3s ease, transform 0.3s ease;
}

.back-button:hover {
    color: white;
    transform: scale(1.1);
}

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
            margin: auto;
            margin-top: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .form-group button {
            display: block;
            width: 20%;
            padding: 12px;
            font-size: 16px;
            text-align: center;
            text-decoration: none;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            margin: 20px auto;
            transition: background-color 0.3s;
        }

        .form-group button:hover {
            background-color: #0056b3;
        }
    </style>
    <script>
        function validateForm() {
            var password = document.getElementById("User_password").value;

            if (password.length > 0) {
                if (password.length < 8) {
                    alert("รหัสผ่านต้องมีความยาวอย่างน้อย 8 ตัวอักษร");
                    return false;
                }
                if (!/[A-Z]/.test(password)) {
                    alert("รหัสผ่านต้องมีตัวอักษรตัวใหญ่ (A-Z) อย่างน้อย 1 ตัว");
                    return false;
                }
                if (!/[a-z]/.test(password)) {
                    alert("รหัสผ่านต้องมีตัวอักษรตัวเล็ก (a-z) อย่างน้อย 1 ตัว");
                    return false;
                }
                if (!/[0-9]/.test(password)) {
                    alert("รหัสผ่านต้องมีตัวเลข (0-9) อย่างน้อย 1 ตัว");
                    return false;
                }
            }

            return true;
        }
    </script>
</head>
<body>
<div class="tab-bar">
        <button class="back-button" onclick="window.location.href='../user/account_user.php'">⬅️</button>
        <img src="../../img/logo1.png" alt="Logo" style="margin-left: 10px;">
        
    </div>
    <div class="container">
        <h1>แก้ไขข้อมูลผู้ใช้งาน</h1>
        <form action="../../process/updateUser_profile.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
            <div class="form-group">
                <label for="user_photo">รูปโปรไฟล์</label>
                <input type="file" id="user_photo" name="user_photo" accept="image/*">
            </div>
            <div class="form-group">
                <label for="User_birthday">วันเกิด</label>
                <input type="date" id="User_birthday" name="User_birthday" value="<?php echo htmlspecialchars($user['User_birthday']); ?>">
            </div>
            <div class="form-group">
                <label for="User_addressnow">ที่อยู่ปัจจุบัน</label>
                <input type="text" id="User_addressnow" name="User_addressnow" value="<?php echo htmlspecialchars($user['User_addressnow']); ?>">
            </div>
            <div class="form-group">
                <label for="User_phone">เบอร์โทรศัพท์</label>
                <input type="text" id="User_phone" name="User_phone" value="<?php echo htmlspecialchars($user['User_phone']); ?>">
            </div>
            <div class="form-group">
                <label for="User_password">รหัสผ่านใหม่</label>
                <input type="password" id="User_password" name="User_password">
            </div>
            <div class="form-group">
                <button type="submit">บันทึก</button>
            </div>
        </form>
    </div>
</body>
</html>
