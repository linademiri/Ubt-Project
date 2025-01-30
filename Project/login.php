<?php
session_start();

// Include database connection
require_once "connect.php";  // This should include your db connection file

// If the user is already logged in, redirect to the dashboard
if (isset($_SESSION['username']) != "") {
    header("Location: dashboard.php");
    exit;
}

// Initialize error variables
$email_error = $password_error = $error_message = "";

// Process the login form submission
if (isset($_POST['login'])) {
    // Sanitize and validate form inputs
    $email    = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_error = "Please Enter a Valid Email ID";
    }

    // Validate password length
    if (strlen($password) < 6) {
        $password_error = "Password must be at least 6 characters";
    }

    // If no validation errors, check the database for the user
    if (empty($email_error) && empty($password_error)) {
        // Prepare the SQL query to prevent SQL injection
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email); // Bind email parameter
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if user exists
        if ($row = $result->fetch_assoc()) {
            // Verify the password
            if (password_verify($password, $row['password'])) {
                // Set session variables on successful login
                $_SESSION['user_id']   = $row['id'];  // Assuming 'id' is your unique user identifier
                $_SESSION['username']  = $row['username'];
                $_SESSION['user_email'] = $row['email'];
                $_SESSION['role']      = $row['role']; // For role-based access control if needed

                // Redirect to dashboard or home page
                header("Location: dashboard.php");
                exit;
            } else {
                // Invalid password
                $error_message = "Incorrect Email or Password!";
            }
        } else {
            // User does not exist
            $error_message = "Incorrect Email or Password!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-10">
                <div class="page-header">
                    <h2>Login Form</h2>
                </div>
                <p>Please fill in all fields</p>
                <span class="text-danger"><?php if (isset($error_message)) echo $error_message; ?></span>

                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" value="" maxlength="30" required>
                        <span class="text-danger"><?php if (isset($email_error)) echo $email_error; ?></span>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" value="" maxlength="8" required>
                        <span class="text-danger"><?php if (isset($password_error)) echo $password_error; ?></span>
                    </div>

                    <input type="submit" class="btn btn-primary" name="login" value="Login">
                    <br>
                    You don't have an account? <a href="signup.php" class="mt-3">Click Here to Register</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
