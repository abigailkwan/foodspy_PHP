<?php
$servername = "localhost";
$username = "******************";
$password = "************";
$database = "******************"; 

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}

$foodid = json_decode($_POST["food_id"]);
$targetDir = "img/";
$fileName = json_decode($_POST["file_name"]);
$targetFilePath = $targetDir . $fileName;
$cameraImage = "https://abigailkwan.000webhostapp.com/img/abby.jpg";

if (!copy($cameraImage, $targetFilePath)){
    echo "failed to copy";
}

$sql = "UPDATE FoodProfile SET food_image = '$fileName' WHERE food_id = '$foodid'";
if(mysqli_query($conn,$sql)){
    $statusMsg = "Added Picture successfully";
}else {
    $statusMsg = "Error inserting".mysqli_error($conn);
}


$conn->close();
?>