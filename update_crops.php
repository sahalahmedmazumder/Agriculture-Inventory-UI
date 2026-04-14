<?php 
include "db.php";

// 1. Handle the Update logic
if (isset($_POST['update'])) {
    $crop_id      = $_POST['crop_id'];
    $crop         = $_POST['crop']; // Changed from crop_name to crop
    $quantity     = $_POST['quantity'];
    $unit         = $_POST['unit'];
    $harvest_date = $_POST['harvest_date'];

    // Updated SQL to use 'crop' column
    $sql = "UPDATE `crops` SET 
            `crop` = '$crop', 
            `quantity` = '$quantity', 
            `unit` = '$unit', 
            `harvest_date` = '$harvest_date' 
            WHERE `crop_id` = '$crop_id'"; 

    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Update successful! Redirecting...</div>";
        header("refresh:2; url=FARMER.php"); 
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
} 

// 2. Fetch the data
if (isset($_GET['id'])) {
    $id = $_GET['id']; 
    $sql = "SELECT * FROM `crops` WHERE `crop_id`='$id'";
    $result = $conn->query($sql); 

    if ($result->num_rows > 0) {        
        $row = $result->fetch_assoc();
        $crop_val = $row['crop']; // Changed from crop_name
        $qty      = $row['quantity'];
        $unit     = $row['unit'];
        $date     = $row['harvest_date'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Crop</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
</head>
<body style="background:#f4f7f6; padding-top: 50px;">
    <div class="container" style="background: white; padding: 30px; border-radius: 10px; shadow: 0 0 10px rgba(0,0,0,0.1);">
        <h2>Update Crop Information</h2>
        <form action="" method="post">
            <input type="hidden" name="crop_id" value="<?php echo $id; ?>">

            <div class="form-group">
                <label>Crop Type:</label>
                <input type="text" class="form-control" name="crop" value="<?php echo $crop_val; ?>">
            </div>

            <div class="form-group">
                <label>Quantity:</label>
                <input type="number" class="form-control" name="quantity" value="<?php echo $qty; ?>">
            </div>

            <div class="form-group">
                <label>Unit:</label><br>
                <input type="radio" name="unit" value="kg" <?php if($unit == 'kg') echo "checked"; ?>> kg
                <input type="radio" name="unit" value="tons" <?php if($unit == 'tons') echo "checked"; ?>> tons
            </div>

            <div class="form-group">
                <label>Harvest Date:</label>
                <input type="date" class="form-control" name="harvest_date" value="<?php echo $date; ?>">
            </div>

            <input type="submit" class="btn btn-primary" value="Update" name="update">
            <a href="FARMER.php" class="btn btn-default">Cancel</a>
        </form> 
    </div>
</body>
</html>

<?php
    } else { 
        header('Location: FARMER.php');
    } 
}
?>