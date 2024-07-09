<!DOCTYPE html>
<html>

<head>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
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
                <th>รหัสบัตรประชาชน</th>
                <th>ชื่อ-สกุล</th>
                <th>วันที่เข้าทำงาน</th>
                <th>สถานะการอบรม</th>
                <th>อีเมลล์</th>
                <th>เบอร์โทรศัพท์</th>
            </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr id='row-" . $row['Prov_id'] . "'>";
            echo "<td>" . $row['Prov_id'] . "</td>";
            echo "<td>" . $row['Prov_name'] . "</td>";
            echo "<td>" . $row['Prov_datejob'] . "</td>";
            echo "<td>" . $row['Prov_train'] . "</td>";
            echo "<td>" . $row['Prov_email'] . "</td>";
            echo "<td>" . $row['Prov_phone'] . "</td>";
            echo "<td>
        <a href='update_prov.php?Prov_id=" . $row['Prov_id'] . "'>📝</a> <!-- Edit icon -->
        <a href='#' onclick=\"deleteRow(" . $row['Prov_id'] . "); return false;\">🗑️</a> <!-- Delete icon -->
      </td>";

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