<?php
// เริ่มเซสชัน
session_start();
$isLoggedIn = isset($_SESSION['username']);
$ajob_id = isset($_GET['ajob_id']) ? $_GET['ajob_id'] : '';
?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สมัครงาน</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../css/user/stylesapplyProvider.css">
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
            <a href="login_level.php" class="tab-link login">เข้าสู่ระบบ</a>
            <a href="register.php" class="tab-link register">ลงทะเบียน</a>
        <?php endif; ?>       
    </div>

    <div class="container">
        <div>
            <button class="back-button" onclick="window.location.href='announce.php'">⬅️</button>
        </div>
        <h1>สมัครงาน</h1>

        <form action="../../process/applyProvider_process.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="ajob_id" value="<?php echo $ajob_id; ?>"> <!-- ส่งค่า ajob_id ผ่านฟอร์ม -->
            <label for="prov_id">รหัสบัตรประจำตัวประชาชนผู้ให้บริการ :<span style="color: red;">*</label>
            <input type="text" id="prov_id" name="prov_id" required>

            <label for="prov_name">ชื่อสกุล :<span style="color: red;">*</label>
            <input type="text" id="prov_name" name="prov_name" required>
            <br>
            <div class="gender-label">
                <span>เพศ:<span style="color: red;">*</span>
                <input type="radio" id="male" class="gender-input" name="prov_gender" value="0" required>
                <label for="male">ชาย</label>
                <input type="radio" id="female" class="gender-input" name="prov_gender" value="1" required>
                <label for="female">หญิง</label>
            </div><br>

            <label for="prov_birthday" class="form-label">วันเกิด :<span style="color: red;">*</label>
            <div class="input-wrapper">
                <input type="date" id="prov_birthday" name="prov_birthday" class="input-field" required>
            </div>

            <label for="prov_address">ที่อยู่ :<span style="color: red;">*</label>
            <input type="text" id="prov_address" name="prov_address" required>

            <label for="prov_addressnow">ที่อยู่ปัจจุบัน :<span style="color: red;">*</label>
            <input type="text" id="prov_addressnow" name="prov_addressnow" required>

            <label for="prov_nationality">สัญชาติ :<span style="color: red;">*</label>
            <input type="text" id="prov_nationality" name="prov_nationality" required>

            <label for="prov_religion">ศาสนา :<span style="color: red;">*</label>
            <input type="text" id="prov_religion" name="prov_religion" required>

            <label for="prov_email">อีเมล์ :<span style="color: red;">*</label>
            <input type="email" id="prov_email" name="prov_email" required>

            <label for="prov_phone">เบอร์โทรศัพท์ :<span style="color: red;">*</label>
            <input type="tel" id="prov_phone" name="prov_phone" required>

            <label for="prov_study">วุฒิการศึกษา :<span style="color: red;">*</label>
            <input type="text" id="prov_study" name="prov_study" required>

            <label for="prov_img">รูปภาพ:<span style="color: red;">*</label>
            <input type="file" id="prov_img" name="prov_img" accept="image/*" required>

            <input type="submit" value="สมัครงาน">
        </form>
    </div>
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
