<?php
include "db.php";

if (isset($_POST['submit'])) {
    $crop_id = $_POST['crop_id'];
    $crop_name = $_POST['crop_name'];
    $quantity = $_POST['quantity'];
    $unit = $_POST['unit'];
    $harvest_date = $_POST['harvest_date'];

    $sql = "INSERT INTO crops (crop_id, crop_name, quantity, unit, harvest_date) VALUES ('$crop_id', '$crop_name', '$quantity', '$unit', '$harvest_date')";

    if ($conn->query($sql) === TRUE) {
        header("Location: FARMER.php"); // Redirect back to table
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
?>