<?php
$error_message = '';
$success_message = '';

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
                if (count($data) >= 11) {
                    // Escape and sanitize data for SQL query
                    $student_id = mysqli_real_escape_string($conn, $data[0]);
                    $student_name = mysqli_real_escape_string($conn, $data[1]);
                    $email = mysqli_real_escape_string($conn, $data[2]);
                    $phone = mysqli_real_escape_string($conn, $data[3]);
                    $department = mysqli_real_escape_string($conn, $data[4]);
                    $cgpa = mysqli_real_escape_string($conn, $data[5]);
                    $skills = mysqli_real_escape_string($conn, $data[6]);
                    $dob = mysqli_real_escape_string($conn, $data[7]);
                    $tenth_percentage = mysqli_real_escape_string($conn, $data[8]);
                    $twelfth_percentage = mysqli_real_escape_string($conn, $data[9]);
                    $gender = mysqli_real_escape_string($conn, $data[10]);

                    // Check if student_id is empty
                    if (empty($student_id)) {
                        
                    }

                    // Insert data into the database
                    $sql = "INSERT INTO addstudent (student_id, student_name, student_email, student_phone, student_department, student_cgpa, student_skills, dob, tenth_percentage, pluspercentage, gender)  
                            VALUES ('$student_id','$student_name', '$email', '$phone', '$department', '$cgpa', '$skills', '$dob', '$tenth_percentage', '$twelfth_percentage', '$gender')";

                    // Execute SQL query
                    if (mysqli_query($conn, $sql)) {
                        $success_message= "<div class='alert-container'><div class='alert'>New student record created successfully</div></div>";
                    } else {
                        // Check for duplicate key error
                        if (mysqli_errno($conn) == 1062) {
                            return "Duplicate entry found for student ID: $student_id";
                        } else {
                            return "Error inserting data: " . mysqli_error($conn);
                        }
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
    $student_id = isset($_POST['student_id']) ? mysqli_real_escape_string($conn, $_POST['student_id']) : '';
    $student_name = isset($_POST['student_name']) ? mysqli_real_escape_string($conn, $_POST['student_name']) : '';
    $email = isset($_POST['email']) ? mysqli_real_escape_string($conn, $_POST['email']) : '';
    $phone = isset($_POST['phone']) ? mysqli_real_escape_string($conn, $_POST['phone']) : '';
    $department = isset($_POST['student_department']) ? mysqli_real_escape_string($conn, $_POST['student_department']) : '';
    $cgpa = isset($_POST['student_cgpa']) ? mysqli_real_escape_string($conn, $_POST['student_cgpa']) : '';
    $skills = isset($_POST['student_skills']) ? mysqli_real_escape_string($conn, $_POST['student_skills']) : '';
    $dob = isset($_POST['dob']) ? mysqli_real_escape_string($conn, $_POST['dob']) : '';
    $tenth_percentage = isset($_POST['tenth_percentage']) ? mysqli_real_escape_string($conn, $_POST['tenth_percentage']) : '';
    $twelfth_percentage = isset($_POST['twelfth_percentage']) ? mysqli_real_escape_string($conn, $_POST['twelfth_percentage']) : '';
    $gender = isset($_POST['gender']) ? mysqli_real_escape_string($conn, $_POST['gender']) : '';

    // Check if student_id is empty
    if (empty($student_id)) {
        
       
    } else {
        // Check if student ID already exists
        $check_query = "SELECT * FROM addstudent WHERE student_id = '$student_id'";
        $result = $conn->query($check_query);
        if ($result->num_rows > 0) {
            $error_message = "Student ID already exists";
        } else {
            // Insert data into database
            $sql = "INSERT INTO addstudent (student_id, student_name, student_email, student_phone, student_department, student_cgpa, student_skills, dob, tenth_percentage, pluspercentage, gender) 
                    VALUES ('$student_id','$student_name', '$email', '$phone', '$department', '$cgpa', '$skills', '$dob', '$tenth_percentage', '$twelfth_percentage', '$gender')";

            if ($conn->query($sql) === TRUE) {
                $success_message = "New student record created successfully";
            } else {
                $error_message = "Error: " . $sql . '\n' . $conn->error;
            }
        }
    }

    // Check if a CSV file is uploaded
    if (isset($_FILES['excel_file']) && $_FILES['excel_file']['error'] === UPLOAD_ERR_OK) {
        $csvUploadResult = handleCsvUpload($_FILES['excel_file'], $conn);
        if ($csvUploadResult === true) {
            $success_message .= "<div class='alert-container'><div class='alert'>CSV file uploaded successfully</div></div>";
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
    <title>Add Student Details</title>
    <link rel="stylesheet" href="styl1.css">
    <style>
        /* CSS styles here */
        main {
            display: flex;
            margin-right: 14%;
            justify-content: space-between;
    margin-top: 0%;
    padding-left: 40%;
        }
        #main-form {
            width: 60%;
        }

        #upload-form {
            width: 30%;
            margin-bottom:30% ;
            margin-right: 0%;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            overflow-x: hidden; /* Added */
        }
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

        .container {
            max-width: 800px;
            margin: 15px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
            max-height: 500px;
            position: relative;
            width: 60%;
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
        input[type="tel"],
        textarea {
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
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
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
            top: 86%;
            width: 100%;
            display: flex;
            justify-content: center;
            z-index: 1;
           
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
            margin-right: 55%;
            
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
        <img src="kct1.jpeg" alt="" height="90px">
    </a>

    <header>PLACEMENT MANAGEMENT SYSTEM</header>
    <nav>
        <ul class="nav-list">
            <li>
                <a href="placementcell_view_comapany.php"><span>VIEW COMPANY</span></a>
            </li>
            <li class="active">
                <a href="addstudent.php" aria-current="page"><span>ADD STUDENT</span></a>
            </li>
            <li>
                <a href="placement_updater.php"><span>STUDENT STATUS UPDATER</span></a>
            </li>
            <li>
                <a href="Filter.php"><span>FILTER</span></a>
            </li>
        </ul>
    </nav>
    <main>
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
        
        <div class="container">
            <h2>Add Student Details</h2>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="student_id">Student ID:</label>
                    <input type="text" id="student_id" name="student_id" required>
                </div>
                <div class="form-group">
                    <label for="student_name">Student Name:</label>
                    <input type="text" id="student_name" name="student_name" required >
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone:</label>
                    <input type="tel" id="phone" name="phone" pattern="[0-9]{10}" required>
                </div>
                <div class="form-group">
                    <label for="student_department">Department:</label>
                    <input type="text" id="student_department" name="student_department" required>
                </div>
                <div class="form-group">
                    <label for="student_cgpa">CGPA:</label>
                    <input type="number" id="student_cgpa" name="student_cgpa" step="0.01" min="0" max="10" required>
                </div>
                <div class="form-group">
                    <label for="dob">Date of Birth:</label>
                    <input type="date" id="dob" name="dob" required>
                </div>
                <div class="form-group">
                    <label for="tenth_percentage">10th Percentage:</label>
                    <input type="number" id="tenth_percentage" name="tenth_percentage" step="0.01" min="0" max="100" required>
                </div>
                <div class="form-group">
                    <label for="twelfth_percentage">12th Percentage:</label>
                    <input type="number" id="twelfth_percentage" name="twelfth_percentage" step="0.01" min="0" max="100" required>
                </div>
                <div class="form-group">
                    <label for="gender">Gender:</label>
                    <select id="gender" name="gender" required>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="student_skills">Skills:</label>
                    <textarea id="student_skills" name="student_skills" rows="4"></textarea>
                </div>

                <button type="submit" name="submit">Submit</button>

                <!-- Upload CSV File Section -->
                
                <!-- End Upload CSV File Section -->
            </form>
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
