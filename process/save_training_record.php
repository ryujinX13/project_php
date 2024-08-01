<?php
session_start(); // เริ่มต้นเซสชั่น
include ('../connect/connection.php');
require "../Mail/phpmailer/PHPMailerAutoload.php";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("การเชื่อมต่อล้มเหลว: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $training_id = $_POST['Training_id'];
    $training_date = $_POST['Training_date'];
    $training_time = $_POST['Training_time'];
    $prov_id = $_POST['Prov_id'];

    // ดึงค่าของ Pva_Time_to_train จากตาราง private_agency
    $sql_check = "SELECT Pva_Time_to_train FROM private_agency WHERE Pva_id=(SELECT Pva_id FROM training_record WHERE Training_id='$training_id')";
    $result = $conn->query($sql_check);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $max_training_time = $row['Pva_Time_to_train'];

        // ตรวจสอบว่าชั่วโมงการอบรมไม่เกินค่า Pva_Time_to_train
        if ($training_time > $max_training_time) {
            die("ชั่วโมงการอบรมไม่สามารถเกิน " . $max_training_time . " ชั่วโมง");
        }

        // อัปเดตข้อมูลการอบรม
        $sql = "UPDATE training_record SET Training_date='$training_date', Training_time='$training_time' WHERE Training_id='$training_id'";
        if ($conn->query($sql) === TRUE) {
            if ($training_time == $max_training_time) {
                // อัปเดตข้อมูล provider
                $sql_prov = "UPDATE provider SET Prov_train=1, Prov_datejob=CURDATE() WHERE Prov_id='$prov_id'";
                if ($conn->query($sql_prov) === TRUE) {
                    // ตรวจสอบว่ามีการสร้างชื่อผู้ใช้และรหัสผ่านแล้วหรือไม่
                    $sql_get_provider = "SELECT * FROM provider WHERE Prov_id='$prov_id'";
                    $result_provider = $conn->query($sql_get_provider);
                    if ($result_provider->num_rows > 0) {
                        $provider = $result_provider->fetch_assoc();
                        if ($provider['Prov_Username'] === NULL) {
                            // หาค่าต่อท้ายของชื่อผู้ใช้
                            $sql_max = "SELECT MAX(SUBSTRING(Prov_Username, 10, 3)) AS max_num FROM provider WHERE Prov_Username LIKE 'provider%'";
                            $result_max = $conn->query($sql_max);
                            $max_num = 1; // ค่าเริ่มต้น
                            if ($result_max->num_rows > 0) {
                                $row_max = $result_max->fetch_assoc();
                                if ($row_max['max_num']) {
                                    $max_num = intval($row_max['max_num']) + 1;
                                }
                            }
                            $username = sprintf("provider%03d", $max_num);
                            $password = sprintf("%03d", $max_num);
                            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                            // อัปเดตข้อมูลชื่อผู้ใช้และรหัสผ่าน
                            $sql_update_user_pass = "UPDATE provider SET Prov_Username='$username', Prov_password='$hashed_password' WHERE Prov_id='$prov_id'";
                            if ($conn->query($sql_update_user_pass) === TRUE) {
                                // ส่งอีเมล
                                $email = $provider['Prov_email']; // ตรวจสอบให้แน่ใจว่า 'Prov_email' คือคอลัมน์ในตาราง provider
                                $mail = new PHPMailer();
                                $mail->isSMTP();
                                $mail->Host = 'smtp.gmail.com';
                                $mail->Port = 587;
                                $mail->SMTPSecure = 'tls';
                                $mail->SMTPAuth = true;
                                $mail->Username = 'lookhlan909@gmail.com';
                                $mail->Password = 'ffnq ulkn acxb srqz';

                                $mail->setFrom('lookhlan909@gmail.com', 'Lookhlan');
                                $mail->addAddress($email);

                                $mail->isHTML(true);
                                $mail->Subject = "Congratulations, you have completed the training";
                                $mail->Body = "กรุณานำชื่อผู้ใช้และรหัสผ่านทำการเข้าสู่ระบบผ่านลิงค์ <a href='http://localhost/project_php/view/provider/prov_login.php'>ลิงค์เข้าสู่ระบบ</a><br>ชื่อผู้ใช้: $username<br>รหัสผ่าน: $password";

                                if(!$mail->send()) {
                                    echo "ไม่สามารถส่งอีเมลได้: " . $mail->ErrorInfo;
                                } else {
                                    echo "อีเมลถูกส่งแล้ว";
                                }
                            } else {
                                echo "Error updating username and password: " . $conn->error;
                            }
                        } else {
                            echo "ผู้ใช้มีข้อมูลชื่อผู้ใช้และรหัสผ่านแล้ว";
                        }
                    }
                } else {
                    echo "Error updating provider record: " . $conn->error;
                }
            }
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }

    $conn->close();

    // Redirect back to the show_training_record.php page
    header("Location: ../view/admin/show_training_record.php");
    exit();
}
?>
