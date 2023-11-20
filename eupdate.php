<?php include 'nav.php';
$id = $_GET['updateid'];
$query = mysqli_query($conn, "SELECT employee.name,employee.email,employee.role,employee.number,employee.department_id,employee.cid,employee.sid FROM employee JOIN department on department.id=employee.department_id  WHERE employee.id='$id'");
$fetch = mysqli_fetch_array($query);
$department=mysqli_fetch_assoc(mysqli_query($conn,"SELECT `name` FROM department WHERE id=$fetch[department_id]"));
$role=mysqli_fetch_assoc(mysqli_query($conn,"SELECT `name` FROM `role` WHERE id=$fetch[role]"));

?>



<div class="container mt-3">
    <h1>Update Employee Info.</h1>
    <form method="post">

        <table class="table table-borderless">
            <tr>
                <th>Name</th>
                <td> <input type="text" class=" form-control form-control-lg"  name="name" autocomplete="off" value="<?php echo $fetch['name']; ?>"></td>
            </tr>
            <tr>
                <th>Email</th>
                <td> <input type="text" class=" form-control form-control-lg"  name="email" value="<?php echo $fetch['email']; ?>" autocomplete="off"></td>
            </tr>
            <tr>

                <th>Password</th>
                <td>
                    <input type="password" class=" form-control form-control-lg"  name="password" value="Password" autocomplete="new-password" maxlength="8" minlength="6">
                </td>

            </tr>
            <tr>
                <th>Phone</th>

                <td> <input type="text" class=" form-control form-control-lg"  name="number" autocomplete="off" value="<?php echo $fetch['number']; ?>"></td>
            </tr>
            <tr>
                <th>Department</th>

                <td>
                    <?php
                    $did = $fetch['department_id'];
                    $dquery = mysqli_query($conn, "SELECT *FROM department  WHERE id='$did'");
                    $dfetch = mysqli_fetch_array($dquery);


                    $catagory = "SELECT * FROM department";
                    $result = mysqli_query($conn, $catagory);
                    ?>
                    <select class="form-control form-control-lg" aria-label="Default select example" name="department" required="true" id="department" >
                        <option selected disabled><?php echo $dfetch['name']; ?></option>
                        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                            <option value="<?php echo $row['id']; ?>"> <?php echo $row['name']; ?> </option>
                        <?php endwhile; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th>Class</th>

                <td>
                    <?php
                    $cid = $fetch['cid'];
                    $cquery = mysqli_query($conn, "SELECT *FROM class  WHERE cid='$cid'");
                    $cfetch = mysqli_fetch_array($cquery);
                    $catagory = "SELECT * FROM class";
                    $result = mysqli_query($conn, $catagory);
                    ?>
                    <select class="form-control form-control-lg" aria-label="Default select example" name="class" required="true" id="class" >
                        <option selected disabled><?php echo $cfetch['cname']; ?></option>
                        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                            <option value="<?php echo $row['cid']; ?>"> <?php echo $row['cname']; ?> </option>
                        <?php endwhile; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th>Section</th>

                <td>
                    <?php
                    $sid = $fetch['sid'];
                    $squery = mysqli_query($conn, "SELECT *FROM section  WHERE `sid`='$sid'");
                    $sfetch = mysqli_fetch_array($squery);


                    $catagory = "SELECT * FROM section";
                    $result = mysqli_query($conn, $catagory);
                    ?>
                    <select class="form-control form-control-lg" aria-label="Default select example" name="section" required="true" id="section">
                        <option selected disabled><?php echo $sfetch['sname']; ?></option>
                        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                            <option value="<?php echo $row['sid']; ?>"> <?php echo $row['sname']; ?> </option>
                        <?php endwhile; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th>Role</th>
                <td> <?php
                        $rid = $fetch['role'];
                        $rquery = mysqli_query($conn, "SELECT *FROM `role`  WHERE id='$rid'");
                        $rfetch = mysqli_fetch_array($rquery);

                        $catagory = "SELECT * FROM role";
                        $result = mysqli_query($conn, $catagory);
                        ?>
                    <select class="form-control form-control-lg" aria-label="Default select example" required="true" name="role" id="role"  value="<?php echo $role; ?>">
                        <option selected disabled><?php echo $rfetch['name']; ?></option>
                        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                            <option value="<?php echo $row['id']; ?>"> <?php echo $row['name']; ?> </option>
                        <?php endwhile; ?>
                    </select>
                </td>
            </tr>
        </table>
        <div class="button">
            <button class="btn btn-primary" type="submit" name="submit">UPDATE</button>
        </div>
</div>
</form>
</body>

</html>

<?php


if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $number = $_POST['number'];
        $department = $_POST['department'];
        $cid = $_POST['class'];
        $sid = $_POST['section'];
        $pass = $_POST['password'];
        $role = $_POST['role'];
        $pass = password_hash($pass, PASSWORD_DEFAULT);
        $query = "UPDATE `employee` SET `name`='$name',`email`='$email',`number`='$number',`department_id`='$department',`cid`='$cid',`sid`='$sid',`password`='$pass',`role`='$role' WHERE `id`='$id'";
        $data = mysqli_query($conn, $query);

    if ($data) {

        echo "<script>window.location='teacher.php'</script>";
    } else {
        echo "<script>alert('Sorry something may have occured!')</script>";
        header("location:teacher.php");
    }
}
include'footer.php'; ?>
