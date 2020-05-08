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
    $name = json_decode($_POST["name"]);
    $expiration = json_decode($_POST["exp_date"]);
    echo $expiration; 
        //this works
    $sql = "UPDATE FoodProfile SET name = '$name', exp_date = '$expiration' WHERE food_id = '$foodid'";
                
    if(mysqli_query($conn,$sql)){
        echo "Edited successfully";
    }else {
        echo "Error inserting".mysqli_error($conn);
    }

$conn->close();
?>