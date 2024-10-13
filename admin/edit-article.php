<?php 
    include "../config/connect.php";
    include "../utils/utils.php";

    $article;
    if(isset($_GET["id"])) {
        $article_id = $_GET["id"];
        $query = "SELECT * FROM article WHERE id = $article_id";
        $result = $conn->query($query);
        if($result) {
            $article = mysqli_fetch_assoc($result);
        } 
        if($article == NULL) {
            header("Location: /justlearn/admin/articles.php");
        }
    } else {
        header("Location: /justlearn/admin/articles.php");
    }

    if(isset($_POST["submit"])) {
        $title = clean_input($_POST["title"]);
        $date = clean_input($_POST["date"]);
        $content = clean_input($_POST["content"]);

        $title_error;
        $date_error;
        $content_error;
        $photo_error;

        if(empty($title)) {
            $title_error = "Title field is required";
        } else {
            $title_error = "";
        }
        if(empty($date)) {
            $date_error = "Date field is requried";
        } else {
            $date_error = "";
        }
        if(empty($content)) {
            $content_error = "Content field is required";
        } else {
            $content_error = "";
        }

        $query;
        $article_id = $_GET["id"];
        $query = "
            UPDATE article
            set title = '$title', date = '$date', content = '$content'
            WHERE id = $article_id
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
                UPDATE article
                set title = '$title', content = '$content', date = '$date', photo = '$transform_photo_name'
                WHERE id = $article_id
            ";
        } 

        if(!$title_error && !$date_error && !$content_error && !$photo_error) {
            $conn->query($query);
            header("Location: /justlearn/admin/articles.php");
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
                    <h2 class="text-xl font-semibold text-[#181C14] mb-5">Edit Article</h2>
                    <div class="flex flex-col space-y-2 mb-4">
                        <label for="title">Article Title</label>
                        <input 
                            type="text" 
                            id="title" 
                            name="title" 
                            value="<?= $article["title"] ?>"
                            placeholder="Place the article title..." 
                            class="border border-gray-300 rounded-md py-2 px-4">
                        <?php if(isset($title_error)): ?>
                            <p class="text-red-500 text-sm font-medium"><?= $title_error ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="flex flex-col space-y- mb-4">
                            <label for="date">Article Date</label>
                            <input 
                                type="date" 
                                id="date" 
                                name="date" 
                                value="<?= $article["date"] ?>"
                                placeholder="Place the article date..." 
                                class="border border-gray-300 rounded-md py-2 px-4">
                            <?php if(isset($date_error)): ?>
                                <p class="text-red-500 text-sm font-medium"><?= $date_error ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="flex flex-col space-y-2 mb-4">
                        <label for="content">Article Content</label>
                        <textarea 
                            name="content" 
                            rows="6" 
                            id="content" 
                            placeholder="Place the article content..." 
                            class="border border-gray-300 rounded-md py-2 px-4"><?= $article["content"] ?></textarea>
                        <?php if(isset($content_error)): ?>
                            <p class="text-red-500 text-sm font-medium"><?= $content_error ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="flex flex-col space-y-2 mb-4">
                        <label for="photo">Article Image</label>
                        <input type="file" id="photo" accept="image/*" name="photo" class="border border-gray-300 rounded-md py-2 px-4">
                        <?php if(isset($photo_error)): ?>
                            <p class="text-red-500 text-sm font-medium"><?= $photo_error ?></p>
                        <?php endif; ?>
                        <img src="<?= "../images" . "/" . $article["photo"] ?>" id="image_preview" alt="image-preview" class="w-[150px] h-[150px] object-contain">
                    </div>
                    <button type="submit" name="submit" class="border-none outline-none rounded-md py-2 px-4 bg-[#181C14] text-white mt-5 w-full">
                        Submit New Article
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