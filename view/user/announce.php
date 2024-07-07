<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ประกาศรับสมัครพนักงานให้บริการ</title>
    <link rel="stylesheet" type="text/css" href="../../css/provider/stylesannounce.css">
</head>

<body>
    <div class="tab-bar">
        <img src="../../img/logo1.png" alt="Logo">
        <a href="../../index.php" class="tab-link">หน้าแรก</a>
        <a href="select_provider.php" class="tab-link">การจอง</a>
        <a href="booking_list.php" class="tab-link">รายการจอง</a>
        <a href="history.php" class="tab-link">ประวัติ</a>
        <a href="announce.php" class="tab-link">สมัครงาน</a>
        <a href="login.php" class="tab-link login">เข้าสู่ระบบ</a>
        <a href="register.php" class="tab-link register">ลงทะเบียน</a>
    </div>

    <main>
        <section class="announcement">
            <h1>ประกาศรับสมัครพนักงานให้บริการ</h1>
            <?php
            include ('../../connect/connection.php');
            session_start();

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT Ajob_opening, Ajob_closing, Ajob_details FROM job_announcement WHERE Ajob_id=1";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $Ajob_opening = $row["Ajob_opening"];
                    $Ajob_closing = $row["Ajob_closing"];
                    $Ajob_details = $row["Ajob_details"];
                }
            } else {
                echo "0 results";
            }
            $conn->close();
            ?>
            <p>เปิดรับสมัครตั้งแต่วันที่ <?php echo $Ajob_opening; ?> จนถึงวันที่ <?php echo $Ajob_closing; ?></p>
            <div class="content">
                <div class="image">
                    <img src="../../img/04.jpg" alt="Logo">
                    <a href="../user/applyProvider.php">
                        <button class="apply-button">คลิกเพื่อสมัคร</button>
                    </a>
                </div>
                <div class="qualifications">
                    <h2>คุณสมบัติ</h2>
                    <ul>
                        <?php
                        $qualifications = explode("\n", $Ajob_details);
                        foreach ($qualifications as $qualification) {
                            echo "<li>{$qualification}</li>";
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </section>
    </main>
</body>

</html>
