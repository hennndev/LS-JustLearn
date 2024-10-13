<!DOCTYPE html>
<html lang="en"> 
    <aside class="flex flex-col justify-between sticky top-0 h-screen w-[250px] bg-[#181C14]">
       <div class="flex flex-col">
            <div class="p-5">
                <h2 class="font-bold text-white text-3xl text-center">JustLearn</h2>
            </div>

            <div class="flex flex-col space-y-2 mt-5">
                <a href="#" class="flex items-center space-x-3 cursor-pointer pr-5 py-2 pl-10 group hover:bg-[#4379F2]">
                    <i class="fa-solid fa-house text-white"></i>
                    <p class="text-white ml-2">Dashboard</p>
                </a>
                <a href="/justlearn/admin/participants.php" class="flex items-center space-x-3 cursor-pointer pr-5 py-2 pl-10 group hover:bg-[#4379F2]">
                    <i class="fa-solid fa-users text-white"></i>
                    <p class="text-white ml-2">Participants</p>
                </a>
                <a href="/justlearn/admin/trainers.php" class="flex items-center space-x-3 cursor-pointer pr-5 py-2 pl-10 group hover:bg-[#4379F2]">
                    <i class="fa-solid fa-users text-white"></i>
                    <p class="text-white ml-2">Trainers</p>
                </a>
                <a href="/justlearn/admin/program.php" class="flex items-center space-x-3 cursor-pointer pr-5 py-2 pl-10 group hover:bg-[#4379F2]">
                    <i class="fa-solid fa-rectangle-list text-white"></i>
                    <p class="text-white ml-2">Program</p>
                </a>
                <a href="/justlearn/admin/articles.php" class="flex items-center space-x-3 cursor-pointer pr-5 py-2 pl-10 group hover:bg-[#4379F2]">
                    <i class="fa-solid fa-newspaper text-white"></i>
                    <p class="text-white ml-2">Articles</p>
                </a>
                <a href="#" class="flex items-center space-x-3 cursor-pointer pr-5 py-2 pl-10 group hover:bg-[#4379F2]">
                    <i class="fa-solid fa-bag-shopping text-white"></i>
                    <p class="text-white ml-2">Agenda</p>
                </a>
                <div class="flex items-center space-x-3 cursor-pointer pr-5 py-2 pl-10 group hover:bg-[#4379F2]">
                    <i class="fa-solid fa-gear text-white"></i>
                    <p class="text-white ml-2">Setting</p>
                </div>
                <div class="flex items-center space-x-3 cursor-pointer pr-5 py-2 pl-10 group hover:bg-[#4379F2]">
                    <i class="fa-solid fa-right-from-bracket text-white"></i>
                    <a href="/justlearn/index.php" class="text-white ml-2">Exit</a>
                </div>
            </div>
       </div>
        <div class="flex items-center space-x-3 cursor-pointer pr-5 py-2 pl-10 group hover:bg-[#D91656]">
            <i class="fa-solid fa-right-from-bracket text-white"></i>
            <a href="/justlearn/logout.php" class="text-white ml-2">Logout</a>
        </div>
    </aside>
</html>