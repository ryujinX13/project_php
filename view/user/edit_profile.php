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
        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }

        .form-group button {
            padding: 10px 15px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
        }

        .form-group button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>แก้ไขข้อมูลผู้ใช้งาน</h1>
    <form action="../../process/updateUser_profile.php" method="post" enctype="multipart/form-data">
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
            <button type="submit">บันทึกการเปลี่ยนแปลง</button>
        </div>
    </form>
</body>
</html>
