<?php
session_start();
if (!isset($_SESSION['admin_username'])) {
    header("Location: admin_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../css/admin/stylesadmin_dashboard.css">
</head>

<body>
    <div class="tab-bar">
        <img src="../../img/logo1.png" alt="Logo">
        <a href="admin_dashboard.php" class="tab-link">หน้าแรก</a>
        <a href="prov_display.php" class="tab-link">ข้อมูลพนักงาน</a>
        <a href="show_training_record.php" class="tab-link">การอบรม</a>
        <a href="history.html" class="tab-link">รายงาน</a>
        <a href="edit_announce.php" class="tab-link">ประกาศรับสมัครงาน</a>
        <div class="dropdown">
            <button class="tab-button dropdown-toggle" type="button" id="dropdownMenuButton">
                <?php echo $_SESSION['admin_username']; ?>
            </button>
            <div class="dropdown-menu" id="dropdownMenu"style="background-color: #f8f9fa; border-radius: 8px;"> 
                    <a class="dropdown-item" href="account_admin.php">
                        <span style="margin-right: 8px;">🔍</span>รายละเอียดบัญชี
                    </a>
                    <a class="dropdown-item" href="edit_agency.php">
                        <span style="margin-right: 8px;">🏢</span>จัดการข้อมูลหน่วยงาน
                    </a>
                    <a class="dropdown-item" href="manage_travel_cost.php">
                        <span style="margin-right: 8px;">🚑</span>จัดการข้อมูลระยะทาง
                    </a>
                    <a class="dropdown-item" href="manage_rates.php">
                        <span style="margin-right: 8px;">💰</span>จัดการข้อมูลแพคเกจ
                    </a>
                    <a class="dropdown-item" href="../../process/logout.php">
                        <span style="margin-right: 8px;">🔓</span>ออกจากระบบ
                    </a>
            </div>
        </div>
    </div>

    <div class="container">
        <h2>ยินดีต้อนรับ, <?php echo $_SESSION['admin_username']; ?></h2>
        <p>นี่คือหน้าแดชบอร์ดของผู้ดูแลระบบ</p>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
       document.getElementById('dropdownMenuButton').addEventListener('click', function () {
                var dropdownMenu = document.getElementById('dropdownMenu');
                dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';

                // Check if the dropdown menu is out of the viewport
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

            // Close the dropdown menu if the user clicks outside of it
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