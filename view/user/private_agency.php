<?php
session_start();
include ('../../connect/connection.php');

// สร้างการเชื่อมต่อ
$conn = new mysqli($servername, $username, $password, $dbname);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("การเชื่อมต่อล้มเหลว: " . $conn->connect_error);
}

// สร้างคำสั่ง SQL เพื่อดึงข้อมูลจากตาราง private_agency
$sql = "SELECT Pva_id, Pva_name, Pva_detail, Pva_address, Pva_email, Pva_phone, Pva_photo FROM private_agency";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>ข้อมูลหน่วยงาน</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 900px;
            padding: 20px;
        }
        .profile-header {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 20px;
        }
        .profile-header img {
            width: 100%;
            height: auto;
            object-fit: cover;
            margin-bottom: 10px;
        }
        .profile-header h1 {
            margin: 0;
            font-size: 24px;
            color: #333;
        }
        .profile-info {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .profile-info div {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }
        .profile-info div span {
            font-weight: bold;
            color: #555;
            flex: 1 1 30%;
        }
    </style>
</head>
<body>

<?php
if ($result->num_rows > 0) {
    // แสดงผลข้อมูลแต่ละแถว
    while($row = $result->fetch_assoc()) {
        // แปลง binary data เป็นรูปภาพ base64
        $imageData = base64_encode($row['Pva_photo']);
        $imageSrc = 'data:image/jpeg;base64,'.$imageData;
?>

<div class="container">
    <div class="profile-header">
        <img src="<?php echo $imageSrc; ?>" alt="รูปภาพหน่วยงาน">
        <h1>รายละเอียดหน่วยงาน</h1>
    </div>
    <div class="profile-info">
        <div><span>ชื่อหน่วยงาน:</span> <?php echo $row['Pva_name']; ?></div>
        <div><span>รายละเอียดหน่วยงาน:</span> <?php echo $row['Pva_detail']; ?></div>
        <div><span>ที่อยู่หน่วยงาน:</span> <?php echo $row['Pva_address']; ?></div>
        <div><span>อีเมลหน่วยงาน:</span> <?php echo $row['Pva_email']; ?></div>
        <div><span>เบอร์โทรศัพท์หน่วยงาน:</span> <?php echo $row['Pva_phone']; ?></div>
    </div>
</div>

<?php
    }
} else {
    echo "<div class='container'><div class='profile-header'><h1>ไม่มีข้อมูล</h1></div></div>";
}
$conn->close();
?>

</body>
</html>
