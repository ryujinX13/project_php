<!DOCTYPE html>
<html>
<head>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
            padding: 5px;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>

<?php
include ('../../connect/connection.php');

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM Provider";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>
            <tr>
                <th>Prov ID</th>
                <th>Username</th>
                <th>Password</th>
                <th>Name</th>
                <th>Gender</th>
                <th>Birthday</th>
                <th>Date of Job</th>
                <th>Address</th>
                <th>Current Address</th>
                <th>Nationality</th>
                <th>Religion</th>
                <th>Training</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Study</th>
            </tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row['Prov_id']."</td>";
        echo "<td>".$row['Prov_Username']."</td>";
        echo "<td>".$row['Prov_password']."</td>";
        echo "<td>".$row['Prov_name']."</td>";
        echo "<td>".$row['Prov_gender']."</td>";
        echo "<td>".$row['Prov_birthday']."</td>";
        echo "<td>".$row['Prov_datejob']."</td>";
        echo "<td>".$row['Prov_address']."</td>";
        echo "<td>".$row['Prov_addressnow']."</td>";
        echo "<td>".$row['Prov_nationality']."</td>";
        echo "<td>".$row['Prov_religion']."</td>";
        echo "<td>".$row['Prov_train']."</td>";
        echo "<td>".$row['Prov_email']."</td>";
        echo "<td>".$row['Prov_phone']."</td>";
        echo "<td>".$row['Prov_study']."</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
$conn->close();
?>

</body>
</html>
