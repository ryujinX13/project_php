<?php
session_start();

if (!isset($_SESSION['username'])) {
    echo "<script>alert('กรุณาเข้าสู่ระบบก่อน');</script>";
    echo "<script>window.location.href='login.php'</script>";
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>เลือกผู้ดูแล</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: auto;
            background-color: #ffffff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        header {
            background-color: #007bff;
            color: white;
            padding: 10px 0;
            text-align: center;
        }

        .form-section {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 20px 0;
        }

        .form-section label {
            margin-right: 10px;
        }

        .form-section input[type="date"],
        .form-section input[type="time"] {
            padding: 5px;
            margin-right: 10px;
        }

        .form-section input[type="submit"] {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }

        .service-section {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 10px;
            margin: 20px 0;
        }

        .service {
            background-color: #ffffff;
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .service img {
            max-width: 100%;
            height: auto;
        }

        .service p {
            margin: 10px 0 0;
        }
    </style>
</head>

<body>
    <header>
        <h1>ลูกหลานไม่ว่าง จ้างหนูพาไปหาหมอ ทำธุระ</h1>
    </header>
    <div class="container">
        <div class="form-section">
            <form action="../../process/process_booking.php" method="post">
                <label for="appointment_date">วันที่จอง:</label>
                <input type="date" id="appointment_date" name="appointment_date" required>
                <label for="appointment_time">เวลาจอง:</label>
                <input type="time" id="appointment_time" name="appointment_time" required>
                <input type="submit" value="ค้นหาผู้ดูแล">
            </form>
        </div>
        <div class="service-section">
            <div class="service">
                <img src="service1.jpg" alt="แพคเกจพาผู้ป่วยออกนอกบ้าน">
                <p>แพคเกจพาผู้ป่วยออกนอกบ้าน 4 ชั่วโมง 16:00-20:00 ค่าบริการ 400 บาท</p>
            </div>
            <div class="service">
                <img src="service2.jpg" alt="แพคเกจครึ่งวัน">
                <p>แพคเกจครึ่งวัน เวลา 6 ชั่วโมง 07:00-13:00 ค่าบริการ 500 บาท</p>
            </div>
            <div class="service">
                <img src="service3.jpg" alt="แพคเกจครึ่งวัน">
                <p>แพคเกจครึ่งวัน เวลา 8 ชั่วโมง 07:00-15:00 ค่าบริการ 600 บาท</p>
            </div>
            <div class="service">
                <img src="service4.jpg" alt="แพคเกจเต็มวัน">
                <p>แพคเกจเต็มวัน เวลา 10 ชั่วโมง 07:00-17:00 ค่าบริการ 700 บาท</p>
            </div>
            <div class="service">
                <img src="service5.jpg" alt="แพคเกจนอนโรงพยาบาลได้">
                <p>แพคเกจนอนโรงพยาบาลได้ เวลา 12 ชั่วโมง 19:00-07:00 ค่าบริการ 600 บาท</p>
            </div>
            <div class="service">
                <img src="service6.jpg" alt="แพคเกจนอนโรงพยาบาลได้">
                <p>แพคเกจนอนโรงพยาบาลได้ เวลา 24 ชั่วโมง 19:00-19:00 ค่าบริการ 1,000 บาท</p>
            </div>
        </div>
    </div>
</body>

</html>