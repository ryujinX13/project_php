    <?php
    include ('../connect/connection.php');
    session_start();
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // ตรวจสอบการเชื่อมต่อ
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $Prov_id = $_POST['Prov_id'];
    $Prov_Username = $_POST['Prov_Username'];
    $Prov_password = $_POST['Prov_password'];
    $Prov_name = $_POST['Prov_name'];
    $Prov_gender = $_POST['Prov_gender'];
    $Prov_birthday = $_POST['Prov_birthday'];
    $Prov_datejob = $_POST['Prov_datejob'];
    $Prov_address = $_POST['Prov_address'];
    $Prov_addressnow = $_POST['Prov_addressnow'];
    $Prov_nationality = $_POST['Prov_nationality'];
    $Prov_religion = $_POST['Prov_religion'];
    $Prov_train = $_POST['Prov_train'];
    $Prov_email = $_POST['Prov_email'];
    $Prov_phone = $_POST['Prov_phone'];
    $Prov_study = $_POST['Prov_study'];


    $sql = "INSERT INTO provider (Prov_id, Prov_Username, Prov_password, Prov_name, Prov_gender, Prov_birthday, Prov_datejob, Prov_address, Prov_addressnow, Prov_nationality, Prov_religion, Prov_train, Prov_email, Prov_phone, Prov_study) VALUES ('$Prov_id', '$Prov_Username', 
    '$Prov_password', '$Prov_name', '$Prov_gender', '$Prov_birthday', '$Prov_datejob', '$Prov_address', '$Prov_addressnow', '$Prov_nationality', '$Prov_religion','$Prov_train', '$Prov_email', '$Prov_phone', '$Prov_study')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Record Inserted Successfully!');</script>";
        echo "<script>window.location.href='../view/admin/prov_display.php'</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // ปิดการเชื่อมต่อ MySQL
    $conn->close();
    ?>