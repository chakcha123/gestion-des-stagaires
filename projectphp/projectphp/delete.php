<?php
require 'db.php';
$id = $_GET['id'];
$sql = "DELETE FROM etudiant WHERE id = ?";
$statement = mysqli_prepare($mysqli, $sql);
mysqli_stmt_bind_param($statement, 'i', $id);

if (mysqli_stmt_execute($statement)) {
    mysqli_stmt_close($statement);


    $selectSql = "SELECT id FROM etudiant ORDER BY id ASC";
    $result = mysqli_query($mysqli, $selectSql);


    $newId = 1;
    while ($row = mysqli_fetch_assoc($result)) {
        $oldId = $row['id'];
        $updateSql = "UPDATE etudiant SET id = '$newId' WHERE id = '$oldId'";
        mysqli_query($mysqli, $updateSql);
        $newId++;
    }

    mysqli_close($mysqli);
    header("Location: index2.php");
    exit();
} else {
    echo "Error deleting record: " . mysqli_error($mysqli);
}

?>
