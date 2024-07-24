<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include("../../connect/connection.php");

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
        $query = "UPDATE private_agency SET Pva_name = '$name', Pva_detail = '$detail', Pva_address = '$address', Pva_email = '$email', Pva_phone = '$phone', Pva_photo = '$photo' WHERE Pva_id = '$id'";
    } else {
        $query = "UPDATE private_agency SET Pva_name = '$name', Pva_detail = '$detail', Pva_address = '$address', Pva_email = '$email', Pva_phone = '$phone' WHERE Pva_id = '$id'";
    }

    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "<div class='notification success'>Agency details updated successfully.</div>";
    } else {
        echo "<div class='notification error'>Failed to update agency details.</div>";
    }
}

$query = "SELECT * FROM private_agency";
$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Agency</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        h2 {
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .form-container {
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
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
    </style>
</head>
<body>
    <h2>Agency List</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Detail</th>
            <th>Address</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Photo</th>
            <th>Action</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?php echo $row['Pva_id']; ?></td>
            <td><?php echo $row['Pva_name']; ?></td>
            <td><?php echo $row['Pva_detail']; ?></td>
            <td><?php echo $row['Pva_address']; ?></td>
            <td><?php echo $row['Pva_email']; ?></td>
            <td><?php echo $row['Pva_phone']; ?></td>
            <td>
                <?php if ($row['Pva_photo']): ?>
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($row['Pva_photo']); ?>" width="50" height="50">
                <?php endif; ?>
            </td>
            <td><a href="edit_agency.php?id=<?php echo $row['Pva_id']; ?>">Edit</a></td>
        </tr>
        <?php endwhile; ?>
    </table>

    <?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = "SELECT * FROM private_agency WHERE Pva_id = '$id'";
        $result = mysqli_query($conn, $query);
        $agency = mysqli_fetch_assoc($result);
    ?>
    <div class="form-container">
        <h2>Edit Agency Details</h2>
        <form method="POST" action="" enctype="multipart/form-data">
            <input type="hidden" name="Pva_id" value="<?php echo $agency['Pva_id']; ?>">
            <label for="Pva_name">Name:</label>
            <input type="text" id="Pva_name" name="Pva_name" value="<?php echo $agency['Pva_name']; ?>">
            <label for="Pva_detail">Detail:</label>
            <textarea id="Pva_detail" name="Pva_detail"><?php echo $agency['Pva_detail']; ?></textarea>
            <label for="Pva_address">Address:</label>
            <textarea id="Pva_address" name="Pva_address"><?php echo $agency['Pva_address']; ?></textarea>
            <label for="Pva_email">Email:</label>
            <input type="email" id="Pva_email" name="Pva_email" value="<?php echo $agency['Pva_email']; ?>">
            <label for="Pva_phone">Phone:</label>
            <input type="text" id="Pva_phone" name="Pva_phone" value="<?php echo $agency['Pva_phone']; ?>">
            <label for="Pva_photo">Photo:</label>
            <input type="file" id="Pva_photo" name="Pva_photo">
            <input type="submit" name="submit" value="Update">
        </form>
    </div>
    <?php } ?>
</body>
</html>
