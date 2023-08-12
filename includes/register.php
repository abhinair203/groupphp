<?php
include 'db.php';
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['user_password'];
    $confirm_password = $_POST['confirm_password'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];


    // Validate inputs
    if (empty($username)) {
        $errors[] = "Username is required.";
    }

    if (empty($password)) {
        $errors[] = "Password is required.";
    }

    if (empty($confirm_password)) {
        $errors[] = "Confirm Password is required.";
    }

    if ($password !== $confirm_password) {
        echo "Passwords do not match.";
    } else {

        if(count($errors) === 0){
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO users (username, user_password, user_firstname, user_lastname, user_email, user_image, user_role, randsalt) VALUES ( '$username',  '$hashed_password', '$user_firstname', '$user_lastname', '$username' ,'', 'admin', '')";
    
            if ($connection->query($sql) === TRUE) {
                echo "Account created successfully.";

                header('location: ../index.php');
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    
    }

    $conn->close();
}
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">

    <style>

* {box-sizing: border-box}

/* Add padding to containers */
.container {
  padding: 16px;
}

/* Full-width input fields */
input[type=text], input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background: #f1f1f1;
}

input[type=text]:focus, input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Overwrite default styles of hr */
hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}

/* Set a style for the submit/register button */
.registerbtn {
  background-color: #04AA6D;
  color: white;
  padding: 16px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

.registerbtn:hover {
  opacity:1;
}

/* Add a blue text color to links */
a {
  color: dodgerblue;
}

/* Set a grey background color and center the text of the "sign in" section */
.signin {
  background-color: #f1f1f1;
  text-align: center;
}
        </style>
</head>
<body>
<form action="register.php" method="post">
  <div class="container">
    <h1>Register</h1>
    <p>Please fill in this form to create an account.</p>
    <hr>

    <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="username" id="username" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="user_password" id="psw" required>

    <label for="psw-repeat"><b>Repeat Password</b></label>
    <input type="password" placeholder="Repeat Password" name="confirm_password" id="psw-repeat" required>
    <label for="psw-repeat"><b>First Name</b></label>
    <input type="text" placeholder="First Name" name="user_firstname" id="psw-repeat" required>
    <label for="psw-repeat"><b>Last Name</b></label>
    <input type="text" placeholder="Last Name" name="user_lastname" id="psw-repeat" required>
    <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>
    <button type="submit" class="registerbtn">Register</button>
  </div>

  <div class="container signin">
    <p>Already have an account? <a href="../index.php">Sign in</a>.</p>
  </div>
</form>
</body>
</html>
