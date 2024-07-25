<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include("../../connect/connection.php");
session_start();

// Ensure the user is logged in
if (!isset($_SESSION['admin_username'])) {
    header("Location: ../../login.php");
    exit();
}

if (isset($_POST['submit'])) {
    $id = $_POST['Pva_id'];
    $name = $_POST['Pva_name'];
    $detail = $_POST['Pva_detail'];
    $address = $_POST['Pva_address'];
    $email = $_POST['Pva_email'];
    $phone = $_POST['Pva_phone'];

    // Handle file upload
    if (!empty($_FILES['Pva_photo']['name'])) {
        $photo = addslashes(file_get_contents($_FILES['Pva_photo']['tmp_name']));
        $query = "UPDATE private_agency SET Pva_name = ?, Pva_detail = ?, Pva_address = ?, Pva_email = ?, Pva_phone = ?, Pva_photo = ? WHERE Pva_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ssssssi', $name, $detail, $address, $email, $phone, $photo, $id);
    } else {
        $query = "UPDATE private_agency SET Pva_name = ?, Pva_detail = ?, Pva_address = ?, Pva_email = ?, Pva_phone = ? WHERE Pva_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('sssssi', $name, $detail, $address, $email, $phone, $id);
    }

    if ($stmt->execute()) {
        echo "<div class='notification success'>แก้ไขรายละเอียดหน่วยงานเรียบร้อยแล้ว</div>";
    } else {
        echo "<div class='notification error'>การแก้ไขรายละเอียดหน่วยงานล้มเหลว</div>";
    }
}

$query = "SELECT * FROM private_agency";
$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>แก้ไขหน่วยงาน</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Mitr:wght@200;300;400;500;600;700&display=swap');

        body {
            font-family: "Mitr", sans-serif;
            line-height: 1.6;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            font-weight: 400; /* ลดความหนาตัวหนังสือ */
        }

        .tab-bar {
            width: 100%;
            background-color: #8ab7cc;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px 0;
        }

        .tab-bar img {
            height: 80px;
            margin-right: auto;
            margin-left: 20px;
        }

        .tab-link {
            padding: 10px 20px;
            text-decoration: none;
            color: black;
            border: 1px solid transparent;
            border-radius: 3px;
            margin: 0 10px;
            transition: background-color 0.3s, border-color 0.3s;
        }

        .tab-link:hover {
            background-color: #ccc;
            border-color: #bbb;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown .tab-button {
            background-color: #F4CE14;
            color: black;
            border: none;
            border-radius: 10px;
            padding: 10px 20px;
            margin: 0 10px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .dropdown .tab-button:hover {
            background-color: #F4CE14;
            color: white;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            background-color: #96B6C5;
            border-radius: 10px;
            padding: 10px;
            z-index: 1;
            min-width: 160px;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
        }

        .dropdown-item {
            color: black;
            padding: 10px;
            text-decoration: none;
            display: block;
            transition: background-color 0.3s;
            border-radius: 5px;
        }

        .dropdown-item:hover {
            background-color: #F4CE14;
            color: white;
        }

        .main-container {
            display: flex;
            width: 100%;
            max-width: 1300px;
            margin: 20px auto;
            padding: 40px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            background-color: #f1f1f1;
        }

        .sidebar {
            flex: 1;
            max-width: 300px;
            background-color: #fff;
            padding: 5px;
            margin-right: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 250px;
        }

        .sidebar a {
            display: block;
            padding: 10px;
            margin-bottom: 10px;
            text-decoration: none;
            color: #333;
            border-radius: 4px;
            transition: background-color 0.3s;

        }

        .sidebar a:hover {
            background-color: #f1f1f1;
        }

        .sidebar a.active {
            background-color: #8ab7cc;
            color: white;
        }

        .content {
            flex: 2;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #000;
            text-align: center;
            font-weight: 400; /* ลดความหนาตัวหนังสือ */
        }

        table {
            width: 1000px;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
            font-weight: 400; /* ลดความหนาตัวหนังสือ */
            color: #000;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color:#f1f1f1;
        }

        tr:nth-child(even) {
            background-color: #fff;
        }

        .form-container {
            padding: 20px;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        input[type="text"], input[type="email"], textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        input[type="file"] {
            margin-bottom: 10px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
      

        .notification {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 4px;
            text-align: center;
        }

        .notification.success {
            background-color: #4CAF50;
            color: white;
        }

        .notification.error {
            background-color: #f44336;
            color: white;
        }

        .photo img {
            display: block;
            margin: 0 auto;
            width: 50px;
            height: 50px;
        }
    </style>
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
                <?php echo htmlspecialchars($_SESSION['admin_username']); ?>
            </button>
            <div class="dropdown-menu" id="dropdownMenu">
                <a class="dropdown-item" href="account_admin.php">
                    <span style="margin-right: 8px;">🔍</span>รายละเอียดบัญชี
                </a>
                <a class="dropdown-item" href="../../process/logout.php">
                    <span style="margin-right: 8px;">🔓</span>ออกจากระบบ
                </a>
            </div>
        </div>
    </div>

    <div class="main-container">
    <div class="sidebar">
            <a href="../admin/account_admin.php" class="menu-item">
                <span style="margin-right: 8px;">🔍</span>รายละเอียดบัญชี
            </a>
            <a href="../admin/edit_agency.php" class="menu-item">
                <span style="margin-right: 8px;">🏢</span>ข้อมูลหน่วยงาน
            </a>
            <a href="../admin/manage_travel_cost.php" class="menu-item">
                <span style="margin-right: 8px;">🚑</span>จัดการข้อมูลระยะทาง
            </a>
            <a href="../admin/manage_rates.php" class="menu-item">
            <span style="margin-right: 8px;">💰</span>จัดการข้อมูลแพคเกจ
            </a>
            <a href="../../process/logout.php" class="menu-item">
                <span style="margin-right: 8px;">🔓</span>ออกจากระบบ
            </a>
        </div>
        <div class="content">
            <h2>ข้อมูลหน่วยงาน</h2>
            <table>
                <tr>
                    <th>รหัส</th>
                    <th>ชื่อ</th>
                    <th>รายละเอียด</th>
                    <th>ที่อยู่</th>
                    <th>อีเมล</th>
                    <th>โทรศัพท์</th>
                    <th>รูปภาพ</th>
                    <th></th>
                </tr>
                <?php while($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['Pva_id']); ?></td>
                    <td><?php echo htmlspecialchars($row['Pva_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['Pva_detail']); ?></td>
                    <td><?php echo htmlspecialchars($row['Pva_address']); ?></td>
                    <td><?php echo htmlspecialchars($row['Pva_email']); ?></td>
                    <td><?php echo htmlspecialchars($row['Pva_phone']); ?></td>
                    <td class="photo">
                        <?php if ($row['Pva_photo']): ?>
                            <img src="data:image/jpeg;base64,<?php echo base64_encode($row['Pva_photo']); ?>" alt="รูปภาพหน่วยงาน">
                        <?php endif; ?>
                    </td>
                    <td><a href="edit_agency.php?id=<?php echo htmlspecialchars($row['Pva_id']); ?>">แก้ไข</a></td>
                </tr>
                <?php endwhile; ?>
            </table>

            <?php
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $query = "SELECT * FROM private_agency WHERE Pva_id = ?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param('i', $id);
                $stmt->execute();
                $result = $stmt->get_result();
                $agency = $result->fetch_assoc();
            ?>
            <div class="form-container">
                <h2>แก้ไขรายละเอียดหน่วยงาน</h2>
                <form method="POST" action="" enctype="multipart/form-data">
                    <input type="hidden" name="Pva_id" value="<?php echo htmlspecialchars($agency['Pva_id']); ?>">
                    <label for="Pva_name">ชื่อ:</label>
                    <input type="text" id="Pva_name" name="Pva_name" value="<?php echo htmlspecialchars($agency['Pva_name']); ?>">
                    <label for="Pva_detail">รายละเอียด:</label>
                    <textarea id="Pva_detail" name="Pva_detail"><?php echo htmlspecialchars($agency['Pva_detail']); ?></textarea>
                    <label for="Pva_address">ที่อยู่:</label>
                    <textarea id="Pva_address" name="Pva_address"><?php echo htmlspecialchars($agency['Pva_address']); ?></textarea>
                    <label for="Pva_email">อีเมล:</label>
                    <input type="email" id="Pva_email" name="Pva_email" value="<?php echo htmlspecialchars($agency['Pva_email']); ?>">
                    <label for="Pva_phone">โทรศัพท์:</label>
                    <input type="text" id="Pva_phone" name="Pva_phone" value="<?php echo htmlspecialchars($agency['Pva_phone']); ?>">
                    <label for="Pva_photo">รูปภาพ:</label>
                    <input type="file" id="Pva_photo" name="Pva_photo">
                    <input type="submit" name="submit" value="แก้ไข">
                </form>
            </div>
            <?php } ?>
        </div>
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
