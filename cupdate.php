<?php
include 'nav.php';
if (isset($_SESSION['stuff'])) {
} elseif (isset($_SESSION['admin'])) {
} else {
    echo "<script>alert('Unautorized Access')</script>";
    echo "<script>window.location='index.php'</script>";
}
?>

<div class="container">
    <form method="post">
        <h1>Update Class</h1>
        <div class="container mt-3">

            <table class="table table-borderless">
                <tr>

                    <th>Class Name</th>
                </tr>
                <tr>

                    <td> <input type="text" class=" form-control form-control-lg" required="true" name="cname" placeholder="class Name"></td>

                </tr>
            </table>
            <div class="button">
                <button class="btn btn-primary" type="submit" name="submit">SUBMIT</button>
            </div>
        </div>


    </form>
</div>



</html>
<?php
include 'footer.php';
if (isset($_POST['submit'])) {
    $id = $_GET['updateid'];
    $cname = $_POST['cname'];

    $query = "UPDATE class SET `cid`='$id',`cname`='$cname' WHERE cid='$id'";
    $query_run = mysqli_query($conn, $query);
    if ($query_run) {
        echo "<script>success</script>";
        echo "<script>window.location='class.php'</script>";
    } else {
        echo "fail";
        header("location:class.php");
    }
}


?>