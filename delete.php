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

        //this works
    $sql = "DELETE FROM FoodProfile WHERE food_id = '$foodid'";
                
    if(mysqli_query($conn,$sql)){
        echo "Deleted successfully";
    }else {
        echo "Error inserting".mysqli_error($conn);
    }

$conn->close();
?>