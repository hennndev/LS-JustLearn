<?php 
    include "../config/connect.php";
    include "../utils/utils.php";

    $participant;
    if(isset($_GET["id"])) {
        $participant_id = $_GET["id"];
        $query = "SELECT * FROM users WHERE id = $participant_id";
        $result = $conn->query($query);
        if($result) {
            $participant = mysqli_fetch_assoc($result);
        } 
        if($participant == NULL) {
            header("Location: /justlearn/admin/trainers.php");
        }
    } else {
        header("Location: /justlearn/admin/trainers.php");
    }

    if(isset($_POST["submit"])) {
        $name = clean_input($_POST["name"]);
        $email = clean_input($_POST["email"]);
        $phone_number = clean_input($_POST["phone_number"]);
        $address = clean_input($_POST["address"]);

        $name_error;
        $email_error;
        $phone_number_error;
        $address_error;
        $photo_error;

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


        $query;
        $participant_id = $_GET["id"];
        $query = "
            UPDATE users
            set name = '$name', email = '$email', phone_number = '$phone_number', address = '$address'
            WHERE id = $participant_id
        ";

        if($_FILES["photo"]["name"]) {
            $photo_name = $_FILES["photo"]["name"];
            $photo_tmp = $_FILES["photo"]["tmp_name"];
            $photo_size = $_FILES["photo"]["size"];

            $images_extension = ["jpeg", "jpg", "png"];
            $image_extension = explode('.', strtolower($photo_name));
            $extension = end($image_extension);

            $uploadDir = '../images/';     
            $photo_name = reset(explode('.', $photo_name));
            $transform_photo_name = uniqid($photo_name) . "." . $extension;

            $uploadFile = $uploadDir . basename($transform_photo_name);
            
            if(!$photo_name) {
                $photo_error = "Photo field is required";
            } else if($photo_name && !in_array($extension, $images_extension)) {
                $photo_error = "Image not valid";   
            } else if($photo_size > 1000000) {
                $photo_error = "Image size is too much";
            } else {
                $photo_error = "";
            }

            if(!$photo_error) {
                move_uploaded_file($photo_tmp, $uploadFile);
                unlink($uploadDir . $participant["photo"]);
            }
            
            $query = "
                UPDATE users
                set name = '$name', email = '$email', phone_number = '$phone_number', address = '$address',
                photo = '$transform_photo_name'
                WHERE id = $participant_id
            ";
        } 

        if(!$name_error && !$email_error && !$phone_number_error && !$address_error && !$password_error && !$photo_error) {
            $conn->query($query);
            header("Location: /justlearn/admin/trainers.php");
            exit;
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
                    <h2 class="text-xl font-semibold text-[#181C14] mb-5">Edit Participant</h2>
                    <div class="flex flex-col space-y-2 mb-4">
                        <label for="name">Participant Name</label>
                        <input 
                            type="text" 
                            id="name" 
                            name="name" 
                            value="<?= $participant["name"] ?>"
                            placeholder="Place the participant name..." 
                            class="border border-gray-300 rounded-md py-2 px-4">
                    </div>
                    <div class="flex space-x-2 mb-4">          
                        <div class="flex flex-col flex-1 space-y-2">
                            <label for="email">Participant Email</label>
                            <input 
                                type="email" 
                                id="email" 
                                name="email" 
                                value="<?= $participant["email"] ?>"
                                placeholder="Place the participant email..." 
                                class="border border-gray-300 rounded-md py-2 px-4">
                        </div>
                        <div class="flex-1 flex flex-col space-y-2">
                            <label for="phone_number">Participant Phone Number</label>
                            <input 
                                type="number" 
                                id="phone_number" 
                                name="phone_number" 
                                value="<?= $participant["phone_number"] ?>"
                                placeholder="Place the participant phone number..." 
                                class="border border-gray-300 rounded-md py-2 px-4">
                        </div>
                    </div>
                    <div class="flex flex-col space-y-2 mb-4">
                        <label for="address">Program Address</label>
                        <textarea 
                            name="address" 
                            rows="6" 
                            id="address" 
                            placeholder="Place the participant address..." 
                            class="border border-gray-300 rounded-md py-2 px-4"><?= $participant["address"] ?></textarea>
                    </div>
                    <div class="flex flex-col space-y-2 mb-4">
                        <label for="photo">Participant Image</label>
                        <input type="file" id="photo" accept="image/*" name="photo" class="border border-gray-300 rounded-md py-2 px-4">
                        <img src="<?= "../images" . "/" . $participant["photo"] ?>" id="image_preview" alt="image-preview" class="w-[150px] h-[150px] object-contain">
                    </div>
                    <button type="submit" name="submit" class="border-none outline-none rounded-md py-2 px-4 bg-[#181C14] text-white mt-5 w-full">
                        Submit Edited Participant
                    </button>
                </form>
            </div>
        </div>
    </main>
</body>

<script>
    const participantImage = document.getElementById('photo')
    
    participantImage.addEventListener('change', (e) => {
        const imagePreview = document.getElementById('image_preview')
        
        const readerImg = new FileReader()
        readerImg.readAsDataURL(participantImage.files[0])
        readerImg.onloadend = () => {
          const result = readerImg.result
          imagePreview.src = result
          imagePreview.classList.remove('hidden')
        }
    })                        
</script>

</html>