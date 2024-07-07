<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/user/stylesHomepage.css">
</head>

<body>

    <div class="tab-bar">
        <img src="img/logo1.png" alt="Logo">
        <a href="index.php" class="tab-link">หน้าแรก</a>
        <a href="#" class="tab-link" id="booking-link">การจอง</a>
        <a href="#" class="tab-link" id="booking-list-link">รายการจอง</a>
        <a href="#" class="tab-link" id="history-link">ประวัติ</a>
        <a href="view/user/applyProvider.php" class="tab-link">สมัครงาน</a>
        <a href="view/user/login.php" class="tab-link login">เข้าสู่ระบบ</a>
        <a href="view/user/register.php" class="tab-link register">ลงทะเบียน</a>
    </div>
    
    <div class="container mt-5">
        <h1>ลูกหลานสำรอง บริการพาไปหาหมอ <br> ดูแลแทนญาติเหมือนลูกหลานของท่าน</h1>
        <br>
        <p>เมื่อพ่อแม่ ผู้สูงอายุ หรือคนที่คุณรัก มีนัดไปหาหมอที่โรงพยาบาล หรือไปทำธุระต่างๆ แต่คุณติดงานและลาไม่ได้
            หาคนดูแลไม่ได้ จะทำอย่างไร<br>
            เราเป็นกลุ่มนักเรียนนักศึกษา ได้เห็นความลำบากของคนไข้สูงอายุที่มาโรงพยาบาล
            ในสังคมปัจจุบันที่มีผู้สูงอายุมากขึ้น ลูกหลานต่างมีภาระหน้าที่การงาน<br>
            จึงอยากเข้ามารับอาสา ทำหน้าที่ตรงนี้ และอยากหารายได้พิเศษระหว่างเรียนด้วย
            จึงจัดตั้งกลุ่มนี้ขึ้นมาเพื่อแก้ปัญหานี้ของสังคมครับ</p>
        <img src="img/p3.png" class="home-image" alt="home image">
    </div>

    <!-- Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">กรุณาเข้าสู่ระบบ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    กรุณาเข้าสู่ระบบก่อนทำการจอง
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                    <a href="view/user/login.php" class="btn btn-primary">เข้าสู่ระบบ</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.getElementById('booking-link').addEventListener('click', function (event) {
            event.preventDefault();
            $('#loginModal').modal('show');
        });

        document.getElementById('booking-list-link').addEventListener('click', function (event) {
            event.preventDefault();
            $('#loginModal').modal('show');
        });

        document.getElementById('history-link').addEventListener('click', function (event) {
            event.preventDefault();
            $('#loginModal').modal('show');
        });
    </script>

</body>

</html>