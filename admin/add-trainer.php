<?php 
    include "../config/connect.php";
    include "../utils/utils.php";

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
                $uploadDir = '../images/'; 
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true); 
                }
                $explode_photo_name = reset(explode('.', $photo_name));
                $transform_photo_name = uniqid($explode_photo_name) . "." . $extension;   
                $uploadFile = $uploadDir . basename($transform_photo_name);
                move_uploaded_file($photo_tmp, $uploadFile);
    
                $query = "INSERT INTO users VALUES (0, '$name', '$email', '$phone_number', '$address', '$transform_photo_name', '$hash_password', '2')";
                
                mysqli_query($conn, $query);
                header("Location: /justlearn/admin/trainers.php");
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
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>
<body>
    <main class="flex bg-[#f4f4f4]">
        <?php include "../components/admin-sidebar.php" ?>

        <div class="flex flex-col flex-1 py-5 px-7">
            <?php include "../components/admin-header.php" ?>

            <div class="mt-10">
                <form id="form" action="" method="POST" enctype="multipart/form-data" class="bg-white rounded-md p-7">
                    <h2 class="text-xl font-semibold text-[#181C14] mb-5">Add Trainer</h2>
                    <div class="flex flex-col space-y-2 mb-4">
                        <label for="name">Trainer Name</label>
                        <input 
                            type="text" 
                            id="name" 
                            name="name" 
                            placeholder="Place the trainer name..." 
                            class="border border-gray-300 rounded-md py-2 px-4">
                        <?php if(isset($name_error)): ?>
                            <p class="text-red-500 text-sm font-medium"><?= $name_error ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="flex space-x-2 mb-4">          
                        <div class="flex flex-col flex-1 space-y-2">
                            <label for="email">Trainer Email</label>
                            <input 
                                type="email" 
                                id="email" 
                                name="email" 
                                placeholder="Place the trainer email..." 
                                class="border border-gray-300 rounded-md py-2 px-4">
                            <?php if(isset($email_error)): ?>
                                <p class="text-red-500 text-sm font-medium"><?= $email_error ?></p>
                        <?php endif; ?>
                        </div>
                        <div class="flex-1 flex flex-col space-y-2">
                            <label for="phone_number">Trainer Phone Number</label>
                            <input 
                                type="number" 
                                id="phone_number" 
                                name="phone_number" 
                                placeholder="Place your program phone number..." 
                                class="border border-gray-300 rounded-md py-2 px-4">
                            <?php if(isset($phone_number_error)): ?>
                                <p class="text-red-500 text-sm font-medium"><?= $phone_number_error ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="flex flex-col space-y-2 mb-4">
                        <label for="address">Trainer Address</label>
                        <textarea name="address" rows="3" id="address" placeholder="Place the trainer address..." class="border border-gray-300 rounded-md py-2 px-4"></textarea>
                        <?php if(isset($address_error)): ?>
                            <p class="text-red-500 text-sm font-medium"><?= $address_error ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="flex flex-col space-y-2 mb-4">
                        <label for="photo">Trainer Photo</label>
                        <input 
                            type="file" 
                            id="photo" 
                            accept="image/*" 
                            name="photo" 
                            class="border border-gray-300 rounded-md py-2 px-4">
                        <?php if(isset($photo_error)): ?>
                            <p class="text-red-500 text-sm font-medium"><?= $photo_error ?></p>
                        <?php endif; ?>
                        <img src="" id="image_preview" alt="image-preview" class="w-[150px] h-[150px] object-contain hidden">
                    </div>
                    <div class="flex space-x-2 mb-4">
                        <div class="flex flex-1 flex-col space-y-2 mb-4">
                            <label for="password">Password</label>
                            <input 
                                type="password" 
                                id="password" 
                                name="password" 
                                placeholder="Place your password"
                                class="border border-gray-300 rounded-md py-2 px-4">
                            <?php if(isset($password_error)): ?>
                                <p class="text-red-500 text-sm font-medium"><?= $password_error ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="flex flex-1 flex-col space-y-2 mb-4">
                            <label for="confirm_password">Confirm Password</label>
                            <input 
                                type="password" 
                                id="confirm_password" 
                                name="confirm_password" 
                                placeholder="Place the confirm password"
                                class="border border-gray-300 rounded-md py-2 px-4">
                            <?php if(isset($password_error)): ?>
                                <p class="text-red-500 text-sm font-medium"><?= $password_error ?></p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <button type="submit" name="submit" class="border-none outline-none rounded-md py-2 px-4 bg-[#181C14] text-white mt-5 w-full">
                        Submit New Trainer
                    </button>
                </form>
            </div>
        </div>
    </main>
</body>

<script>
    const programImage = document.getElementById('photo')
    
    programImage.addEventListener('change', (e) => {
        const imagePreview = document.getElementById('image_preview')
        
        const readerImg = new FileReader()
        readerImg.readAsDataURL(programImage.files[0])
        readerImg.onloadend = () => {
          const result = readerImg.result
          imagePreview.src = result
          imagePreview.classList.remove('hidden')
        }
    })                        
</script>

</html>