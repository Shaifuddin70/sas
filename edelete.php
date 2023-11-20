<?php

include 'db_connect.php';
$db = new dbObj();
$conn =  $db->getConnstring();
$id = $_GET['deleteid'];
$q=mysqli_num_rows(mysqli_query($conn,"SELECT * from issue WHERE employee_id='$id'"));
if($q!=0){
    echo "<script>alert('There is a class assigned to this teacher')</script>";
    echo "<script>window.location='teacher.php'</script>";
}else{
    $sql = "DELETE FROM `employee` WHERE id=$id;";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo 'delete succesfully';
        header("location:teacher.php");
    } else {
        die(mysqli_error($conn));
    }
    
}
