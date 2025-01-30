<?php
include_once 'connect.php'; // Ensure this file correctly includes the Database class

// Create a Database instance and get the connection
$database = new Database();
$db = $database->getConnection();

if(isset($_POST['create'])){
    $username = $_POST["username"];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = isset($_POST['role']) ? $_POST['role'] : 'user'; // Default role to 'user'

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare SQL statement
    $sql = "INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)";
    $stmtinsert = $db->prepare($sql);
    $result = $stmtinsert->execute([$username, $email, $hashed_password, $role]);

    if ($result) {
        echo "<script>alert('Successfully registered!');</script>";
    } else {
        echo "<script>alert('Error during registration.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="./css/signupStyle.css" />
  </head>

  <body>
   <a href="#s1" id="s2"></a>
    <a href="#signup1" id="signup2"></a>
    <div class="signup-container" id="signup-container">
      <form
        class="signup-form"
        action="signup.php"
        method="post"
        id="signup-form"
      >
        <h1>Join Us</h1>
        <p class="subtext">Sign up to receive the latest updates and offers</p>
        <div class="form-group">
          <label for="signup-name">Full Name</label>
          <input
            type="text"
            id="signup-name"
            name="username"
            placeholder="Full Name"
            required
          />
        </div>
        <div class="form-group">
          <label for="signup-email">Email Address</label>
          <input
            type="email"
            id="signup-email"
            name="email"
            placeholder="Email Address"
            required
          />
        </div>
        <div class="form-group">
          <label for="signup-password">Password</label>
          <input
            type="password"
            id="signup-password"
            name="password"
            placeholder="Password"
            required
          />
        </div>
        <input type="submit" class="btn" id="signup-button" name="create"/>
      </form>
    </div>

    <script src="./js/validation.js"></script>
  </body>
</html>
