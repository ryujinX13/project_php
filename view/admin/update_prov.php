<?php
include ('../../connect/connection.php');
session_start();

$conn = new mysqli($servername, $username, $password, $dbname);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$Prov_id = $_GET['Prov_id'] ?? ''; // รับค่า Prov_id จาก URL parameter หรือกำหนดให้เป็นค่าว่างถ้าไม่มี
$Prov_Username = "";
$Prov_password = "";
$Prov_email = "";
$Prov_name = "";
$Prov_gender = "";
$Prov_birthday = "";
$Prov_datejob = "";
$Prov_address = "";
$Prov_addressnow = "";
$Prov_nationality = "";
$Prov_religion = "";
$Prov_train = "";
$Prov_phone = "";
$Prov_study = "";

if (!empty($Prov_id)) {
    $sql = "SELECT * FROM provider WHERE Prov_id = '$Prov_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $Prov_Username = $row['Prov_Username'];
        $Prov_password = $row['Prov_password'];
        $Prov_email = $row['Prov_email'];
        $Prov_name = $row['Prov_name'];
        $Prov_gender = $row['Prov_gender'];
        $Prov_birthday = $row['Prov_birthday'];
        $Prov_datejob = $row['Prov_datejob'];
        $Prov_address = $row['Prov_address'];
        $Prov_addressnow = $row['Prov_addressnow'];
        $Prov_nationality = $row['Prov_nationality'];
        $Prov_religion = $row['Prov_religion'];
        $Prov_train = $row['Prov_train'];
        $Prov_phone = $row['Prov_phone'];
        $Prov_study = $row['Prov_study'];
    } else {
        echo "<script>alert('ไม่พบข้อมูลผู้ให้บริการ');</script>";
        echo "<script>window.location.href='search_update.php';</script>";
        exit();
    }
} else {
    echo "<script>alert('ไม่พบรหัสบัตรประชาชน');</script>";
    echo "<script>window.location.href='search_update.php';</script>";
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Provider Management</title>
    <link rel="stylesheet" type="text/css" href="../../css/admin/stylesupdate_prov.css">
</head>

<body>
    <div class="tab-bar">
        <img src="../../img/logo1.png" alt="Logo">
        <a href="index.html" class="tab-link">หน้าแรก</a>
        <a href="booking.html" class="tab-link">ข้อมูลพนักงาน</a>
        <a href="booking_list.html" class="tab-link">การอบรม</a>
        <a href="history.html" class="tab-link">รายงาน</a>  
        <a href="login.html" class="tab-link login">เข้าสู่ระบบ</a>
        <a href="register.html" class="tab-link register">ลงทะเบียน</a>
    </div>

    <div class="container">
        <h2>อัปเดตผู้ให้บริการ</h2>
        <form method="post" action="../../process/updateProv_process.php">
            <label for="Prov_id">รหัสบัตรประชาชน:</label>
            <input type="text" name="Prov_id" value="<?php echo $Prov_id; ?>" readonly><br>
            <label for="Prov_Username">ชื่อผู้ใช้:</label>
            <input type="text" name="Prov_Username" value="<?php echo $Prov_Username; ?>"><br>
            <label for="Prov_password">รหัสผ่าน:</label>
            <input type="text" name="Prov_password" value="<?php echo $Prov_password; ?>"><br>
            <label for="Prov_email">Email:</label>
            <input type="email" name="Prov_email" value="<?php echo $Prov_email; ?>"><br>
            <label for="Prov_name">ชื่อ-สกุล:</label>
            <input type="text" name="Prov_name" value="<?php echo $Prov_name; ?>"><br>
            <label for="Prov_gender">เพศ:</label>
            <select id="Prov_gender" name="Prov_gender" required>
                <option value="0" <?php if ($Prov_gender == '0') echo 'selected'; ?>>ชาย</option>
                <option value="1" <?php if ($Prov_gender == '1') echo 'selected'; ?>>หญิง</option>
            </select><br>
            <label for="Prov_birthday">วันเกิด:</label>
            <input type="date" name="Prov_birthday" value="<?php echo $Prov_birthday; ?>"><br>
            <label for="Prov_datejob">วันที่เริ่มงาน:</label>
            <input type="date" name="Prov_datejob" value="<?php echo $Prov_datejob; ?>"><br>
            <label for="Prov_address">ที่อยู่:</label>
            <input type="text" name="Prov_address" value="<?php echo $Prov_address; ?>"><br>
            <label for="Prov_addressnow">ที่อยู่ปัจจุบัน:</label>
            <input type="text" name="Prov_addressnow" value="<?php echo $Prov_addressnow; ?>"><br>
            <label for="Prov_nationality">สัญชาติ:</label>
            <input type="text" name="Prov_nationality" value="<?php echo $Prov_nationality; ?>"><br>
            <label for="Prov_religion">ศาสนา:</label>
            <input type="text" name="Prov_religion" value="<?php echo $Prov_religion; ?>"><br>
            <label for="Prov_train">สถานะการอบรม:</label>
            <input type="text" name="Prov_train" value="<?php echo $Prov_train; ?>"><br>
            <label for="Prov_phone">เบอร์โทรศัพท์:</label>
            <input type="text" name="Prov_phone" value="<?php echo $Prov_phone; ?>"><br>
            <label for="Prov_study">วุฒิการศึกษา:</label>
            <input type="text" name="Prov_study" value="<?php echo $Prov_study; ?>"><br>
            <input type="submit" value="อัปเดต">
        </form>
    </div>
</body>

</html>
