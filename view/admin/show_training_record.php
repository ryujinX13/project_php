<?php
session_start(); // เริ่มต้นเซสชั่น
include ('../../connect/connection.php');

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("การเชื่อมต่อล้มเหลว: " . $conn->connect_error);
}

// ดึงข้อมูลจากฐานข้อมูล
$sql = "SELECT * FROM training_record";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../css/admin/styles_showtraining.css">
    <title>Training Record</title>
   
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
            <div class="dropdown-menu" id="dropdownMenu" style="background-color: #f8f9fa; border-radius: 8px;"> 
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
    <h1>บันทึกการอบรม</h1>
    <table>
        <thead>
            <tr>
                <th>รหัสบันทึกการอบรม</th>
                <th>วันที่อบรม</th>
                <th>เลขที่ใบสมัคร</th>
                <th>เวลาอบรม</th>
                <th>รหัสบัตรประชาชน</th>
                <th>แก้ไข</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $training_date = empty($row['Training_date']) ? 'ยังไม่รับเข้ารับการอบรม' : $row['Training_date'];
                    echo "<tr>
                        <td>{$row['Training_id']}</td>
                        <td>{$training_date}</td>
                        <td>{$row['Ajob_id']}</td>
                        <td>{$row['Training_time']}</td>
                        <td>{$row['Prov_id']}</td>
                        <td>
                            <form method='post' action='edit_training_record.php'>
                                <input type='hidden' name='Training_id' value='{$row['Training_id']}'>
                                <input type='hidden' name='Training_date' value='{$row['Training_date']}'>
                                <input type='hidden' name='Training_time' value='{$row['Training_time']}'>
                                <input type='hidden' name='Prov_id' value='{$row['Prov_id']}'> <!-- เพิ่มฟิลด์นี้ -->
                                <button type='submit'>✏️</button>
                            </form>
                        </td>
                    </tr>";
                }
            }
            $conn->close();
            ?>
        </tbody>
    </table>
    </div>

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
