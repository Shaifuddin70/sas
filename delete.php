<?php

include 'db_connect.php';
$db = new dbObj();
$conn =  $db->getConnstring();
$id = $_GET['deleteid'];


    $sql = "DELETE FROM `student` WHERE id=$id;";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo 'delete succesfully';
        header("location:student.php");
    } else {
        die(mysqli_error($conn));
    }
    

