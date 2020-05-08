<?php
$servername = "localhost";
$username = "******************";
$password = "************";
$database = "******************"; 

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}

    date_default_timezone_set('America/Los_Angeles');
    $currentdate = date('Y-m-d H:i:s');
    $name = json_decode($_POST["name"]);
    $expiration = json_decode($_POST["exp_date"]);
    $placeholder = "no_image_placeholder.jpg";
    echo $expiration; 
        //this works
    $sql = "INSERT INTO FoodProfile (name, reg_date, exp_date, food_image)
                VALUES ('$name', '$currentdate','$expiration', '$placeholder')";
                
    if(mysqli_query($conn,$sql)){
        echo "Inserted successfully";
    }else {
        echo "Error inserting".mysqli_error($conn);
    }

$conn->close();
?>