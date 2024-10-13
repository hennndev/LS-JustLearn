<?php 
    session_start();

    include "config/connect.php";
    include "utils/utils.php";

    $success_message;
    $error_message;

    if(isset($_POST["submit"])) {  
        $name = clean_input($_POST["name"]);
        $email = clean_input($_POST["email"]);
        $phone_number = clean_input($_POST["phone_number"]);
        $address = clean_input($_POST["address"]);
        $password = clean_input($_POST["password"]);
        $confirm_password = clean_input($_POST["confirm_password"]);
        $hash_password = password_hash($_POST["password"], PASSWORD_DEFAULT);
        
        $photo_name = $_FILES["photo"]["name"];
        $photo_tmp = $_FILES["photo"]["tmp_name"];
        $photo_size = $_FILES["photo"]["size"];

        $name_error;
        $email_error;
        $phone_number_error;
        $address_error;
        $photo_error;
        $password_error;
        $confirm_password_error;

        if(empty($name)) {
            $name_error = "Name field is required";
        } else {
            $name_error = "";
        }

        if(empty($email)) {
            $email_error = "Email field is required";
        } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email_error = "Email not valid";
        } else {
            $email_error = "";
        }

        if(empty($phone_number)) {
            $phone_number_error = "Phone number field is required";
        } else if(strlen((string)$phone_number) < 7) {
            $phone_number_error = "Minimum phone number length is 7 number";
        } else {
            $phone_number_error = "";
        }

        if(empty($address)) {
            $address_error = "Address field is required";
        } else {
            $address_error = "";
        }

        if(empty($password)) {
            $password_error = "Password field is required";
        } else if(strlen($password) < 7) {
            $password_error = "Minimum password length is 7 characters";
        } else {
            $password_error = "";
        }

        if(empty($confirm_password)) {
            $confirm_password_error = "Confirm password field is required";
        } else if(strlen($confirm_password) < 7) {
            $confirm_password_error = "Minimum confirm password length 7 is characters";
        } else if($confirm_password !== $password) {
            $confirm_password_error = "Confirm password not match with password";
        } else {
            $confirm_password_error = "";
        }

        $images_extension = ["jpeg", "jpg", "png"];
        $image_extension = explode('.', strtolower($photo_name));
        $extension = end($image_extension);

        if(!$photo_name) {
            $photo_error = "Photo field is required";
        } else if($photo_name && !in_array($extension, $images_extension)) {
            echo count($_FILES["photo"]);
            $photo_error = "Image not valid";   
        } else if($photo_size > 1000000) {
            $photo_error = "Image size is too much";
        } else {
            $photo_error = "";
        }
        
        if(!$name_error && !$email_error && !$phone_number_error && !$address_error && !$password_error && !$photo_error) {
            $check_email_exist = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");

            if(mysqli_num_rows($check_email_exist)) {
                $error_message = "Email already used";
            } else {
                $success_message = "Success create new account. You can login now.";
                $uploadDir = 'images/'; 
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true); 
                }
                $explode_photo_name = reset(explode('.', $photo_name));
                $transform_photo_name = uniqid($explode_photo_name) . "." . $extension;   
                $uploadFile = $uploadDir . basename($transform_photo_name);
                move_uploaded_file($photo_tmp, $uploadFile);
    
                $query = "INSERT INTO users VALUES (0, '$name', '$email', '$phone_number', '$address', '$transform_photo_name', '$hash_password', '1')";
                
                mysqli_query($conn, $query);
                $_SESSION["success_create_user"] = "Success create new user";

                header("Location: success-create-user.php");
                exit;
            }
        } 
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JustLearn | Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <main class="container flex-center flex-col min-h-screen"> 
        <section class="container flex-center">
            <section class="w-[750px] mt-[50px] mb-[30px]">
                <a class="text-back" href="index.php">Back to home</a>
            </section>
        </section>
        <section class="container flex-center">
            <form id="form" action="" class="form mb-[50px] w-[750px] rounded-md" method="POST" enctype="multipart/form-data">
                <h2>Register</h2>
                <p class="form-text-info">Welcome to <span class="text-[var(--primary)] font-bold">JustLearn</span>. Create your account then you can explore it.</p>
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
                <section class="input-control">
                    <label for="name">Name</label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        value="<?= isset($name) ? $name : "" ?>"
                        placeholder="Place your name">
                    <?php if(isset($name_error)): ?>
                        <p class="text-red-500 text-sm font-medium"><?= $name_error ?></p>
                    <?php endif; ?>
                </section>
                <section class="flexx space-x-3">
                    <section class="input-control flex-1">
                        <label for="email">Email</label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            value="<?= isset($email) ? $email : "" ?>"
                            placeholder="Place your email">
                        <?php if(isset($email_error)): ?>
                            <p class="text-red-500 text-sm font-medium"><?= $email_error ?></p>
                        <?php endif; ?>
                    </section>
                    <section class="input-control flex-1">
                        <label for="phone_number">Phone Number</label>
                        <input 
                            type="number" 
                            id="phone_number" 
                            name="phone_number" 
                            value="<?= isset($phone_number) ? $phone_number : "" ?>"
                            placeholder="Place your phone number">
                        <?php if(isset($phone_number_error)): ?>
                            <p class="text-red-500 text-sm font-medium"><?= $phone_number_error ?></p>
                        <?php endif; ?>
                    </section>
                </section>
                <section class="input-control">
                    <label for="address">Full Address</label>
                    <textarea 
                        rows="6" 
                        id="address" 
                        name="address" 
                        class="p-3" 
                        placeholder="Place your full address"><?= isset($address) ? $address : "" ?></textarea>
                    <?php if(isset($address_error)): ?>
                        <p class="text-red-500 text-sm font-medium"><?= $address_error ?></p>
                    <?php endif; ?>
                </section>
                <section class="input-control">
                    <label for="photo">Photo Profile</label>
                    <input 
                        type="file" 
                        id="photo" 
                        name="photo"
                        accept="image/*">
                    <img src="" id="image_preview" alt="image-preview" class="w-[150px] h-[150px] object-contain hidden mt-2">
                    <?php if(isset($photo_error)): ?>
                        <p class="text-red-500 text-sm font-medium"><?= $photo_error ?></p>
                    <?php endif; ?>
                </section>
                <section class="input-control">
                    <label for="password">Password</label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        value="<?= isset($password) ? $password : "" ?>"
                        placeholder="Place your password">
                    <?php if(isset($password_error)): ?>
                        <p class="text-red-500 text-sm font-medium"><?= $password_error ?></p>
                    <?php endif; ?>
                </section>
                <section class="input-control">
                    <label for="confirm_password">Confirm Password</label>
                    <input 
                        type="password" 
                        id="confirm_password" 
                        name="confirm_password" 
                        value="<?= isset($confirm_password) ? $confirm_password : "" ?>"
                        placeholder="Place your confirm password">
                    <?php if(isset($confirm_password_error)): ?>
                        <p class="text-red-500 text-sm font-medium"><?= $confirm_password_error ?></p>
                    <?php endif; ?>
                </section>
                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                <p class="form-text-info">Already have an account? <a href="login.php" class="text-login">Login</a></p>
            </form>
        </section>
    </main>


    <style>
         .text-back {
            color: var(--primary);
            text-decoration: none;
        }
        .logo-title {
            color: var(--primary);
            font-weight: bold;
        }
        .text-lupapassword {
            font-size: 16px;
            color: var(--secondary);
            margin-bottom: 10px;
        }
        .text-login {
            font-size: 16px;
            color: var(--secondary);
        }
        .password-rule {
            background: #F5F5F5;
            border-radius: 6px;
            font-size: 13px;
            padding: 10px 15px;
        }
        .password-rule-text {
            text-align: left !important;
            margin-bottom: 0;
            color: gray;
        }
        .password-rule-eligible {
            color: #379777;
            font-weight: 500;
        }
    </style>

    <script>
        const photo = document.getElementById('photo')
    
        photo.addEventListener('change', (e) => {
            const imagePreview = document.getElementById('image_preview')
            
            const readerImg = new FileReader()
            readerImg.readAsDataURL(photo.files[0])
            readerImg.onloadend = () => {
                const result = readerImg.result
                imagePreview.src = result
                imagePreview.classList.remove('hidden')
            }
        })   
    </script>
    
</body>
</html>
