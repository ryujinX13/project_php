<?php
include ('../connect/connection.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $appointment_date = $_POST['appointment_date'];
    $appointment_time = $_POST['appointment_time'];

    $_SESSION['appointment_date'] = $appointment_date;
    $_SESSION['appointment_time'] = $appointment_time;

    // คำสั่ง SQL เพื่อหาผู้ดูแลที่ว่างในวันที่และเวลาที่กำหนด
    $sql = "SELECT * FROM provider WHERE Prov_id NOT IN (SELECT Prov_id FROM appointment WHERE Appoin_date = '$appointment_date' AND Appoin_time = '$appointment_time')";
    $result = $conn->query($sql);

    echo "<!DOCTYPE html>
    <html>
    <head>
        <meta charset='UTF-8'>
        <title>ผู้ดูแลที่ว่าง</title>
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
            .form-section input[type='date'],
            .form-section input[type='time'] {
                padding: 5px;
                margin-right: 10px;
            }
            .form-section input[type='submit'] {
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
        <div class='container'>
            <div class='form-section'>
                <form action='' method='post'>
                    <label for='appointment_date'>วันที่จอง:</label>
                    <input type='date' id='appointment_date' name='appointment_date' value='$appointment_date' required>
                    <label for='appointment_time'>เวลาจอง:</label>
                    <input type='time' id='appointment_time' name='appointment_time' value='$appointment_time' required>
                    <input type='submit' value='ค้นหาผู้ดูแล'>
                </form>
            </div>
            <h2>พนักงานที่ให้บริการ</h2>";

    if ($result->num_rows > 0) {
        echo "<div class='service-section'>";
        while ($row = $result->fetch_assoc()) {
            $provider_image = "../process/photo.png"; // ใช้รูป placeholder แทนที่ด้วยรูปจริงตามฐานข้อมูล
            $provider_name = $row["Prov_name"];
            $provider_rating = "4.8"; // ค่าคงที่สามารถปรับเปลี่ยนตามฐานข้อมูลจริง
            $provider_reviews = "53"; // ค่าคงที่สามารถปรับเปลี่ยนตามฐานข้อมูลจริง

            echo "<div class='service'>
                    <img src='$provider_image' alt='รูปผู้ดูแล'>
                    <p>$provider_name</p>
                    <p>มหาวิทยาลัยของคุณ</p>
                    <p>⭐ $provider_rating • $provider_reviews รีวิว</p>
                    <a href='../view/user/prov_details.php?Prov_id=".$row["Prov_id"]."'>ดูรายละเอียด</a>
                </div>";
        }
        echo "</div>";
    } else {
        echo "<p>ไม่พบผู้ดูแลที่ว่างในวันที่ $appointment_date เวลา $appointment_time</p>";
    }

    echo "</div>
    </body>
    </html>";

    $conn->close();
}
?>
