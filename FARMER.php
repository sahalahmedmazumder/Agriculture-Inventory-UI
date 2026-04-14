<?php 
include "./db.php"; 

// 1. We use 'crop_name' because that matches your phpMyAdmin Structure
$sql = "SELECT crop_id, crop_name, quantity, unit, harvest_date FROM crops";
$result = $conn->query($sql);

if (!$result) {
    die("SQL Error: " . $conn->error);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Farmer Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="navbar">Farmer Dashboard</div>

<div class="main">
    <div class="cards">
        <div class="card">
            <h3>Submit Crop Information</h3>
            <p>Enter crop type, quantity and harvest date.</p>
            <a href="SubmitFarmer.html">
                <button>Add New Crop</button>
            </a>
        </div>
    </div>

    <br>
    <h2>Submitted Crop Data</h2>

    <table border="1" cellpadding="10" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Crop ID</th>
                <th>Crop Type</th>
                <th>Quantity</th>
                <th>Unit</th>
                <th>Harvest Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody> 
            <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
            ?>
                <tr>
                    <td><b><?php echo $row['crop_id']; ?></b></td>
                    <td><?php echo $row['crop_name']; ?></td>
                    <td><?php echo $row['quantity']; ?></td>
                    <td><?php echo $row['unit']; ?></td>
                    <td><?php echo $row['harvest_date']; ?></td>
                    <td>
                        <a href="update_crops.php?id=<?php echo $row['crop_id']; ?>" style="padding: 5px 10px; background: #3498db; color: white; text-decoration: none; border-radius: 3px;">Edit</a>
                        <a href="delete_crop.php?id=<?php echo $row['crop_id']; ?>" style="padding: 5px 10px; background: #e74c3c; color: white; text-decoration: none; border-radius: 3px;" onclick="return confirm('Delete this crop?')">Delete</a>
                    </td>
                </tr>                       
            <?php   
                    }
                } else {
                    echo "<tr><td colspan='6' style='text-align:center;'>No crops found</td></tr>";
                }
                $conn->close(); 
            ?>              
        </tbody>
    </table>

    <br>
    <a class="backbtn" href="index.html">⬅ Agricultural Inventory Management System</a>
</div> 

</body>
</html>