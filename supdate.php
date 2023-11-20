<?php
include 'nav.php';
if(isset($_SESSION['stuff'])){
    

}elseif(isset($_SESSION['admin'])){

}
else{
    echo "<script>alert('Unautorized Access')</script>";
    echo "<script>window.location='employeelogin.php'</script>";
}
?>

<div class="container">
    <form  method="post">
        <h1>Update Section</h1>
        <div class="container mt-3">
           
            <table class="table table-borderless">
                <tr>

                    <th>Section Name</th>
                </tr>
                <tr>

                    <td> <input type="text" class=" form-control form-control-lg" required="true" name="sname" placeholder="Section Name"></td>

                </tr>
            </table>
            <div class="button">
                <button class="btn btn-primary" type="submit" name="submit">SUBMIT</button>
            </div>
        </div>


    </form></div>



</html>
<?php
include 'footer.php';
if (isset($_POST['submit'])) {
    $id = $_GET['updateid'];
    $sname = $_POST['sname'];

    $query = "UPDATE section SET `sid`='$id',`sname`='$sname' WHERE `sid`='$id'";
    $query_run = mysqli_query($conn, $query);
    if ($query_run) {
        echo "<script>success</script>";
        echo "<script>window.location='section.php'</script>";
    } else {
        echo "fail";
        header("location:section.php");
    }
}


?>