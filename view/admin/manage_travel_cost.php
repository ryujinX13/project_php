<?php
session_start();
include('../../connect/connection.php');

// ตรวจสอบว่าผู้ใช้ล็อคอินอยู่หรือไม่
if (!isset($_SESSION['username']))

// ตรวจสอบการเชื่อมต่อกับฐานข้อมูล
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ดึงข้อมูลจากตาราง travel_distance_cost
$sql = "SELECT * FROM travel_distance_cost";
$result = $conn->query($sql);

// อัพเดทข้อมูลเมื่อมีการส่งข้อมูลจากฟอร์ม
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $distance = $_POST['distance'];
    $excess = $_POST['excess'];
    $update_sql = "UPDATE travel_distance_cost SET Tracost_distance = '$distance', TraCost_excess = '$excess' WHERE TraCost_id = '$id'";
   
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Manage Travel Cost</title>
    
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
            max-width: 1320px;
            margin: 20px auto;
            padding: 40px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            background-color: #f1f1f1;
        }

        .sidebar {
            flex: 1;
            max-width: 230px;
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
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background-color: #fff;
            
        }
        

        table,
        th,
        td {
            border: 1px solid #ddd;
            font-weight: 400; /* ลดความหนาตัวหนังสือ */
            color: #000;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #fff;
        }

        tr:nth-child(even) {
            background-color: #fff;
        }

        .form-inline {
            display: flex;
            flex-direction: column;
        }

        .form-inline input[type="number"] {
            width: 100px;
            margin-right: 10px;
        }

        .form-inline button {
            margin-top: 10px;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
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
        <h2>จัดการข้อมูลค่าระยะทาง-เดินทาง</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                        <th>รหัสค่าระยะทาง</th>
                        <th>ค่าเดินทาง</th>
                        <th>ค่าใช้จ่ายส่วนเกิน</th>
                        <th>แก้ไข</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['TraCost_id'] . "</td>";
                        echo "<td>" . $row['Tracost_distance'] . "</td>";
                        echo "<td>" . $row['TraCost_excess'] . "</td>";
                        echo "<td>
                                <form action='' method='POST'>
                                    <input type='hidden' name='id' value='" . $row['TraCost_id'] . "'>
                                    <input type='number' name='distance' value='" . $row['Tracost_distance'] . "' required>
                                    <input type='number' name='excess' value='" . $row['TraCost_excess'] . "' required>
                                    <button type='submit' class='btn btn-primary'>บันทึก</button>
                                </form>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No records found</td></tr>";
                }
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

<?php
$conn->close();
?>
