<?php
include 'nav.php';
if (isset($_SESSION['admin'])) {
} else {
    echo "<script>alert('Unautorized Access')</script>";
    echo "<script>window.location='index.php'</script>";
}
?>

<div class="container">
    <form method="post">
        <h1>Add New Section</h1>
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

    </form>
</div>

<?php
include 'footer.php';
if (isset($_POST['submit'])) {
    $sname = $_POST['sname'];

    $query = "INSERT INTO section(sname)VALUES('$sname')";
    $query_run = mysqli_query($conn, $query);
    if ($query_run) {
        $_SESSION['status'] = "Inserted Succesfully";
        echo "<script>window.location='section.php'</script>";
    } else {
        $_SESSION['status'] = "Not Inserted";
        echo "<script>window.location='section.php'</script>";
    }
}
