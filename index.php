<?php
$servername = "localhost";
$username = "******************";
$password = "************";
$database = "******************"; 

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}

$sql = "CREATE TABLE IF NOT EXISTS FoodProfile (
    food_id INT AUTO_INCREMENT PRIMARY KEY,
    name        VARCHAR(30) NOT NULL,
    reg_date    DATETIME    NOT NULL,
    exp_date    DATETIME    NOT NULL
)";

$sql = "CREATE TABLE IF NOT EXISTS tempData (
    temp_data   VARCHAR(30) NOT NULL,
    humid_data  VARCHAR(30) NOT NULL,
    reg_date    DATETIME    NOT NULL
)";

/*if ($conn->query($sql) === TRUE){
    echo "Table FoodProfile created successfully";
} else {
    echo "Error creating table: " . $conn->error; 
}*/

/* 
 $sql = "INSERT INTO FoodProfile (name, reg_date, exp_date) VALUES
('noodles', NOW(),'2020-10-10 10:10:10')";
if ($conn->query($sql) === TRUE)
{
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error; 
} */

$sql = "SELECT food_id, name, reg_date, exp_date FROM FoodProfile";
$result = $conn->query($sql);

$dbdata = array();

if ($result->num_rows >0)
{
    while($row = $result->fetch_assoc()) {
        $dbdata[] = $row; 
        /*echo "<br> id: ". $row["food_id"]. " - Name: ". $row["name"]. " Registered on: ".
        $row["reg_date"] . " Expiration: ". $row["exp_date"] . "<br>"; */
    }
} else {
    echo "no data";
}

if ($_SERVER['REQUEST_METHOD'] == "GET")
{
    //echo $result["food_id"];   
    if($_GET["data"] == 1)
    {
        $result = $conn->query("SELECT * FROM FoodProfile");
        $dbdata = array();
        while ($row = $result->fetch_assoc()) {
            $dbdata[] = $row; 
        }    
        echo json_encode($dbdata); 
    }
    if($_GET["data"] == 2)
    {
        $result = $conn->query("SELECT temp_data FROM tempData LIMIT 1");
        $tempdata = $result->fetch_assoc(); 
        echo json_encode($tempdata);
    }
}


if($_SERVER['REQUEST_METHOD'] == "POST")
{
    if(true)
    {   //this works 
        echo $_POST["temperature"];
        echo $_POST["humidity"];
        $currentdate = date('Y-m-d H:i:s');
        echo $currentdate;
        
        $temp = $_POST["temperature"];
        $hum = $_POST["humidity"];
        
        
        $sql = "UPDATE tempData SET temp_data = '$temp',
        reg_data = '$currentdate', humid_data='$hum' LIMIT 1";
        
        if(mysqli_query($conn,$sql)){
            echo "updated successfully"; 
        }else {
            echo "Error updating:".mysqli_error($conn); 
        }
        
    
    }
}

        //this works
        /*
        $sql = "INSERT INTO tempData (temp_data, reg_data, humid_data)
                VALUES ('$temp', '$currentdate','$hum')";
        if(mysqli_query($conn,$sql)){
            echo "Inserted successfully";
        }else {
            echo "Error inserting".mysqli_error($conn);
        }*/
        /*
        $sql = "INSERT INTO FoodProfile (name, reg_date, exp_date) VALUES
               (?, ?, ?)"; //gets object
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $name, $reg_date, $exp_date);
        $stmt->execute();
        if($stmt === TRUE) //cycle through results of object 
        {
            echo "Item added successfully.";
        }echo "Error: item not added";
        $stmt->close();
        
}*/

$conn->close();
?>