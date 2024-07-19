<?php
// Step 1: Connect to the database
$servername = "localhost"; // Change this to your database server name
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password
$dbname = "pms"; // Change this to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Step 2: Query the database to retrieve company data
$sql = "SELECT * FROM companies";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company List</title>
    <link rel="stylesheet" href="styl1.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: white;
        }

        .company-container {
            max-width: 800px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-right: 10%;
            margin-bottom: 1%;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
       ;
        }

        th, td {
            padding: 10px;
            border-bottom: 1px solid #ccc;
        }

        th {
            background-color: #f2f2f2;
        }
        .table-container {
            max-height: 400px; /* Adjust height as needed */
            overflow-y: auto;
        }
    </style>
</head>
<body>
<a href="index.php">
    <img src="kct1.jpeg" alt="" height=90px>
    </a>
    
    <header>PLACEMENT MANGEMENT SYSTEM</header>
    <nav>
      <ul class="nav-list">
        <li class="active" >
          <a href="placementcell_view_comapany.php" aria-current="page" ><span>VIEW COMPANY</span></a>
        </li>
        <li>
          <a href="addstudent.php"><span>ADD STUDENT</span></a>
        </li>
        <li>
          <a href="placement_updater.php"><span>STUDENT STATUS UPDATER</span></a>
        </li>
        <li >
        <a href="Filter.php" ><span>FILTER</span></a>
    </li>
        
      </ul>
    </nav>
    <div class="company-container">
        <h2>Company List</h2>
        <div class="table-container">
        <table>
            <tr>
                <th>Company Name</th>
                <th>Industry</th>
                
                <th>Headquarters Location</th>
                <th>Website</th>
            </tr>
            <?php
            // Step 3: Iterate over the fetched data
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["company_name"] . "</td>";
                    echo "<td>" . $row["industry"] . "</td>";
                   
                    echo "<td>" . $row["hq_location"] . "</td>";
                    echo "<td><a href='" . $row["website"] . "' target='_blank'>" . $row["website"] . "</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No companies found</td></tr>";
            }
            ?>
        </table>
        </div>
    </div>
</body>
</html>

<?php
// Step 4: Close the database connection
$conn->close();
?>