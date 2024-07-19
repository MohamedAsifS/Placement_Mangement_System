<?php

// Function to handle CSV file upload and extraction
function handleCsvUpload($file, $conn)
{
    // Specify the directory for storing uploaded files
    $uploadDirectory = "uploads/";

    // Create the upload directory if it doesn't exist
    if (!file_exists($uploadDirectory)) {
        mkdir($uploadDirectory, 0777, true); // Creates the directory recursively with full permissions
    }

    // Get the file extension
    $fileExtension = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));

    // Validate file extension
    if ($fileExtension != "csv") {
        echo "<div class='alert-container'><div class='alert alert-error'>Only CSV files are allowed</div></div>";
        return false;
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
                // Check if all necessary columns are present
                if(count($data) >= 5) {
                    // Escape and sanitize data for SQL query
                    $company_id = mysqli_real_escape_string($conn, $data[0]);
                    $company_name = mysqli_real_escape_string($conn, $data[1]);
                    $industry = mysqli_real_escape_string($conn, $data[2]);
                    $hq_location = mysqli_real_escape_string($conn, $data[3]);
                    $website = mysqli_real_escape_string($conn, $data[4]);
                   
                    if (empty($student_id)) {
                        
                    }

                    // Insert data into the database
                    $sql = "INSERT INTO companies (company_id, company_name, industry, hq_location, website) 
                            VALUES ('$company_id','$company_name', '$industry', '$hq_location', '$website')";

                    // Execute SQL query
                    if (mysqli_query($conn, $sql)) {
                        echo "<div class='alert-container'><div class='alert'>New record created successfully</div></div>";
                    } else {
                        echo "<div class='alert-container'><div class='alert alert-error'>Error inserting data: " . mysqli_error($conn) . "</div></div>";
                    }
                } else {
                    // Handle incomplete data row
                    echo "<div class='alert-container'><div class='alert alert-error'>Incomplete data row found in the CSV file</div></div>";
                }
            }
            fclose($handle);
        }

        // Delete the uploaded file after extraction
        unlink($filePath);

        return true;
    } else {
        echo "<div class='alert-container'><div class='alert alert-error'>Failed to upload file</div></div>";
        return false;
    }
}

// Check if the form is submitted
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

    // Retrieve form data and sanitize
   $company_id = isset($_POST['company_id']) ? mysqli_real_escape_string($conn, $_POST['company_id']) : '';
$company_name = isset($_POST['company_name']) ? mysqli_real_escape_string($conn, $_POST['company_name']) : '';
$industry = isset($_POST['industry']) ? mysqli_real_escape_string($conn, $_POST['industry']) : '';
$hq_location = isset($_POST['hq_location']) ? mysqli_real_escape_string($conn, $_POST['hq_location']) : '';
$website = isset($_POST['website']) ? mysqli_real_escape_string($conn, $_POST['website']) : '';
if (empty($company_id)) {
        
       
} else {
    // Insert data into database
    $sql = "INSERT INTO companies (company_id, company_name, industry, hq_location, website) 
            VALUES ('$company_id','$company_name', '$industry', '$hq_location', '$website')";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert-container'><div class='alert'>New record created successfully</div></div>";
    } else {
        echo "<div class='alert-container'><div class='alert alert-error'>Error: " . $sql . '\n' . $conn->error . "</div></div>";
    }}

    // Debugging: Output contents of $_FILES array
   

    // Check if a CSV file is uploaded
    if (isset($_FILES['excel_file']) && $_FILES['excel_file']['error'] === UPLOAD_ERR_OK) {
        handleCsvUpload($_FILES['excel_file'], $conn);
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
    <title>Add Company Form</title>
    <link rel="stylesheet" href="styl1.css">
    <style>
        /* Your CSS styles here */
        main {
            display: flex;
    justify-content: space-between;
    margin-top: 0%;
    padding-left: 40%;
    
        }

        #main-form {
            width: 40%;
        }

        #upload-form {
            width: 30%;
            margin-top: 60px;
            margin-right: 20%;
        }

        body {
            font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: white;
    overflow-x: hidden; /* Added */}

        h1 {
            text-align: center;
            margin-bottom: 1%;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 3px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"],
        input[type="url"],
        input[type="file"],
        button[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="text"]:focus,
        input[type="number"]:focus,
        input[type="url"]:focus,
        input[type="file"]:focus {
            outline: none;
            border-color: #007bff;
        }

        button[type="submit"] {
            background-color: #234;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: lightblue;
        }

        .alert-container {
            position: absolute;
            top: 91%;
            width: 100%;
            display: flex;
            justify-content: center;
            z-index: 1;
            margin-left: 2%;
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
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
    </style>
</head>
<body>
<a href="index.php">
    <img src="kct1.jpeg" alt="" height=90px>
</a>

<header>PLACEMENT MANAGEMENT SYSTEM</header>
<nav>
    <ul class="nav-list">
        <li>
            <a href="MCA.php"><span>ADD PLACEMENT COORDINATOR</span></a>
        </li>
        <li class="active">
            <a href="addcompany.php" aria-current="page"><span>ADD COMPANY</span></a>
        </li>
        <li>
            <a href="PLACEMENTSEL.php"><span>STUDENT STATUS</span></a>
        </li>
        <li>
            <a href="arrivedcompany.php"><span>COMPANY LIST</span></a>
        </li>
    </ul>
</nav>

<main>
    <div id="main-form">
        <h1>ADD COMPANY</h1>
        <div class="form-container">
            <form method="post">
                <div class="form-group">
                    <label for="company_id">Company id:</label>
                    <input type="text" id="company_id" name="company_id" required>
                </div>
                <div class="form-group">
                    <label for="company_name">Company Name:</label>
                    <input type="text" id="company_name" name="company_name" required>
                </div>
                <div class="form-group">
                    <label for="industry">Industry:</label>
                    <input type="text" id="industry" name="industry" required>
                </div>
                <div class="form-group">
                    <label for="hq_location">Headquarters Location:</label>
                    <input type="text" id="hq_location" name="hq_location" required>
                </div>
                <div class="form-group">
                    <label for="website">Website:</label>
                    <input type="url" id="website" name="website" required>
                </div>
                <div class="form-group">
                    <button type="submit" name="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
    <div id="upload-form">
    <h2>Upload CSV File</h2>
    <div class="form-container">
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="excel_file">Upload CSV File:</label>
                <input type="file" id="excel_file" name="excel_file" accept=".csv" required>
            </div>
            <div class="form-group">
                <button type="submit" name="submit">Upload</button>
            </div>
        </form>
    </div>
</div>

</main>
</body>
</html>
