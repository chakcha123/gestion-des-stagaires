<?php
$mysqli = new mysqli("localhost", "root", "", "mydbm");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}


$sql = "CREATE TABLE IF NOT EXISTS etudiant (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    prenom VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    mdp VARCHAR(255) NOT NULL
)";


if ($mysqli->query($sql)) {

    $sql = "ALTER TABLE etudiant MODIFY id INT";
    $mysqli->query($sql);
    $result = $mysqli->query("SELECT MAX(id) FROM etudiant");
    $row = $result->fetch_assoc();
    $previousId = $row['MAX(id)'];
    $newId = $previousId + 1;

} else {
    echo "Error creating table: " . $mysqli->error;
}

?>
