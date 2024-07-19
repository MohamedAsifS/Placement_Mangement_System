<?php
// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection parameters
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "pms";

    // Retrieve the studentId from the request body
    $data = json_decode(file_get_contents('php://input'), true);
    $studentId = $data['studentId'];

    // Initialize variables to store the message and status
    $message = "";
    $status = "";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        $status = "Failed to connect to the database: " . $conn->connect_error;
    } else {
        // Retrieve student's email from the database
        $sql = "SELECT student_name, student_email FROM addstudent WHERE student_id = '$studentId'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $recipientEmail = $row['student_email'];
            $studentName = $row['student_name'];

            // Compose your message
            $subject = "Placement Notification";
            $message = "Dear $studentName,\r\n\r\nYour message goes here.";

            // Additional headers
            $headers = "From: maasifar@google.com\r\n";
            $headers .= "Reply-To: your_email@example.com\r\n";
            $headers .= "Content-type: text/plain\r\n";

            // Send email
            $mailSent = mail($recipientEmail, $subject, $message, $headers);

            if ($mailSent) {
                $status = "Email sent successfully to $recipientEmail";
            } else {
                $status = "Failed to send email";
            }
        } else {
            $status = "Student with ID $studentId not found in the database";
        }

        // Close the database connection
        $conn->close();
    }

    // Send a response indicating success or failure
    header('Content-Type: application/json');
    echo json_encode(['status' => $status]);
} else {
    // If the request method is not POST, return an error message
    echo "Error: Only POST requests are allowed";
}
?>
