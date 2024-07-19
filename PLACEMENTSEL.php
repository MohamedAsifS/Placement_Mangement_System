<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Placed Student Details</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Table Container Styles */
        .table-container {
            max-width: 80%;
            overflow-x: auto;
            margin-left: 30%;
            overflow-y: scroll;
            height: 400px;
        }

        /* Table Styles */
        table {
            width: max-content; /* Adjusts the table width based on content */
            min-width: 100%; /* Ensures table fills its container */
            border-collapse: collapse;
            border-spacing: 0;
        }

        th, td {
            padding: 5px; /* Smaller padding */
            text-align: left;
            border-bottom: 1px solid #dee2e6;
            border-right: 1px solid #dee2e6;
            font-size: 12px; /* Smaller font size */
        }

        th:first-child, td:first-child {
            border-left: 1px solid #dee2e6;
        }

        th {
            background-color: #f8f9fa;
            font-weight: bold;
            color: #212529;
            text-transform: uppercase;
        }

        td {
            background-color: #fff;
            color: #212529;
        }

        /* Alternate row background */
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        /* Hover effect */
        tbody tr:hover {
            background-color: #e2e6ea;
        }
    </style>
</head>
<body>
    <a href="index.php">
        <img src="kct1.jpeg" alt="" height="90px">
    </a>

    <header>PLACEMENT MANGEMENT SYSTEM</header>
    <nav>
        <ul class="nav-list">
            <li>
                <a href="MCA.php"><span>ADD PLACEMENT COORDINATOR</span></a>
            </li>
            <li>
                <a href="addcompany.php"><span>ADD COMPANY</span></a>
            </li>
            <li class="active">
                <a href="PLACEMENTSEL.php" aria-current="page"><span>STUDENT STATUS</span></a>
            </li>
            <li>
                <a href="arrivedcompany.php"><span> COMPANY LIST</span></a>
            </li>
        </ul>
    </nav>
    <h2>Placed Student Details</h2>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>Student Name</th>
                    <th>Student CGPA</th>
                    <th>Student Phone</th>
                    <th>Company Name</th>
                    <th>Company Location</th>
                    <th>Placement Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Database connection parameters
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "pms";

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // SQL query to fetch data from the database
                $sql_student = "SELECT DISTINCT addstudent.student_id, addstudent.student_name, addstudent.student_cgpa, addstudent.student_phone, addstudent.placement_status, companies.company_name, companies.hq_location FROM addstudent LEFT JOIN companies ON addstudent.company_name = companies.company_name";

$result_student = $conn->query($sql_student);

if ($result_student->num_rows > 0) {
    while ($row_student = $result_student->fetch_assoc()) {
        $placementStatusClass = strtolower($row_student["placement_status"]) === "placed" ? "placed" : "not-placed";
        echo "<tr class='$placementStatusClass'>";
        echo "<td>" . $row_student["student_id"] . "</td>";
        echo "<td>" . $row_student["student_name"] . "</td>";
        echo "<td>" . $row_student["student_cgpa"] . "</td>";
        echo "<td>" . $row_student["student_phone"] . "</td>";
        echo "<td>" . $row_student["company_name"] . "</td>";
        echo "<td>" . $row_student["hq_location"] . "</td>";
        echo "<td>" . $row_student["placement_status"] . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='7'>No data available</td></tr>";
}
                // Close connection
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
