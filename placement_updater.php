<?php
$error_message = '';
$success_message = '';

// Function to handle CSV file upload and extraction for updating placement details
function handlePlacementCsvUpload($file, $conn)
{
    // Specify the directory for storing uploaded files
    $uploadDirectory = "uploads";

    // Create the upload directory if it doesn't exist
    if (!file_exists($uploadDirectory)) {
        mkdir($uploadDirectory, 0777, true); // Creates the directory recursively with full permissions
    }

    // Get the file extension
    $fileExtension = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));

    // Validate file extension
    if ($fileExtension != "csv") {
        return "Only CSV files are allowed";
    }

    // Generate a unique name for the uploaded file
    $fileName = uniqid() . "." . $fileExtension;

    // Move the uploaded file to the specified directory
    if (move_uploaded_file($file["tmp_name"], $uploadDirectory . $fileName)) {
        // Open the uploaded CSV file
        $filePath = $uploadDirectory . $fileName;

        // Read the CSV file
        if (($handle = fopen($filePath, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                // Check if the row is empty
                if (empty(array_filter($data))) {
                    continue; // Skip processing empty rows
                }

                // Check if all necessary columns are present
                if (count($data) >= 3) {
                    // Escape and sanitize data for SQL query
                    $student_id = mysqli_real_escape_string($conn, $data[0]);
                    $company_name = mysqli_real_escape_string($conn, $data[1]);
                    $placement_status = mysqli_real_escape_string($conn, $data[2]);
                    

                    // Update placement status in the database
                    $sql = "UPDATE addstudent SET placement_status='$placement_status', company_name='$company_name' WHERE student_id='$student_id'";

                    // Execute SQL query
                    if (mysqli_query($conn, $sql)) {
                        
                        // No need for individual success messages here
                    } else {
                        return "Error updating placement status: " . mysqli_error($conn);
                    }
                } else {
                    // Handle incomplete data row
                    return "Incomplete data row found in the CSV file";
                }
            }
            fclose($handle);
        }

        // Delete the uploaded file after extraction
        unlink($filePath);

        return true;
    } else {
        return "Failed to upload file";
    }
}

// Check if the form is submitted for manual update
if (isset($_POST["manual_submit"])) {
    // Database connection parameters
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

    // Retrieve form data and sanitize
    $student_id = isset($_POST['student_id']) ? $_POST['student_id'] : '';
    $company_name = isset($_POST['company_name']) ? $_POST['company_name'] : '';
    $placement_status = isset($_POST['placement_status']) ? $_POST['placement_status'] : '';

    // Update placement status in the database
    $sql = "UPDATE addstudent SET placement_status='$placement_status', company_name='$company_name' WHERE student_id='$student_id'";

    if ($conn->query($sql) === TRUE) {
        $success_message = "Placement status updated successfully for student ID: $student_id";
    } else {
        $error_message = "Error updating placement status: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
}

// Check if the form is submitted for CSV upload
if (isset($_POST["submit"])) {
    // Database connection parameters
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

    // Check if a CSV file is uploaded
    if (isset($_FILES['placement_csv_file']) && $_FILES['placement_csv_file']['error'] === UPLOAD_ERR_OK) {
        $csvUploadResult = handlePlacementCsvUpload($_FILES['placement_csv_file'], $conn);
        if ($csvUploadResult === true) {
            $success_message .= "<div class='alert-container'><div class='alert'>CSV file uploaded and placement details updated successfully</div></div>";
        } else {
            $error_message .= "<div class='alert-container'><div class='alert alert-error'>$csvUploadResult</div></div>";
        }
    }

    // Close the database connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Placement Updater</title>
    <link rel="stylesheet" href="styl1.css">
    <style>
        /* Your existing CSS styles */
        main {
            margin-right: 14%;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 400px;
            margin: 15px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow-y: auto; /* Add scroll if content overflows vertically */
            max-height: 500px; /* Set max height for scrolling */
            position: relative; /* Add relative positioning */
        }

        h2 {
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"],
        input[type="number"],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button[type="submit"] {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-bottom: 30px;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 5px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        /* Alert styling */
        .alert-container {
            position: absolute;
            top: 10px; /* Adjust the distance from the top */
            right: 10px; /* Adjust the distance from the right */
            z-index: 999; /* Ensure it appears above other content */
        }

        .alert {
            padding: 15px;
            border-radius: 5px;
            font-size: 16px;
            max-width: 400px;
            background-color: #dff0d8;
            border: 1px solid #d6e9c6;
            color: #3c763d;
            text-align: center;
        }

        .alert-error {
            background-color: #f2dede;
            border-color: #ebccd1;
            color: #a94442;
        }

        .closebtn {
            margin-left: 15px;
            color: white;
            font-weight: bold;
            float: right;
            font-size: 22px;
            line-height: 20px;
            cursor: pointer;
            transition: 0.3s;
        }

        .closebtn:hover {
            color: black;
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
            <li>
                <a href="placementcell_view_comapany.php"><span>VIEW COMPANY</span></a>
            </li>
            <li>
                <a href="addstudent.php"><span>ADD STUDENT</span></a>
            </li>
            <li class="active">
                <a href="placementupdater.php" aria-current="page"><span>STUDENT PLACEMENT UPDATER</span></a>
            </li>
            <li>
                <a href="Filter.php"><span>FILTER</span></a>
            </li>
        </ul>
    </nav>
    <main>
        <div class="container">
            <h2>Student Placement Updater</h2>
            <?php if (!empty($error_message)): ?>
                <div class="alert-container">
                    <div class="alert alert-error"><?php echo $error_message; ?></div>
                </div>
            <?php endif; ?>
            <?php if (!empty($success_message)): ?>
                <div class="alert-container">
                    <div class="alert"><?php echo $success_message; ?></div>
                </div>
            <?php endif; ?>
            <!-- Manual Update Form -->
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <div class="form-group">
                    <label for="student_id">Student ID:</label>
                    <select id="student_id" name="student_id" required>
                        <option value="">Select Student ID</option>
                        <?php
                        // Database connection parameters
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

                        // Fetch student IDs from the database
                        $sql = "SELECT student_id FROM addstudent";
                        $result = $conn->query($sql);

                        // Output options for selection
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row['student_id'] . "'>" . $row['student_id'] . "</option>";
                            }
                        } else {
                            echo "<option value=''>No students available</option>";
                        }

                        // Close connection
                        $conn->close();
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="company_name">Select Company:</label>
                    <select id="company_name" name="company_name">
                        <?php
                        // Database connection parameters
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

                        // Fetch companies from the database
                        $sql = "SELECT * FROM companies";
                        $result = $conn->query($sql);

                        // Output options for selection
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row['company_name'] . "'>" . $row['company_name'] . "</option>";
                            }
                        } else {
                            echo "<option value=''>No companies available</option>";
                        }

                        // Close connection
                        $conn->close();
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="placement_status">Placement Status:</label>
                    <select id="placement_status" name="placement_status">
                        <option value="Placed">Placed</option>
                        <option value="Not Placed">Not Placed</option>
                    </select>
                </div>
                <button type="submit" name="manual_submit">Update Placement Status Manually</button>
            </form>

            
        </div>
    </main>
</body>
</html>
