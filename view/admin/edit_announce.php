<?php
session_start();
include ('../../connect/connection.php');

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM job_announcement";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Announcements</title>
    <link rel="stylesheet" type="text/css" href="../../css/admin/stylesedit_announce.css">
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
        <h2>ตารางประกาศรับสมัครงาน</h2>
        <table>
            <thead>
                <tr>
                    <th>รหัส</th>
                    <th>วันที่เปิดรับสมัคร</th>
                    <th>วันที่ปิดรับสมัคร</th>
                    <th>รายละเอียด</th>
                    <th>การกระทำ</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['Ajob_id']; ?></td>
                            <td><?php echo $row['Ajob_opening']; ?></td>
                            <td><?php echo $row['Ajob_closing']; ?></td>
                            <td><?php echo $row['Ajob_details']; ?></td>
                            <td>
                                <a href="edit_single_announce.php?id=<?php echo $row['Ajob_id']; ?>">แก้ไข</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">ไม่มีข้อมูล</td>
                    </tr>
                <?php endif; ?>
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

<?php $conn->close(); ?>
