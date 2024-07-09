<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../css/admin/stylesprov_display.css">
    <title>Provider Information</title>
</head>
<body>
<div class="tab-bar">
    <img src="../../img/logo1.png" alt="Logo">
    <a href="index.html" class="tab-link">หน้าแรก</a>
    <a href="booking.html" class="tab-link">ข้อมูลพนักงาน</a>
    <a href="booking_list.html" class="tab-link">การอบรม</a>
    <a href="history.html" class="tab-link">รายงาน</a>  
    <a href="login.html" class="tab-link login">เข้าสู่ระบบ</a>
    <a href="register.html" class="tab-link register">ลงทะเบียน</a>
</div>

<div class="container">
    <h2>Provider Information</h2>
    <?php include '../../process/displayProv_process.php'; ?>
    <div class="button-container">
        <a class="button" href="add_prov.php">เพิ่มผู้ให้บริการ</a>
        <a class="button" href="search_update.php">แก้ไขข้อมูล</a>
        <a class="button" href="search_delete.php">ลบข้อมูล</a>
    </div>
</div>

<script>
function deleteRow(id) {
    if (confirm("คุณต้องการลบข้อมูลใช่หรือไม่?")) {
        fetch(`delete_prov.php?id=${id}`, {
            method: 'GET'
        })
        .then(response => response.text())
        .then(data => {
            console.log(data);
            if (data.trim() === "ลบข้อมูลเรียบร้อยแล้ว") {
                const row = document.getElementById(`row-${id}`);
                if (row) {
                    row.remove();
                }
            } else {
                alert("เกิดข้อผิดพลาดในการลบข้อมูล: " + data);
            }
        })
        .catch(error => {
            console.error('เกิดข้อผิดพลาดในการลบข้อมูล:', error);
            alert("เกิดข้อผิดพลาดในการลบข้อมูล: " + error);
        });
    }
}
</script>
</body>
</html>
