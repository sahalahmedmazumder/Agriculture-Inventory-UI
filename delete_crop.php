<?php
include "db.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM `crops` WHERE `Crop_id` = '$id'";

    if ($conn->query($sql) === TRUE) {
        header("Location: FARMER.php");
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
?>