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
$sql = "SELECT User_id, User_Username, User_password, User_name, 
        User_gender, User_birthday, User_addressnow, User_email, 
        User_phone, User_status, user_photo FROM user WHERE User_Username = ?";
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
    die("No user found with the username: " . $user_username);
}

$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>รายละเอียดผู้ใช้งาน</title>
    <style>
        .user-detail {
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 10px;
        }

        .user-detail img {
            max-width: 100px;
            height: auto;
            display: block;
            margin-bottom: 10px;
        }

        .edit-button {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 15px;
            font-size: 14px;
            text-align: center;
            text-decoration: none;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
        }

        .edit-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <h1>รายละเอียดผู้ใช้งาน</h1>
    <div class="user-detail">
        <img src="<?php echo htmlspecialchars($user['user_photo'] ? '../../uploads/' . $user['user_photo'] : '../../process/show_imageUser.php'); ?>" alt="รูปภาพของ <?php echo htmlspecialchars($user['User_name']); ?>">
        <p><strong>รหัสบัตรประจำตัวประชาชน:</strong> <?php echo htmlspecialchars($user['User_id']); ?></p>
        <p><strong>ชื่อผู้ใช้:</strong> <?php echo htmlspecialchars($user['User_Username']); ?></p>
        <p><strong>ชื่อ-นามสกุล:</strong> <?php echo htmlspecialchars($user['User_name']); ?></p>
        <p><strong>เพศ:</strong> <?php echo $user['User_gender'] == 0 ? 'ชาย' : 'หญิง'; ?></p>
        <p><strong>วันเกิด:</strong> <?php echo htmlspecialchars($user['User_birthday']); ?></p>
        <p><strong>ที่อยู่ปัจจุบัน:</strong> <?php echo htmlspecialchars($user['User_addressnow']); ?></p>
        <p><strong>อีเมล์:</strong> <?php echo htmlspecialchars($user['User_email']); ?></p>
        <p><strong>เบอร์โทรศัพท์:</strong> <?php echo htmlspecialchars($user['User_phone']); ?></p>
        <p><strong>สถานะการยืนยัน:</strong> <?php echo $user['User_status'] == 1 ? 'ยืนยันแล้ว' : 'ยังไม่ยืนยัน'; ?></p>
        
        <!-- ปุ่มแก้ไขข้อมูล -->
        <a href="edit_profile.php" class="edit-button">แก้ไขข้อมูล</a>
    </div>
</body>

</html>
