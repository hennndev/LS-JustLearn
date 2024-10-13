<?php 
    session_start();
    include "config/connect.php";
    include "utils/utils.php";

    $error_message;

    if(isset($_POST["submit"])) {  
        $email = clean_input($_POST["email"]);
        $password = clean_input($_POST["password"]);

        $email_error;
        $password_error;

        if(empty($email)) {
            $email_error = "Email field is required";
        } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email_error = "Email not valid";
        } else {
            $email_error = "";
        }

        if(empty($password)) {
            $password_error = "Password field is required";
        } else if(strlen($password) < 7) {
            $password_error = "Minimum password length is 7 characters";
        } else {
            $password_error = "";
        }

        if(!$email_error && !$password_error) {
            $check_email_exist = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");

            if(!mysqli_num_rows($check_email_exist)) {
                $error_message = "Email not registered";
            } else {
                $result = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
                $user = mysqli_fetch_assoc($result);
                $check_password = password_verify($password, $user["password"]);
                if($check_password) {
                    $_SESSION["user"] = $user["email"]; 

                    if($user["role"] == 3) {
                        header("Location: /justlearn/admin/participants.php");
                    } else {
                        header("Location: index.php");
                    }
                } else {
                    $error_message = "Password incorrect";
                }
            }
        } 
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JustLearn | Login</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <main class="container flex-center" style="min-height: 100vh; flex-direction: column;">
        <section class="container flex-center">
            <section style="width: 450px; margin-bottom: 30px;">
                <a class="text-back" href="index.php">Back to home</a>
            </section>
        </section>
        <section class="container flex-center">
            <form action="" method="POST" class="form">
                <h2>Login</h2>
                <p class="form-text-info">We're happy you excited to come back</p>
                <?php if(isset($success_message)): ?>
                    <p class="text-[var(--primary)]">
                        <?= $success_message; ?>
                    </p>
                <?php endif; ?>
                <?php if(isset($error_message)): ?>
                    <p class="text-[#C7253E]">
                        <?= $error_message; ?>
                    </p>
                <?php endif; ?>
                <section class="input-control email-control">
                    <label for="email">Email</label>
                    <input 
                        type="email" 
                        name="email" 
                        id="email" 
                        value="<?= isset($email) ? $email : "" ?>"
                        placeholder="Place your email">
                    <?php if(isset($email_error)): ?>
                        <p class="text-red-500 text-sm font-medium"><?= $email_error ?></p>
                    <?php endif; ?>
                </section>
                <section class="input-control password-control">
                    <label for="password">Password</label>
                    <input 
                        type="password" 
                        name="password" 
                        id="password" 
                        value="<?= isset($password) ? $password : "" ?>"
                        placeholder="Place your password">
                    <?php if(isset($password_error)): ?>
                        <p class="text-red-500 text-sm font-medium"><?= $password_error ?></p>
                    <?php endif; ?>
                </section>
                <a href="lupapassword.php" class="text-lupapassword">Lupa Password?</a>
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                <p class="form-text-info">Don't have an account? <a href="register.php" class="text-register">Register</a></p>
            </form>
        </section>
    </main>


    <style>
        .text-back {
            color: var(--primary);
            text-decoration: none;
        }
        .text-lupapassword {
            font-size: 16px;
            color: var(--secondary);
            margin-bottom: 10px;
        }
        .text-register {
            font-size: 16px;
            color: var(--secondary);
        }

        .form .success-message {
            color: var(--primary) !important;
        } 
        .form .error-message {
            color: #C7253E !important;
        }
    </style>

    <!-- <script src="scripts/script-login.js"></script> -->
</body>
</html>