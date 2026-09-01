<?php

?>

<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="scripts/style.css">
</head>
<body>
    <div class="login-container">
        <h2 style="text-align: center;">Please Enter Your Login Information</h2>
        <br>
        <form  style="text-align: center;" method="post">
            <input type="text" name="username" placeholder="Username" required>
            <br>
            <input type="password" name="password" placeholder="Password" required>
            <br>
            <button type="submit">Login</button>
        </form>
    </div>

    <div class="back-button" style="text-align: center; margin-top: 20px;">
        <a href="home.php">Back to Home</a>
    </div>
</body>
</html>
