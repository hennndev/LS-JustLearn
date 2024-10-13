<?php   
    session_start();

    include "config/connect.php";

    if(isset($_SESSION['user_email'])) {
        $user_email = $_SESSION['user'];
        $result = mysqli_query($conn, "SELECT * FROM user WHERE email = '$user_email'");
        $current_user = mysqli_fetch_assoc($result);
    } 

?>


<!DOCTYPE html>
<html lang="en">
    <header class="header">
        <section class="container flex-between">
            <h1>JustLearn</h1>
            <nav class="flexx nav-links">
                <a href="#home">Home</a>
                <a href="about.php">About</a>
                <a href="programs.php">Program</a>
                <a href="bootcamp.php">Bootcamp</a>
                <a href="articles.php">Articles</a>
                <a href="contacts.php">Contacts</a>
            </nav>
            <div class="btn-container flexx">
                <?php if(!isset($_SESSION["user"])): ?>
                    <a href="login.php" class="btn btn-ghost btn-navigate">Login</a>
                    <a href="register.php" class="btn btn-primary btn-navigate">Register</a>
                <?php endif; ?>
                <?php if(isset($_SESSION["user"])): ?>
                    <a href="logout.php" class="btn btn-danger btn-navigate">Logout</a>
                <?php endif; ?>
                <i class="fa-solid fa-bars icon menu-icon"></i>
            </div>
        </section>
    </header>


    <style>
        .btn-danger {
            background: #C7253E !important;
            color: white !important;
        }
    </style>
</html>