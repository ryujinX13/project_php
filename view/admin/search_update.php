<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <title>ค้นหาผู้ให้บริการ</title>
    <link rel="stylesheet" type="text/css" href="../../css/admin/stylesupdate_prov.css">
</head>

<body>
    <div class="tab-bar">
        <img src="../../img/logo1.png" alt="Logo">
        <a href="admin_dashboard.php" class="tab-link">หน้าแรก</a>
        <a href="prov_display.php" class="tab-link">ข้อมูลพนักงาน</a>
        <a href="booking_list.html" class="tab-link">การอบรม</a>
        <a href="history.html" class="tab-link">รายงาน</a>
        <a href="announce.php" class="tab-link">ประกาศรับสมัครงาน</a>
        <div class="dropdown">
            <button class="tab-button dropdown-toggle" type="button" id="dropdownMenuButton">
                <?php echo $_SESSION['admin_username']; ?>
            </button>
            <div class="dropdown-menu" id="dropdownMenu">
                <a class="dropdown-item" href="admin_account_details.php">รายละเอียดบัญชี</a>
                <a class="dropdown-item" href="../../process/logout.php">ล็อคเอ้าท์</a>
            </div>
        </div>
    </div>

    <div class="container">
        <h2>ค้นหาผู้ให้บริการ</h2>
        <form method="get" action="update_prov.php"> <!-- เปลี่ยน method เป็น get -->
            <label for="Prov_id">รหัสบัตรประชาชน:</label>
            <input type="text" name="Prov_id"><br> <!-- ลบ attribute name ที่ไม่จำเป็นออก -->
            <input type="submit" value="ค้นหา">
        </form>
    </div>
    <script>
        document.getElementById('dropdownMenuButton').addEventListener('click', function () {
            var dropdownMenu = document.getElementById('dropdownMenu');
            dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
        });

        // Close the dropdown menu if the user clicks outside of it
        window.onclick = function (event) {
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