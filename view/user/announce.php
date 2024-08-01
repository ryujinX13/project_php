<?php
session_start();
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
        <a href="#" class="tab-link">รายการจอง</a>
        <a href="#" class="tab-link">ประวัติการจอง</a>
        <a href="../user/announce.php" class="tab-link announce">สมัครงาน</a>

        <?php if ($isLoggedIn): ?>
            <div class="dropdown">
                <button class="tab-button dropdown-toggle" type="button" id="dropdownMenuButton">
                    <?php echo $_SESSION['username']; ?>
                </button>
                <div class="dropdown-menu" id="dropdownMenu" style="background-color: #f8f9fa; border-radius: 8px;">
                    <a class="dropdown-item" href="account_user.php">
                        <span style="margin-right: 8px;">🔍</span>รายละเอียดบัญชี
                    </a>
                    <a class="dropdown-item" href="#">
                        <span style="margin-right: 8px;">📅</span>รายการจอง
                    </a>
                    <a class="dropdown-item" href="#">
                        <span style="margin-right: 8px;">📜</span>ประวัติการจอง
                    </a>
                    <a class="dropdown-item" href="private_agency.php">
                        <span style="margin-right: 8px;">🏢</span>ข้อมูลหน่วยงาน
                    </a>
                    <a class="dropdown-item" href="../../process/logout.php">
                        <span style="margin-right: 8px;">🔓</span>ออกจากระบบ
                    </a>
                </div>
            </div>
        <?php else: ?>
            <a href="login.php" class="tab-link login">เข้าสู่ระบบ</a>
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

            // Query to get the latest job announcement
            $sql = "SELECT Ajob_id, Ajob_opening, Ajob_closing, Ajob_details FROM job_announcement ORDER BY Ajob_id DESC LIMIT 1";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $Ajob_id = $row["Ajob_id"];
                    $Ajob_opening = $row["Ajob_opening"];
                    $Ajob_closing = $row["Ajob_closing"];
                    $Ajob_details = $row["Ajob_details"];
                }
            } else {
                echo "0 results";
            }
            $conn->close();

            // เปรียบเทียบวันที่ปัจจุบันกับวันที่ปิดรับสมัคร
            $currentDate = date('Y-m-d');
            $isClosed = $currentDate > $Ajob_closing;
            ?>
            <p>เปิดรับสมัครตั้งแต่วันที่ <?php echo $Ajob_opening; ?> จนถึงวันที่ <?php echo $Ajob_closing; ?></p>
            <div class="content">
                <div class="image">
                    <img src="../../img/img5.png" alt="Logo">
                    <?php if (!$isClosed): ?>
                        <a href="../user/applyProvider.php?ajob_id=<?php echo $Ajob_id; ?>">
                            <button class="apply-button">คลิกเพื่อสมัคร</button>
                        </a>
                    <?php endif; ?>
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
            <p>📞 <a href="tel:093-5017778">093-5017778</a></p>
            <p><a href="https://line.me/R/ti/p/@ulab" target="_blank"><img src="../../img/Line.png" alt="Line Icon"> @ulab</a></p>
            <p>📧 <a href="mailto:ucliniclab@gmail.com">ucliniclab@gmail.com</a></p>
        </div>

        <div class="address">
            <p><a href="https://maps.app.goo.gl/f8urFAwixWuarR8n9" target="_blank">
                ที่อยู่ กังสดาร ใกล้รพ.ศรีนครินทร์ มหาวิทยาลัยขอนแก่น<br>
                - กังสดาล วงเวียนสามแยก เลยบึงหนองแวงตราชู<br>
                - มาจากในเมืองขอนแก่น ให้ขับผ่าน รพ.ราชพฤกษ์ แล้วเลี้ยวซ้าย<br>
                ก่อนถึงปั้ม ปตท. เข้าซอยสวัสดี ขับเรื่อยๆจนเจอวงเวียนสามแยก
            </a></p>
        </div>

        <div class="footimg">
            <a href="https://maps.app.goo.gl/f8urFAwixWuarR8n9" target="_blank">
                <img src="../../img/ประกาศ02.png" alt="footer">
            </a>
            <a href="https://www.facebook.com/lookhlan" target="_blank">
                <img src="../../img/ปกลูกหลาน.png" alt="footer">
            </a>
            <a href="https://www.facebook.com/Ucliniclab" target="_blank">
                <img src="../../img/ประกาศ03.png" alt="footer">
            </a>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
       document.getElementById('dropdownMenuButton').addEventListener('click', function () {
                var dropdownMenu = document.getElementById('dropdownMenu');
                dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';

                const rect = dropdownMenu.getBoundingClientRect();
                const windowWidth = window.innerWidth;

                if (rect.right > windowWidth) {
                    dropdownMenu.style.left = 'auto';
                    dropdownMenu.style.right = '0';
                } else if (rect.left < 0) {
                    dropdownMenu.style.left = '0';
                    dropdownMenu.style.right = 'auto';
                } else {
                    dropdownMenu.style.left = '0';
                    dropdownMenu.style.right = 'auto';
                }
            });

            window.onclick = function(event) {
                if (!event.target.matches('.tab-button')) {
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
