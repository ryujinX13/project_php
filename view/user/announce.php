<?php
session_start();

// ตรวจสอบว่าผู้ใช้เข้าสู่ระบบหรือไม่
$isLoggedIn = isset($_SESSION['username']);
?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ประกาศรับสมัครพนักงานให้บริการ</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../css/user/stylesannounce.css">
</head>

<body>
    <div class="tab-bar">
        <img src="../../img/logo1.png" alt="Logo">
        <a href="../../index.php" class="tab-link">หน้าแรก</a>
        <a href="booking.php" class="tab-link">การจอง</a>
        <a href="booking_list.php" class="tab-link">รายการจอง</a>
        <a href="history.php" class="tab-link">ประวัติการจอง</a>
        <a href="../user/announce.php" class="tab-link announce">สมัครงาน</a>

        <!-- แสดงปุ่มตามสถานะการเข้าสู่ระบบ -->
        <?php if ($isLoggedIn): ?>
            <div class="dropdown">
                <button class="tab-button dropdown-toggle" type="button" id="dropdownMenuButton">
                    <?php echo $_SESSION['username']; ?>
                </button>
                <div class="dropdown-menu" id="dropdownMenu">
                    <a class="dropdown-item" href="account_details.php">รายละเอียดบัญชี</a>
                    <a class="dropdown-item" href="../../process/logout.php">ล็อคเอ้าท์</a>
                </div>
            </div>
        <?php else: ?>
            <a href="login_level.php" class="tab-link login">เข้าสู่ระบบ</a>
            <a href="register.php" class="tab-link register">ลงทะเบียน</a>
        <?php endif; ?>
    </div>

    <main>
        <section class="announcement">
            <h1>ประกาศรับสมัครพนักงานให้บริการ</h1>
            <?php
            include('../../connect/connection.php');

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT Ajob_opening, Ajob_closing, Ajob_details FROM job_announcement WHERE Ajob_id=1";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
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

    <footer>
        <div class="contact-info">
            <p>ติดต่อ-สอบถามยูคลินิกแล็บ</p>
            <p>📞 093-5017778</p>
            <p><img src="../../img/Line.png" alt="Line Icon"> @ulab</p>
            <p>📧 ucliniclab@gmail.com</p>
        </div>

        <div class="address">
            <p>ที่อยู่ กังสดาร ใกล้รพ.ศรีนครินทร์ มหาวิทยาลัยขอนแก่น</p>
            <p>- กังสดาล วงเวียนสามแยก เลยบึงหนองแวงตราชู</p>
            <p>- มาจากในเมืองขอนแก่น ให้ขับผ่าน รพ.ราชพฤกษ์ แล้วเลี้ยวซ้าย</p>
            <p>ก่อนถึงปั้ม ปตท. เข้าซอยสวัสดี ขับเรื่อยๆจนเจอวงเวียนสามแยก</p>
            </div>
            
        <div class="footimg">
            <img src="../../img/ประกาศ02.png" alt="footer">
            <img src="../../img/ประกาศ01.jpg" alt="footer">
            <img src="../../img/ประกาศ03.png" alt="footer">
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.getElementById('dropdownMenuButton').addEventListener('click', function () {
            var dropdownMenu = document.getElementById('dropdownMenu');
            dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
        });

        // Close the dropdown menu if the user clicks outside of it
        window.onclick = function(event) {
            if (!event.target.matches('.dropdown-toggle')) {
                var dropdowns = document.getElementsByClassName("dropdown-menu");
                for (var i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.style.display === 'block') {
                        openDropdown.style.display = 'none';
                    }
                }
            }
        }
    </script>

</body>

</html>