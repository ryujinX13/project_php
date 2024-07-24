<?php
include ('../../connect/connection.php');
session_start();

$conn = new mysqli($servername, $username, $password, $dbname);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="th">

<head>
    <title>Provider Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../css/admin/stylesdelete_prov.css">
</head>

<body>
    <div class="tab-bar">
        <img src="../../img/logo1.png" alt="Logo">
        <a href="admin_dashboard.php" class="tab-link">หน้าแรก</a>
        <a href="prov_display.php" class="tab-link">ข้อมูลพนักงาน</a>
        <a href="edit_agency.php" class="tab-link">ข้อมูลหน่วยงาน</a>
        <a href="booking_list.html" class="tab-link">การอบรม</a>
        <a href="history.html" class="tab-link">รายงาน</a>
        <a href="announce.php" class="tab-link">ประกาศรับสมัครงาน</a>
        <div class="dropdown">
            <button class="tab-button dropdown-toggle" type="button" id="dropdownMenuButton">
                <?php echo $_SESSION['admin_username']; ?>
            </button>
            <div class="dropdown-menu" id="dropdownMenu"style="background-color: #f8f9fa; border-radius: 8px;"> 
                    <a class="dropdown-item" href="account_details.php">
                        <span style="margin-right: 8px;">🔍</span>รายละเอียดบัญชี
                    </a>
                    <a class="dropdown-item" href="../../process/logout.php">
                        <span style="margin-right: 8px;">🔓</span>ออกจากระบบ
                    </a>
            </div>
        </div>
    </div>
    <div class="container">
        <h2>ลบผู้ให้บริการ</h2>
        <form method="post" action="../../process/deleteProv_process.php">
            รหัสผู้ให้บริการ: <input type="text" name="Prov_id" placeholder="กรอกรหัสผู้ให้บริการที่นี่"><br>
            <input type="submit" value="ลบผู้ให้บริการ">
        </form>
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
