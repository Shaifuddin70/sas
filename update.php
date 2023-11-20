<?php
include 'nav.php';
$id= $_GET['updateid'];
$query = mysqli_query($conn, "SELECT * FROM `student` WHERE `id`='$id'");
$fetch = mysqli_fetch_array($query);
?>
   
        <div class="container mt-3">
        <form method="post">
        <h1>Update Item Info.</h1>
            <?php
            if (isset($_SESSION['status'])) {
                echo "<h4>" . $_SESSION['status'] . "<h4>";
                unset($_SESSION['status']);
            }
            ?>
            <table class="table table-borderless">
                <tr>
                <th>Roll</th>
                    <th>Name</th>
                    <th>Class</th>
                    <th>Section</th>
                </tr>
                <tr>
                <td> <input type="text" class=" form-control form-control-lg" required="true" name="roll" placeholder="<?php echo '' . $fetch['roll'] . '' ?>"></td>
                    <td> <input type="text" class=" form-control form-control-lg" required="true" name="name" placeholder="<?php echo '' . $fetch['name'] . '' ?>"></td>
                   
                    <td>
                        <?php
                      
                        $class = "SELECT * FROM class";
                        $result = mysqli_query($conn, $class);
                        ?>
                        <select class="form-control form-control-lg" aria-label="Default select example"  name="class" id="class">
                            <option selected disabled>Class</option>
                            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                                <option value="<?php echo $row['cid']; ?>"> <?php echo $row['cname']; ?> </option>
                            <?php endwhile; ?>
                        </select>
                    </td>
                    <td>
                        <?php
                      
                        $section = "SELECT * FROM section";
                        $result = mysqli_query($conn, $section);
                        ?>
                        <select class="form-control form-control-lg" aria-label="Default select example"  name="section" id="section">
                            <option selected disabled>Section</option>
                            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                                <option value="<?php echo $row['sid']; ?>"> <?php echo $row['sname']; ?> </option>
                            <?php endwhile; ?>
                        </select>
                    </td>
                </tr>
            </table>
            <div class="button">
                <button class="btn btn-primary" type="submit" name="submit">Update</button>
            </div>
            </form>
        </div>
    
</body>

</html>
<?php
  include 'footer.php';
if (isset($_POST['submit'])) {
    $roll = $_POST['roll'];
    $name = $_POST['name'];
    $class = $_POST['class'];
    $section = $_POST['section'];

    $query = "UPDATE student SET `id`='$id',`roll`='$roll',`name`='$name',`cid`='$class',`sid`='$section' WHERE id='$id'";
    $query_run = mysqli_query($conn, $query);
    if ($query_run) {
        echo "<script>success</script>";
        echo "<script>window.location='student.php'</script>";
    } else {
        echo "fail";
        header("location:student.php");
    }
}


?>