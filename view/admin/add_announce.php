<?php
session_start();
include ('../../connect/connection.php');

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Ajob_opening = $_POST['Ajob_opening'];
    $Ajob_closing = $_POST['Ajob_closing'];
    $Ajob_details = $_POST['Ajob_details'];

    $sql = "INSERT INTO job_announcement (Ajob_opening, Ajob_closing, Ajob_details) VALUES ('$Ajob_opening', '$Ajob_closing', '$Ajob_details')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('เพิ่มประกาศรับสมัครงานเรียบร้อยแล้ว');window.location='edit_announce.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มประกาศรับสมัครงาน</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Mitr:wght@200;300;400;500;600;700&display=swap');

body {
    font-family: "Mitr", sans-serif;
    line-height: 1.6;
    background-color: #f5f5f5;
    margin: 0;
    padding: 0;
}

.tab-bar {
    position: relative; 
    z-index: 10; 
    display: flex;
    align-items: center;
    background-color: #8ab7cc;
    padding: 10px 0;
    justify-content: center;
    font-family: "Mitr", sans-serif;
}

.tab-bar img {
    height: 80px;
    margin-right: auto;
    margin-left: 20px;
    margin-left: 45%;
}


.container {
    max-width: 1400px;
    margin: 50px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    text-align: center;
}

h2 {
    color: #000000;
    font-weight: 400; /* ลดความหนาตัวหนังสือ */
    font-size: 30px;
}

form {
    display: flex;
    flex-direction: column;
    align-items: center;
    
}

label {
    margin: 10px 0 10px;
}

input[type="text"],
input[type="date"],
textarea {
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 5px;
    width: 80%;
}

textarea {
    height: 150px;
}

input[type="submit"] {
    padding: 10px 20px;
    background-color: #007bff;
    color: rgb(255, 255, 255);
    border: none;
    border-radius: 20px;
    cursor: pointer;
    transition: background-color 0.3s;
}

input[type="submit"]:hover {
    background-color: #0056b3;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
}


th, td {
    padding: 10px;
    border: 1px solid #000000;
    text-align: left;
    background-color: #fff;
  
    font-size: 16px;
    
    
}

th {
    background-color: #8ab7cc;
    color: #fff;
    font-weight: bold;
    font-weight: 400; /* ลดความหนาตัวหนังสือ */
    text-align: center;
    font-size: 16px;
}
.btn{
    display: inline-block;
    padding: 10px 20px;
    background-color: #007bffeb;
    color: #fff;
    text-decoration: none;
    border-radius: 20px;
    margin: 5px;
    transition: background-color 0.3s ease;
}
.btn:hover {
    background-color: 45a049;

}
.back-button {
    position: absolute;
    left: 10px;
    background: none;
    border: none;
    font-size: 3em;
    color: black;
    cursor: pointer;
    transition: color 0.3s ease, transform 0.3s ease;
    margin-left: 5%;
    outline: none; 
}

.back-button:focus {
    outline: none; /
}
.back-button:hover {
    color: white;
    transform: scale(1.1);
}

    </style>
</head>
<body>
    <div class="tab-bar">
        <img src="../../img/logo1.png" alt="Logo">
            </div>
        </div>
    </div>

    <div class="container">
    <button class="back-button" onclick="window.location.href='edit_announce.php'">⬅️</button>
        <h2>เพิ่มประกาศรับสมัครงาน</h2>
        <form action="add_announce.php" method="post">
            <label for="Ajob_opening">วันที่เปิดรับสมัคร:</label>
            <input type="date" id="Ajob_opening" name="Ajob_opening" required>
            <label for="Ajob_closing">วันที่ปิดรับสมัคร:</label>
            <input type="date" id="Ajob_closing" name="Ajob_closing" required>
            <label for="Ajob_details">รายละเอียด:</label>
            <textarea id="Ajob_details" name="Ajob_details" required></textarea>
            <input type="submit" value="เพิ่มประกาศ">
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.getElementById('dropdownMenuButton').addEventListener('click', function () {
            var dropdownMenu = document.getElementById('dropdownMenu');
            dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';

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
