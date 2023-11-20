<?php
include 'nav.php';
if (isset($_SESSION['admin'])) {
} else {
    echo "<script>alert('Unautorized Access')</script>";
    echo "<script>window.location='employeelogin.php'</script>";
}
?>

<div class="container">
    <form method="post">
        <h1>Add New Class</h1>
        <div class="container mt-3">

            <table class="table table-borderless">
                <tr>

                    <th>Class Name</th>
                </tr>
                <tr>

                    <td> <input type="text" class=" form-control form-control-lg" required="true" name="cname" placeholder="Class Name"></td>

                </tr>
            </table>
            <div class="button">
                <button class="btn btn-primary" type="submit" name="submit">SUBMIT</button>
            </div>
        </div>

    </form>
</div>

<?php
include 'footer.php';
 if(isset($_POST['submit']))
 {
    $cname = $_POST['cname'];

    $query="INSERT INTO class(cname)VALUES('$cname')";
   $query_run=mysqli_query($conn,$query);
   if($query_run)
   {
    $_SESSION['status']="Inserted Succesfully";
       echo "<script>window.location='class.php'</script>";
   }
   else{
    $_SESSION['status']="Not Inserted";
       echo "<script>window.location='class.php'</script>";
   }
 }

