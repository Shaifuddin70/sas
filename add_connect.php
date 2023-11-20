<?php
session_start();
include("db_connect.php");
$db = new dbObj();
$conn =  $db->getConnstring();
if (isset($_POST['submit'])) {
    $roll = $_POST['roll'];
    $name = $_POST['name'];
    $class = $_POST['class'];
    $section = $_POST['section'];




    $query = "INSERT INTO student(roll,name,cid,sid)VALUES('$roll','$name','$class','$section')";
    $query_run = mysqli_query($conn, $query);
    if ($query_run) {
        $_SESSION['status'] = "Inserted Succesfully";

        header("location:student.php");
    } else {
        $_SESSION['status'] = "Not Inserted";
        header("location:student.php");
    }
}
