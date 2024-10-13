<?php 
    session_start();    

    $current_user;

    if(isset($_SESSION["user"])) {
        $user_email = $_SESSION['user'];
        $result = mysqli_query($conn, "SELECT * FROM users WHERE email = '$user_email'");
        $current_user = mysqli_fetch_assoc($result);
        if((int)$current_user["role"] !== 3) {
            header("Location: /justlearn/index.php");
            exit;    
        }
    } else {
        header("Location: /justlearn/login.php");
        exit;
    }

?>

<!DOCTYPE html>
<html lang="en">
    
    <header class="flex items-center justify-between w-full">
        <div class="flex items-center space-x-5">
            
            <h2 class="font-semibold text-xl text-[#181C14]">Products</h2>
            <div class="flex items-center w-[300px] border border-[#ccc] rounded-md px-3 bg-white">
                <i class="fa-solid fa-magnifying-glass text-[#181C14] text-md mr-3"></i>
                <input type="text" placeholder="Search products" class="flex-1 py-1.5 bg-transparent outline-none text-md">
            </div>
        </div>  
        <div class="flex items-center space-x-4">
            <div class="relative w-7 h-7 bg-gray-50 rounded-full relative flex items-center justify-center">
                <i class="fa-solid fa-ellipsis-vertical text-[#181C14] cursor-pointer absolute text-sm"></i>
            </div>
            <div class="relative w-7 h-7 bg-gray-50 rounded-full relative flex items-center justify-center">
            <i class="fa-solid fa-envelope text-[#181C14] cursor-pointer absolute text-sm"></i>
            </div>
            <div class="relative w-7 h-7 bg-gray-50 rounded-full relative flex items-center justify-center">
                <i class="fa-solid fa-bell text-[#181C14] cursor-pointer absolute text-sm"></i>
            </div>
            <div class="h-[30px] w-[30px] rounded-full cursor-pointer">
                <img src="<?= "../images/" . $current_user["photo"] ?> " class="w-full h-full rounded-full object-cover" alt="account">
            </div>
        </div>
    </header>
</html>