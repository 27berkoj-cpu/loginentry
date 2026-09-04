<?php
$username = "";
$email = "";    
$password = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate the form data and sanitize the data to prevent from cyber attacks.
    $username = trim($_POST['username']);
    $username = htmlspecialchars($username, ENT_QUOTES, 'UTF-8');
    $email = trim($_POST['email']);
    $email = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
    $password = trim($_POST['password']);
    $password = htmlspecialchars($password, ENT_QUOTES, 'UTF-8');

    $usernamelength = strlen($username);
    $passwordlength = strlen($password);
    $containEmailSign = strpos($email, '@');

    $errors = [];

    if (empty($username) || $usernamelength < 1 || $usernamelength > 12) { //check to see the username is not empty and is between 1 and 12 characters
        $errors[] = "Username is required and must be between 1 and 12 characters.";
    }

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL) || $containEmailSign === false) { //check to see if the email is empty, is a valid email format, and contains an '@' symbol
        $errors[] = "A valid email address is required.";
    }

    if (empty($password) || $passwordlength < 7 || $passwordlength > 15) { //check to see the password is not empty and is between 7 and 15 characters
        $errors[] = "Password is required and must be between 7 and 15 characters.";
    }

    if (empty($errors)) {
       
        echo "<p>Registration successful!</p>";
    } else {
        // Display errors
        foreach ($errors as $error) {
            echo "<p style='color: red;'>" . htmlspecialchars($error, ENT_QUOTES, 'UTF-8') . "</p>";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="form-container">
    <form action="#" method="post">
        <h2>Register</h2>
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit">Submit</button>
    </form>
</div>

</body>
</html>