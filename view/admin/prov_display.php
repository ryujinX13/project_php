<?php
session_start();

// Check if admin is logged in
$isAdminLoggedIn = isset($_SESSION['admin_username']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Provider Information</title>
    <link rel="stylesheet" type="text/css" href="../../css/admin/stylesprov_display.css">
</head>
<body>
<div class="tab-bar">
        <img src="../../img/logo1.png" alt="Logo">
        <a href="admin_dashboard.php" class="tab-link">หน้าแรก</a>
        <a href="prov_display.php" class="tab-link">ข้อมูลพนักงาน</a>
        <a href="booking_list.html" class="tab-link">การอบรม</a>
        <a href="history.html" class="tab-link">รายงาน</a>
        <a href="edit_announce.php" class="tab-link">ประกาศรับสมัครงาน</a>
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
    <h2>ตารางข้อมูลผู้ให้บริการ</h2>
    <?php include '../../process/displayProv_process.php'; ?>
    <div class="button-container">
        <a class="button" href="add_prov.php">เพิ่มผู้ให้บริการ</a>
        <a class="button" href="search_update.php">แก้ไขข้อมูล</a>
        <a class="button" href="search_delete.php">ลบข้อมูล</a>
    </div>
</div>

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
