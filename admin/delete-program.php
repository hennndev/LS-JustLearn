<?php 
    include "../config/connect.php";

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

        $query = "DELETE FROM program WHERE id = $program_id";
        $result_delete = $conn->query($query);
        unlink("../images/" . $program["photo"]);
        header("Location: /justlearn/admin/program.php");
        exit;
    } else {
        header("Location: /justlearn/admin/program.php");
        exit;
    }
?>