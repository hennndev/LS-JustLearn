<?php 
    include "../config/connect.php";
    include "../utils/utils.php";

    $program;
    if(isset($_GET["id"])) {
        $program_id = $_GET["id"];
        $query = "SELECT * FROM program WHERE id = $program_id";
        $result = $conn->query($query);
        if($result) {
            $program = mysqli_fetch_assoc($result);
        } 
        if($program == NULL) {
            header("Location: /justlearn/admin/program.php");
        }
    } else {
        header("Location: /justlearn/admin/program.php");
    }

    if(isset($_POST["submit"])) {
        $name = clean_input($_POST["name"]);
        $description = clean_input($_POST["description"]);
        $schedule = clean_input($_POST["schedule"]);
        $price = clean_input($_POST["price"]);
        $content = clean_input($_POST["content"]);

        $name_error;
        $description_error;
        $schedule_error;
        $price_error;
        $content_error;
        $photo_error;

        if(empty($name)) {
            $name_error = "Name is required";
        } else {
            $name_error = "";
        }
        if(empty($description)) {
            $description_error = "Description field is requried";
        } else {
            $description_error = "";
        }
        if(empty($schedule)) {
            $schedule_error = "Schedule field is required";
        } else {
            $schedule_error = "";
        }
        if(empty($price)) {
            $price_error = "Price field is required";
        } else {
            $price_error = "";
        }
        if(empty($content)) {
            $content_error = "Content field is required";
        } else {
            $content_error = "";
        }

        $query;
        $program_id = $_GET["id"];
        $query = "
            UPDATE program
            set name = '$name', description = '$description', schedule = '$schedule', price = '$price', content = '$content'
            WHERE id = $program_id
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
                UPDATE program
                set name = '$name', description = '$description', schedule = '$schedule', price = '$price', content = '$content', photo = '$transform_photo_name'
                WHERE id = $program_id
            ";
        }
       
        if(!$name_error && !$description_error && !$schedule_error && !$price_error && !$content_error && !$photo_error) {
            $conn->query($query);
            header("Location: /justlearn/admin/program.php");
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
                    <h2 class="text-xl font-semibold text-[#181C14] mb-5">Add Program</h2>
                    <div class="flex flex-col space-y-2 mb-4">
                        <label for="name">Program Name</label>
                        <input 
                            type="text" 
                            id="name" 
                            name="name" 
                            value="<?= $program["name"] ?>"
                            placeholder="Place your program name..." 
                            class="border border-gray-300 rounded-md py-2 px-4">
                    </div>
                    <div class="flex space-x-2 mb-4">          
                        <div class="flex flex-col flex-1 space-y-2">
                            <label for="price">Program Price</label>
                            <input 
                                type="number" 
                                id="price" 
                                name="price" 
                                value="<?= $program["price"] ?>"
                                placeholder="Place your program price..." 
                                class="border border-gray-300 rounded-md py-2 px-4">
                        </div>
                        <div class="flex-1 flex flex-col space-y-2">
                            <label for="schedule">Program Schedule</label>
                            <input 
                                type="text" 
                                id="schedule" 
                                name="schedule" 
                                value="<?= $program["schedule"] ?>"
                                placeholder="Place your program schedule..." 
                                class="border border-gray-300 rounded-md py-2 px-4">
                        </div>
                    </div>
                    <div class="flex flex-col space-y-2 mb-4">
                        <label for="description">Program Description</label>
                        <textarea name="description" rows="3" id="description" placeholder="Place your product description..." class="border border-gray-300 rounded-md py-2 px-4"><?= $program["description"] ?></textarea>
                    </div>
                    <div class="flex flex-col space-y-2 mb-4">
                        <label for="content">Program Content Course</label>
                        <textarea name="content" rows="6" id="content" placeholder="Place your product content..." class="border border-gray-300 rounded-md py-2 px-4"><?= $program["content"] ?></textarea>
                    </div>
                    <div class="flex flex-col space-y-2 mb-4">
                        <label for="photo">Program Image</label>
                        <input type="file" id="photo" accept="image/*" name="photo" class="border border-gray-300 rounded-md py-2 px-4">
                        <img src="<?= "../images" . "/" . $program["photo"] ?>" id="image_preview" alt="image-preview" class="w-[150px] h-[150px] object-contain">
                    </div>
                    <button type="submit" name="submit" class="border-none outline-none rounded-md py-2 px-4 bg-[#181C14] text-white mt-5 w-full">
                        Submit Edited Program
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