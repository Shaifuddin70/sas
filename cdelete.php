<?php

include 'db_connect.php';
$db = new dbObj();
$conn =  $db->getConnstring();
$id = $_GET['deleteid'];
$data = mysqli_query($conn, "SELECT *FROM student WHERE cid=$id");
$total = mysqli_num_rows($data);
if($total == 0){
$sql = "DELETE FROM `class` WHERE cid=$id;";
$result = mysqli_query($conn, $sql);
if ($result) {
    echo 'delete succesfully';
    header("location:class.php");
} else {
    die(mysqli_error($conn));
}
}else{

        echo "<script>alert('There are students in this class.Please remove them first!')</script>";
        echo "<script>window.location='class.php'</script>";

}



