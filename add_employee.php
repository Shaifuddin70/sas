<?php
include 'nav.php';

if (isset($_SESSION['admin'])) {
    // Your code for admin access here
} else {
    echo "<script>alert('Unauthorized Access')</script>";
    echo "<script>window.location='employeelogin.php'</script>";
    exit; // Add this to stop executing the code further
}
?>

<div class="container mt-3">
    <form method="post">
        <h1>Add New Teacher</h1>
        
        <table class="table table-borderless">
            <tr>
                <th>Name</th>
                <td> <input type="text" class=" form-control form-control-lg" required="true" name="name" autocomplete="off" placeholder="Name"></td>
            </tr>
            <tr>
                <th>Email</th>
                <td> <input type="text" class=" form-control form-control-lg" required="true" name="email" placeholder="Email" autocomplete="off"></td>
            </tr>
            <tr>

                <th>Password</th>
                <td>
                    <input type="password" class=" form-control form-control-lg" required="true" name="password" placeholder="Password" autocomplete="new-password" maxlength="8" minlength="6">
                </td>


            </tr>
            <tr>
                <th>Phone</th>

                <td> <input type="text" class=" form-control form-control-lg" required="true" name="number" autocomplete="off" placeholder="Phone Number"></td>
            </tr>
            <tr>
                <th>Department</th>

                <td>
                    <?php


                    $catagory = "SELECT * FROM department";
                    $result = mysqli_query($conn, $catagory);
                    ?>
                    <select class="form-control form-control-lg" aria-label="Default select example" name="department" id="department">
                        <option selected disabled>Select Department</option>
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


                    $catagory = "SELECT * FROM class";
                    $result = mysqli_query($conn, $catagory);
                    ?>
                    <select class="form-control form-control-lg" aria-label="Default select example" name="class" id="class">
                        <option selected disabled>Select Class</option>
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


                    $catagory = "SELECT * FROM section";
                    $result = mysqli_query($conn, $catagory);
                    ?>
                    <select class="form-control form-control-lg" aria-label="Default select example" name="section" id="section">
                        <option selected disabled>Select Section</option>
                        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                            <option value="<?php echo $row['sid']; ?>"> <?php echo $row['sname']; ?> </option>
                        <?php endwhile; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th>Role</th>
                <td> <?php
                        $catagory = "SELECT * FROM role";
                        $result = mysqli_query($conn, $catagory);
                        ?>
                    <select class="form-control form-control-lg" aria-label="Default select example" name="role" id="role">
                        <option selected disabled>Select Role</option>
                        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                            <option value="<?php echo $row['id']; ?>"> <?php echo $row['name']; ?> </option>
                        <?php endwhile; ?>
                    </select>
                </td>
            </tr>
       
        </table>
        <div class="button">
            <button class="btn btn-primary" type="submit" name="submit">SUBMIT</button>
        </div>
    </form>
</div>

<?php
include 'footer.php';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $department = $_POST['department'];
    $class = $_POST['class'];
    $section = $_POST['section'];
    $pass = $_POST['password'];
    $role = $_POST['role'];
    $pass = password_hash($pass, PASSWORD_DEFAULT);
    
    $query = "INSERT INTO employee (`name`, `email`, `number`, `department_id`, `cid`, `sid`, `password`, `role`)
              VALUES ('$name', '$email', '$number', '$department', '$class', '$section', '$pass', '$role')";
    $data = mysqli_query($conn, $query);

    if ($data) {
        echo "<script>window.location='teacher.php'</script>";
    } else {
        echo "<script>alert('Error: Unable to add employee')</script>";
    }
}
?>
