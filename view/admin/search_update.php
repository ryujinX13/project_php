<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <title>ค้นหาผู้ให้บริการ</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../css/admin/stylesupdate_prov.css">
</head>

<body>
    <div class="tab-bar">
        <img src="../../img/logo1.png" alt="Logo">
        <button class="back-button" onclick="window.location.href='prov_display.php'">⬅️</button>
    </div>

    <div class="container">
        <h2>ค้นหาผู้ให้บริการ</h2>
        <form method="get" action="update_prov.php"> <!-- เปลี่ยน method เป็น get -->
            <label for="Prov_id">รหัสบัตรประชาชน:</label>
            <input type="text" name="Prov_id"><br> <!-- ลบ attribute name ที่ไม่จำเป็นออก -->
            <input type="submit" value="ค้นหา">
        </form>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>