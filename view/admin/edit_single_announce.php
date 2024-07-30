<?php
session_start();
include ('../../connect/connection.php');

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['update'])) {
    $id = $_POST['Ajob_id'];
    $opening = $_POST['Ajob_opening'];
    $closing = $_POST['Ajob_closing'];
    $details = $_POST['Ajob_details'];

    $sql = "UPDATE job_announcement SET Ajob_opening='$opening', Ajob_closing='$closing', Ajob_details='$details' WHERE Ajob_id='$id'";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('แก้ไขข้อมูลเรียบร้อยแล้ว');window.location='edit_announce.php';</script>";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM job_announcement WHERE Ajob_id='$id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
} else {
    echo "<script>alert('No ID specified.');window.location='edit_announce.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Announcement</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../css/admin/stylesedit_announce.css">
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
                <?php echo isset($_SESSION['admin_username']) ? $_SESSION['admin_username'] : 'Guest'; ?>
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
        <h2>แก้ไขประกาศรับสมัครงาน</h2>
        <form action="edit_single_announce.php" method="post">
            <input type="hidden" name="Ajob_id" value="<?php echo $row['Ajob_id']; ?>">
            <label for="Ajob_opening">วันที่เปิดรับสมัคร:</label>
            <input type="date" id="Ajob_opening" name="Ajob_opening" value="<?php echo $row['Ajob_opening']; ?>" required>
            <label for="Ajob_closing">วันที่ปิดรับสมัคร:</label>
            <input type="date" id="Ajob_closing" name="Ajob_closing" value="<?php echo $row['Ajob_closing']; ?>" required>
            <label for="Ajob_details">รายละเอียด:</label>
            <textarea id="Ajob_details" name="Ajob_details" required><?php echo $row['Ajob_details']; ?></textarea>
            <input type="submit" name="update" value="บันทึก">
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

<?php $conn->close(); ?>
