<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สมัครงาน</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="../../css/user/stylesapplyProvider.css">
</head>

<body>
    <div class="tab-bar">
        <img src="../../img/logo1.png" alt="Logo">
        <a href="../../index.php" class="tab-link">หน้าแรก</a>
        <a href="booking.php" class="tab-link">การจอง</a>
        <a href="booking_list.php" class="tab-link">รายการจอง</a>
        <a href="history.php" class="tab-link">ประวัติ</a>
        <a href="../user/announce.php" class="tab-link announce">สมัครงาน</a>
        <a href="login_level.php" class="tab-link login">เข้าสู่ระบบ</a>
        <a href="register.php" class="tab-link register">ลงทะเบียน</a>
        
    </div>

    <div class="container">
        <a href="../user/announce.php" class="back-button"><i class="fas fa-arrow-left"></i></a>
        <h1>สมัครงาน</h1>

        <form action="../../process/applyProvider_process.php" method="post" enctype="multipart/form-data">
            <label for="prov_id">รหัสบัตรประจำตัวประชาชนผู้ให้บริการ :</label>
            <input type="text" id="prov_id" name="prov_id" required>

            <label for="prov_name">ชื่อสกุล :</label>
            <input type="text" id="prov_name" name="prov_name" required>
            <br>
            <div class="gender-label">
                <span>เพศ:</span>
                <input type="radio" id="male" class="gender-input" name="prov_gender" value="0" required>
                <label for="male">ชาย</label>
                <input type="radio" id="female" class="gender-input" name="prov_gender" value="1" required>
                <label for="female">หญิง</label>
            </div><br>

            <label for="prov_birthday" class="form-label">วันเกิด :</label>
            <div class="input-wrapper">
                <input type="date" id="prov_birthday" name="prov_birthday" class="input-field" required>
            </div>

            <label for="prov_address">ที่อยู่ :</label>
            <input type="text" id="prov_address" name="prov_address" required>

            <label for="prov_addressnow">ที่อยู่ปัจจุบัน :</label>
            <input type="text" id="prov_addressnow" name="prov_addressnow" required>

            <label for="prov_nationality">สัญชาติ :</label>
            <input type="text" id="prov_nationality" name="prov_nationality" required>

            <label for="prov_religion">ศาสนา :</label>
            <input type="text" id="prov_religion" name="prov_religion" required>

            <label for="prov_email">อีเมล์ :</label>
            <input type="email" id="prov_email" name="prov_email" required>

            <label for="prov_phone">เบอร์โทรศัพท์ :</label>
            <input type="tel" id="prov_phone" name="prov_phone" required>

            <label for="prov_study">วุฒิการศึกษา :</label>
            <input type="text" id="prov_study" name="prov_study" required>

            <label for="prov_img">รูปภาพ:</label>
            <input type="file" id="prov_img" name="prov_img" accept="image/*" required>

            <input type="submit" value="สมัครงาน">
        </form>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>
