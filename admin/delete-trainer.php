<?php 
    include "../config/connect.php";
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

        $query = "DELETE FROM users WHERE id = $participant_id";
        $result_delete = $conn->query($query);
        unlink("../images/" . $participant["photo"]);
        header("Location: /justlearn/admin/trainers.php");
        exit;
    } else {
        header("Location: /justlearn/admin/trainers.php");
        exit;
    }
?>