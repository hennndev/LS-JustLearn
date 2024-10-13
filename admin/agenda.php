<?php 
    include "../config/connect.php";

    $trainers = [];
    $query = "SELECT * FROM users WHERE role = '2'";
    $result = mysqli_query($conn, $query);
    while($trainer = mysqli_fetch_assoc($result)) {
        array_push($trainers, $trainer);
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
                <div class="flex items-center justify-end space-x-4">
                    <a href="add-trainer.php" class="border-none outline-none rounded-md py-2 px-4 bg-[#181C14] text-white">
                        Add Trainer
                    </a>
                </div>
                <div class="relative overflow-x-auto mt-5 rounded-md">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-500 bg-white border-b border-gray-200">
                            <tr>
                                <th scope="col" class="px-6 py-3 font-medium">
                                    No
                                </th>
                                <th scope="col" class="px-6 py-3 font-medium">
                                    Image
                                </th>
                                <th scope="col" class="px-6 py-3 font-medium">
                                    Name
                                </th>
                                <th scope="col" class="px-6 py-3 font-medium">
                                    Email
                                </th>
                                <th scope="col" class="px-6 py-3 font-medium">
                                    Phone Number
                                </th>
                                <th scope="col" class="px-6 py-3 font-medium">
                                    Address
                                </th>
                                <th scope="col" class="px-6 py-3 font-medium">
                                    Detail
                                </th>
                                <th scope="col" class="px-6 py-3 font-medium">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($trainers as $key => $trainer): ?>    
                                <tr class="bg-white border-b">
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        <?= $key + 1 ?>
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        <img 
                                            src="<?= "../images/" . $trainer["photo"] ?>" 
                                            class="w-[50px] h-[50px] object-contain"
                                            alt="<?= $trainer["name"] ?>">
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        <?= $trainer["name"] ?>
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        <?= $trainer["email"] ?>
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        Rp<?= $trainer["phone_number"] ?>
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    <?= $trainer["address"] ?>
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap space-x-3">
                                        <a href="#" class="text-blue-500 font-medium">
                                            Detail
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap space-x-3">
                                        <a href="/justlearn/admin/edit-trainer.php?id=<?= $trainer["id"] ?>" class="text-blue-500 font-medium">Edit</a>
                                        <a href="/justlearn/admin/delete-trainer.php?id=<?= $trainer["id"] ?>" class="text-red-500 font-medium" onclick="return confirmDelete()">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this participant?");
        }
    </script>
</body>
</html>