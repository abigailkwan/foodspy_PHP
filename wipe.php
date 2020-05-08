<?php

$servername = "localhost";
$username = "******************";
$password = "************";
$database = "******************"; 

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}

        //this works
    $sql = "DELETE FROM FoodProfile";
                
    if(mysqli_query($conn,$sql)){
        echo "Deleted successfully";
    }else {
        echo "Error inserting".mysqli_error($conn);
    }

$conn->close();

?>