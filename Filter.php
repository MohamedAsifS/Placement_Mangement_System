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
            margin-left: 28%;
            margin-right: 5%;
            max-height: 400px;
            overflow-y: scroll;
            height: 180px;
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

        /* Placed Student Styles */
        .placed {
            background-color: #4CAF50; /* Green for placed students */
            color: #fff;
        }

        /* Not Placed Student Styles */
        .not-placed {
            background-color: #007bff; /* Blue for not placed students */
            color: #fff;
        }

        /* Filter Styles */
        /* Filter Container Styles */
        .filter-container {
            margin-top: 3%;
            margin-bottom: 20px;
            margin-left: 40%;
            margin-right: auto;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 90%; /* Adjust width as needed */
            max-width: 600px; /* Set maximum width */
        }

        /* Filter Section Styles */
        .filter-section {
            margin-bottom: 15px;
        }

        /* Filter Label Styles */
        .filter-label {
            font-weight: bold;
        }

        /* Filter Select Styles */
        .filter-select, .filter-input {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-top: 5px;
            width: 100%; /* Adjust width as needed */
        }

        /* Filter Button Styles */
        .filter-button {
            padding: 8px 16px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .filter-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <a href="index.php">
        <img src="kct1.jpeg" alt="" height="90px">
    </a>

    <header>PLACEMENT MANAGEMENT SYSTEM</header>
    <nav>
        <ul class="nav-list">
            <li>
                <a href="placementcell_view_comapany.php"><span>VIEW COMPANY</span></a>
            </li>
            <li>
                <a href="addstudent.php"><span>ADD STUDENT</span></a>
            </li>
            <li >
                <a href="placement_updater.php" ><span>STUDENT PLACEMENT UPDATER</span></a>
            </li>
            <li class="active">
                <a href="Filter.php" aria-current="page"><span>FILTER</span></a>
            </li>
        </ul>
    </nav>
    <div class="filter-container">
        <div class="filter-section">
            <label for="placement-status-filter" class="filter-label">Filter by Placement Status:</label>
            <select class="filter-select" id="placement-status-filter">
                <option value="all">All</option>
                <option value="placed">Placed</option>
                <option value="not-placed">Not Placed</option>
            </select>
        </div>
        <div class="filter-section">
            <label for="student-name-filter" class="filter-label">Filter by Student Name:</label>
            <select class="filter-select" id="student-name-filter">
                <option value="">Select Student</option>
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "pms";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT DISTINCT student_name FROM addstudent";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row["student_name"] . "'>" . $row["student_name"] . "</option>";
                    }
                }
                $conn->close();
                ?>
            </select>
        </div>
        <div class="filter-section">
            <label for="company-name-filter" class="filter-label">Filter by Company Name:</label>
            <select class="filter-select" id="company-name-filter">
                <option value="">Select Company</option>
                <?php
                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT DISTINCT company_name, hq_location FROM companies";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row["company_name"] . "'>" . $row["company_name"] . "</option>";
                    }
                }
                $conn->close();
                ?>
            </select>
        </div>
        <div class="filter-section">
            <label for="cgpa-filter" class="filter-label">Filter by CGPA:</label>
            <select class="filter-select" id="cgpa-filter">
                <option value="">Select CGPA</option>
                <?php
                for ($i = 10; $i >= 5; $i -= 0.5) {
                    echo "<option value='" . $i . "'>" . $i . "</option>";
                }
                ?>
            </select>
        </div>
        
    </div>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>Student Name</th>
                    <th>Student CGPA</th>
                    <th>Student Phone</th>
                    <th>Company Name</th>
                    <th>Location</th>
                    <th>Placement Status</th>
                </tr>
            </thead>
            <tbody>
            
            <?php
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql_student = "SELECT DISTINCT addstudent.student_id, addstudent.student_name, addstudent.student_cgpa, addstudent.student_phone, addstudent.placement_status, companies.company_name, companies.hq_location FROM addstudent LEFT JOIN companies ON addstudent.company_name = companies.company_name";

$result_student = $conn->query($sql_student);

if ($result_student->num_rows > 0) {
    while ($row_student = $result_student->fetch_assoc()) {
        $placementStatusClass = strtolower($row_student["placement_status"]) === "placed" ? "placed" : "not-placed";
        echo "<tr>";
        echo "<td class='$placementStatusClass'>" . $row_student["student_id"] . "</td>";
        echo "<td class='$placementStatusClass'>" . $row_student["student_name"] . "</td>";
        echo "<td class='$placementStatusClass'>" . $row_student["student_cgpa"] . "</td>";
        echo "<td class='$placementStatusClass'>" . $row_student["student_phone"] . "</td>";
        echo "<td class='$placementStatusClass'>" . $row_student["company_name"] . "</td>";
        echo "<td class='$placementStatusClass'>" . $row_student["hq_location"] . "</td>";
        echo "<td class='$placementStatusClass'>" . $row_student["placement_status"] . "</td>";
        // Add checkbox for not-placed students
        if(strtolower($row_student["placement_status"]) !== "placed") {
            echo "<td class='checkbox-column'><input type='checkbox' class='message-checkbox' data-student-id='" . $row_student["student_id"] . "'></td>";
        } else {
            echo "<td></td>"; // Empty cell for placed students
        }
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='8'>No data available</td></tr>";
}

$conn->close();
?>

</tbody>

        </table>
    </div>

    <script>
    function applyFilters() {
        var placementStatusFilter = document.getElementById("placement-status-filter").value;
        var studentNameFilter = document.getElementById("student-name-filter").value.toLowerCase();
        var companyNameFilter = document.getElementById("company-name-filter").value.toLowerCase();
        var cgpaFilter = document.getElementById("cgpa-filter").value;

        var rows = document.querySelectorAll("tbody tr");

        rows.forEach(function(row) {
            var placedStatus = row.cells[6].textContent.toLowerCase().trim();
            var studentName = row.cells[1].textContent.toLowerCase().trim();
            var companyName = row.cells[4].textContent.toLowerCase().trim();
            var cgpa = parseFloat(row.cells[2].textContent.trim());

            var showRow = true;

            if (placementStatusFilter !== "all") {
                if (placementStatusFilter === "placed") {
                    showRow = placedStatus === "placed";
                } else if (placementStatusFilter === "not-placed") {
                    showRow = placedStatus !== "placed";
                }
            }

            if (studentNameFilter !== "") {
                showRow = showRow && studentName.includes(studentNameFilter);
            }

            if (companyNameFilter !== "") {
                showRow = showRow && companyName.includes(companyNameFilter);
            }

            if (cgpaFilter !== "") {
                showRow = showRow && cgpa >= parseFloat(cgpaFilter);
            }

            if (showRow) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    }

    document.querySelectorAll('.filter-input, .filter-select').forEach(item => {
        item.addEventListener('change', event => {
            applyFilters();
        });
    });
    // Function to handle checkbox change event
    function handleCheckboxChange() {
            var checkboxes = document.querySelectorAll('.message-checkbox');
            checkboxes.forEach(function(checkbox) {
                checkbox.addEventListener('change', function(event) {
                    var studentId = event.target.dataset.studentId;
                    if(event.target.checked) {
                        // Send message to the student with studentId
                        sendMessage(studentId);
                    }
                });
            });
        }

        // Function to send message to the student with given studentId
        function sendMessage(studentId) {
            // Fetch API to send a message to the server
            fetch('send_message.php', {
                method: 'POST',
                body: JSON.stringify({ studentId: studentId }),
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(response => {
                if (response.ok) {
                    // Show success message
                    alert('Message sent successfully to student with ID: ' + studentId);
                } else {
                    // Show error message
                    alert('Failed to send message!');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                // Show error message
                alert('Failed to send message!');
            });
        }

        // Call the handleCheckboxChange function when the page loads
        document.addEventListener('DOMContentLoaded', function() {
            handleCheckboxChange();
        });
</script>

</body>
</html>

