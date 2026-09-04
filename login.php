<?php
    $email = "";
    $password = "";
    $errors = [];

    // The form is processed only when the browser submits it with POST.
    // When this file is opened normally, or run outside a web server, the
    // missing or different request method leaves the form in its initial state.
    $submitted = ($_SERVER['REQUEST_METHOD'] ?? '') === 'POST';

    if ($submitted) {
        // Read the submitted fields. The null coalescing operator supplies an
        // empty string if a field is missing, avoiding undefined-index warnings.
        // Trim removes accidental spaces around an email address before it is
        // validated and displayed again in the form.
        $email = trim($_POST['email'] ?? '');

        // The password is intentionally not trimmed: spaces may be part of a
        // user's password. A real application should hash and verify it rather
        // than storing or comparing it as plain text.
        $password = $_POST['password'] ?? '';

        // Collect all validation failures before rendering the page so the user
        // can correct every missing field in one submission.
        if (empty($email)) {
            $errors[] = "Email is required.";
        }
        if (empty($password)) {
            $errors[] = "Password is required.";
        }

    }


    //validate the email and password against the database
    if(empty($errors) && $submitted){
            //neverr hard core credientials in a real application. This is just for demonstration purposes.
        if($email === "27berkoj@mydacc.org" && $password === "Joshy123") {
            header("Location: account.php"); //send the user to the account page if the credentials are correct
        }
        else{
            $errors[] = "Invalid email or password."; //add an error message if the credentials are incorrect
            $password = ""; //clear the password field so the user can try again
        }
    }
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
        <img src="img/download.png" alt="Login Image" style="display: block; margin: 0 auto; width: 100px; height: 100px;">
        <br>
        <h2 style="text-align: center;">Please Enter Your Login Information</h2>
        <?php

        // Do not show a success message before a form submission. A success
        // message is valid only after a POST request passed validation.
        if ($submitted && empty($errors)) {
            echo "<div class='login-success'>Login successful!</div>";
        } elseif ($submitted) {
            // The request was submitted but one or more fields were invalid.
            // Display every collected error so the user knows what to fix.
            echo "<div class='login-error'>";
            foreach ($errors as $error) {
                // Escape text before placing it in HTML to prevent submitted or
                // future server-generated messages from being interpreted as markup.
                echo "<p>" . htmlspecialchars($error, ENT_QUOTES, 'UTF-8') . "</p>";
            }
            echo "</div>";
        }


        ?>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" style="text-align: center;" method="post">
  
            <p class="form-text" >
            <label id = "login-label">Enter your email address 👤</label>
            <br>
            <input
            type="email"
            class="login-input"
            name="email"
            patter= "^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$"
            value="<?= htmlspecialchars($email, ENT_QUOTES, 'UTF-8') ?>"
            placeholder="Enter your email"
            required>        
            
        
        </p>
            <p class="form-text" >Enter your password 🔒</p>
            <input class="login-input" type="password" name="password" placeholder="Password" value="<?= htmlspecialchars($password, ENT_QUOTES, 'UTF-8') ?>" required>
            <br>
            <button type="submit">Login</button>
        </form>
    </div>
   
    
    <div class="back-button" style="text-align: center; margin-top: 20px;">
        <br>
        <a href="home.php">Back to Home</a>
    </div>
</body>
</html>
