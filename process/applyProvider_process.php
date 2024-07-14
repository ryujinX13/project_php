<?php
include ('../connect/connection.php');
session_start();

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $prov_id = mysqli_real_escape_string($conn, $_POST['prov_id']);
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
    $ajob_id = mysqli_real_escape_string($conn, $_POST['ajob_id']); // รับค่า ajob_id

    // ตรวจสอบค่าเพศ
    if ($prov_gender != '0' && $prov_gender != '1') {
        die("เกิดข้อผิดพลาด: เพศไม่ถูกต้อง");
    }

    // ตรวจสอบการอัพโหลดไฟล์และอ่านไฟล์รูปภาพ
    if (isset($_FILES['prov_img']) && $_FILES['prov_img']['error'] == 0) {
        $image = $_FILES['prov_img']['tmp_name'];
        $imgContent = addslashes(file_get_contents($image));
    } else {
        $imgContent = null;
    }

    // เตรียมคำสั่ง SQL และ bind ค่า
    $sql = $conn->prepare("INSERT INTO provider (Prov_id, Prov_name, Prov_gender, Prov_birthday, Prov_address, Prov_addressnow, Prov_nationality, Prov_religion, Prov_email, Prov_phone, Prov_study, Prov_img) 
                           VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $sql->bind_param("ssssssssssss", $prov_id, $prov_name, $prov_gender, $prov_birthday, $prov_address, $prov_addressnow, $prov_nationality, $prov_religion, $prov_email, $prov_phone, $prov_study, $imgContent);

    // ดำเนินการคำสั่ง SQL
    if ($sql->execute() === TRUE) {
        echo '<script>alert("ลงทะเบียนสำเร็จ"); window.location.replace("../index.php");</script>';
    } else {
        echo "เกิดข้อผิดพลาด: " . $sql->error;
    }

    // ปิดคำสั่ง
    $sql->close();
}

// ปิดการเชื่อมต่อฐานข้อมูล
$conn->close();
?>
