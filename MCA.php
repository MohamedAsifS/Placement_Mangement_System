
<html>
    <head>
<meta charset="UTF-8" />
<link rel="icon" type="image/svg+xml" href="/favicon.svg" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<script src="/main.js" defer></script>
<title>MCA</title>
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
        <li class="active">
          <a href="MCA.php" aria-current="page"><span>ADD PLACEMENT COORDINATOR</span></a>
        </li>
        <li>
          <a href="addcompany.php"><span>ADD COMPANY</span></a>
        </li>
        <li>
          <a href="PLACEMENTSEL.php"><span>STUDENTS STATUS</span></a>
        </li>
        <li>
        <a href="arrivedcompany.php"><span>COMPANY LIST</span></a>
    </li>
        
      </ul>
    </nav>
    <main><div class="login-container">
      <h2>ADD USER</h2>
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
              <button type="submit" name="submit">Add User</button>
          </div>
      </form>
  </div></main>
  <?php
  $email = $_POST['email'] ?? '';
  $upswd1 = $_POST['pass'] ?? '';
  if ( !empty($email) || !empty($upswd1)  )
{
// Database connection parameters
$servername = "localhost"; // Change this to your database server name
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password
$dbname = "pms"; // Change this to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if (mysqli_connect_error()){
    die('Connect Error ('. mysqli_connect_errno() .') '
      . mysqli_connect_error());
  }

  else{
    $SELECT = "SELECT studentid From pcadduser Where studentid = ? Limit 1";
    $INSERT = "INSERT Into pcadduser (studentid,studentpass )values(?,?)";
  
  //Prepare statement
       $stmt = $conn->prepare($SELECT);
       $stmt->bind_param("s", $email);
       $stmt->execute();
       $stmt->bind_result($email);
       $stmt->store_result();
       $rnum = $stmt->num_rows;
  
       //checking username
        if ($rnum==0) {
        $stmt->close();
        $stmt = $conn->prepare($INSERT);
        $stmt->bind_param("ss",$email,$upswd1);
        $stmt->execute();
        echo "<div class='alert-container'><div class='alert'>New record created successfully</div></div>";
       } else {
        echo "<div class='alert-container'><div class='alert alert-error'>Error: Username already submited</div></div>";
       }
       $stmt->close();
       $conn->close();
      }
  }
  

    

// Close the database connection

?>


    
  </body>
  </html>