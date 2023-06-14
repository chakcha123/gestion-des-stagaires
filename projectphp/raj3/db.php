<?php

$servername = "localhost";
$username = "root";
$password = "";
$db_name = "chakcha";

// Create connection
$conn = new mysqli($servername, $username, $password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create table
$table_query = "CREATE TABLE IF NOT EXISTS T_CHAKCHA(
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(30) NOT NULL,
    lastname VARCHAR(30) NOT NULL,
    email VARCHAR(50) NOT NULL,
    MDP VARCHAR(30) NOT NULL
)";

if ($conn->query($table_query) === TRUE) {

} else {
    echo "Error creating table: " . $conn->error;
}

// Close the connection
// $conn->close();
?>