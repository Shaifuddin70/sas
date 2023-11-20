<?php include 'nav.php';
if (isset($_SESSION['admin'])) {
} else {
    echo "<script>alert('Unautorized Access')</script>";
    echo "<script>window.location='employeelogin.php'</script>";
}
?>
<div class="container">
<div class="title">
    <span class="text">Teacher List</span>
    <a href="add_employee.php" class="text" style="position: relative;
    left: 650px;" ><button class="btn btn-primary"> Add Employee</button></a>
</div>
<?php
        if (isset($_SESSION['status'])) {
            echo "<p class='text-danger'>" . $_SESSION['status'] . "<p>";
            unset($_SESSION['status']);
        }
        ?>

<table class="table">
    <thread>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Department</th>
            <th>Class</th>
            <th>Section</th>
            <th>Action</th>

        </tr>
    </thread>
    <?php

    $query = "select * from employee WHERE role='2'";
    $data = mysqli_query($conn, $query);
    $total = mysqli_num_rows($data);
    
    if ($total != 0) {
        while ($result = mysqli_fetch_assoc($data)) {
            $did = $result['department_id'];
            $department = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `department` WHERE id='$did'"));
            $cid = $result['cid'];
            $class = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `class` WHERE cid='$cid'"));
            $sid = $result['sid'];
            $section = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `section` WHERE sid='$sid'"));
           
            echo '
        <tr>
        <td>' . $result['name'] . '</td>
        <td>' . $result['email'] . '</td>
        <td>' . $result['number'] . '</td>
        <td>' . $department['name'] . '</td>
        <td>' . $class['cname'] . '</td>
        <td>' . $section['sname'] . '</td>
        
        <td>
        <a href="eupdate.php? updateid=' . $result['id'] . '"  class="text-light"><button class="btn btn-primary"> Edit <i class="bx bxs-edit-alt"></i></button></a>
        <a href="edelete.php? deleteid=' . $result['id'] . '"  class="text-light"><button class="btn btn-danger">Delete <i class="bx bxs-user-x" ></i></button></a>
        </td>
        
        </tr>';
        }
    } else {
        echo "NO records Found";
    };


    include 'footer.php';
    ?>
</table>
</div>
