<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="view-transition" content="same-origin" />

    <meta charset="UTF-8" />
    <link rel="icon" type="image/svg+xml" href="/favicon.svg" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="/main.js" defer></script>
    <title>PLACEMENT COORDINATOR</title>
    <link href="styl1.css" rel="stylesheet" />
    <style>
      body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: white;
    }
    main{
      margin-right: 20%;
    }
  
    .login-container {
        width: 300px;
        margin: 100px auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
  
    h2 {
        text-align: center;
        margin-bottom: 20px;
    }
  
    .form-group {
        margin-bottom: 20px;
    }
  
    .form-group label {
        display: block;
        font-weight: bold;
    }
  
    .form-group input {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }
  
    .form-group input:focus {
        outline: none;
        border-color: #007bff;
    }
  
    .form-group button {
        width: 100%;
        padding: 10px;
        background-color: #234;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
  
    .form-group button:hover {
        background-color:lightblue;
    }
    .alert-container {
      position: absolute;
      top: 88%;
      width: 100%;
      display: flex;
      justify-content: center;
      z-index: 1;
      margin-left: 11%;
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
    <header>PLACEMENT MANGEMENT SYSTEM</header>
    <nav>
      <ul class="nav-list">
        <li>
          <a href="index.php"><span>ADMIN</span></a>
        </li>
        <li>
          <a href="PC.php"><span>PLACEMENT CELL</span></a>
        </li>
        <li class="active">
          <a href="PCS.php" aria-current="page"><span>PLACEMENT COORDINATOR</span></a>
        </li>
        
      </ul>
    </nav>
     
    <main><div class="login-container">
      <h2>PLACEMENT COORDINATOR</h2>
      <form  method="POST" name="myform4">
          <div class="form-group">
              <label>Username:</label>
              <input type="text" id="username" name="email" required="">
          </div>
          <div class="form-group">
              <label>Password:</label>
              <input type="password" id="password" name="pass" required="">
          </div>
          <div class="form-group">
              <button type="submit" name="submit">Login</button>
          </div>
      </form>
  </div></main>
  <?php
   // Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$database = "pms";
session_start();

// Create connection
$mysqli = new mysqli($servername, $username, $password, $database);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve username and password from form
    $username = $_POST['email'];
    $password = $_POST['pass'];
    
    // Prepare SQL statement to select user from database
    $sql = "SELECT * FROM adadduser WHERE  email='$username' AND pass='$password'";
    $result = $mysqli->query($sql);
    
    if ($result->num_rows == 1) {
        // User exists, login successful
       
        // Perform further actions like redirecting to another page
   
        header("Location: $path placementcell_view_comapany.php");
    } else {
        // Invalid username or password
        echo "<div class='alert-container'><div class='alert alert-error'>Error: Username or password is incorrect</div></div>";
    }
}

// Close connection
$mysqli->close();

?>
  </body>
</html>