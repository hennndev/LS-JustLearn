<?php 
    session_start();
    if(!isset($_SESSION["success_create_user"])) {
        header("Location: register.php");
    } 
    session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JustLearn | Success Create User</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <main class="container flex-center flex-col min-h-screen"> 
        <section class="w-[350px] bg-[var(--primary)] rounded-md text-center p-5">
            <p class="text-white">User registered successfully. You can go to login now.</p>
            <section class="flex-center space-x-4 mt-3">
                <a href="login.php" class="hover:underline text-white">Login</a>
                <a href="register.php" class="hover:underline text-white">Register</a>
            </section>
        </section>   
    </main>
</body>
</html>