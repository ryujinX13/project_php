<!DOCTYPE html>
<html>

<head>
    <title>รายละเอียดผู้ดูแล</title>
</head>

<body>
    <h2>รายละเอียดผู้ดูแล</h2>
    <?php
    include ('../../connect/connection.php');
    session_start();

    if (isset($_GET['Prov_id'])) {
        $Prov_id = $_GET['Prov_id'];
        $appointment_date = $_SESSION['appointment_date'];
        $appointment_time = $_SESSION['appointment_time'];

        $sql = "SELECT * FROM provider WHERE Prov_id = '$Prov_id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo "<p>ชื่อผู้ดูแล: " . $row["Prov_name"] . "</p>";
            echo "<p>อีเมล: " . $row["Prov_email"] . "</p>";
            echo "<p>เบอร์โทร: " . $row["Prov_phone"] . "</p>";

            echo '<form action="" method="post">';
            echo '<input type="hidden" name="Prov_id" value="' . $Prov_id . '">';
            echo '<input type="hidden" name="appointment_date" value="' . $appointment_date . '">';
            echo '<input type="hidden" name="appointment_time" value="' . $appointment_time . '">';
            echo '<input type="submit" name="confirm_appointment" value="ยืนยันการนัดหมาย">';
            echo '</form>';
        } else {
            echo "ไม่พบข้อมูลผู้ดูแล";
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirm_appointment'])) {
        $Prov_id = $_POST['Prov_id'];
        $appointment_date = $_POST['appointment_date'];
        $appointment_time = $_POST['appointment_time'];

        // สร้างรหัสการนัดหมายแบบอัตโนมัติที่เริ่มจาก 0001
        function generateAppoinId($conn)
        {
            $sql = "SELECT appoin_id FROM appointment ORDER BY appoin_id DESC LIMIT 1";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $lastId = intval($row['appoin_id']);
                $newId = $lastId + 1;
                return str_pad($newId, 4, '0', STR_PAD_LEFT);
            } else {
                return '0001';
            }
        }

        $appoin_id = generateAppoinId($conn);

        $sql = "INSERT INTO appointment (appoin_id, Prov_id, Appoin_date, Appoin_time) VALUES ('$appoin_id', '$Prov_id', '$appointment_date', '$appointment_time')";

        if ($conn->query($sql) === TRUE) {
            echo "การนัดหมายเสร็จสิ้น รหัสการนัดหมายของคุณคือ: $appoin_id";
        } else {
            echo "เกิดข้อผิดพลาด: " . $conn->error;
        }
    }

    $conn->close();
    ?>
</body>

</html>