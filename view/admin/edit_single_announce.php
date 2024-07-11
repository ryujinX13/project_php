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
            <div class="dropdown-menu" id="dropdownMenu">
                <a class="dropdown-item" href="admin_account_details.php">รายละเอียดบัญชี</a>
                <a class="dropdown-item" href="../../process/logout.php">ล็อคเอ้าท์</a>
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
            <input type="submit" name="update" value="อัปเดต">
        </form>
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

<?php $conn->close(); ?>
