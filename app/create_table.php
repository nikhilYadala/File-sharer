<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login_data";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "CREATE TABLE login_info (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
         username VARCHAR(30) NOT NULL,
          password VARCHAR(30) NOT NULL,
           data TEXT)";

if ($conn->query($sql) === TRUE) {
    echo "Table login_info created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>