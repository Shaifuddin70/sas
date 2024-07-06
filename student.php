<?php
include 'nav.php';
if (isset($_SESSION['admin'])) {
} else {
    echo "<script>alert('Unautorized Access')</script>";
    echo "<script>window.location='index.php'</script>";
}
?>

<div class="container">
    <div class="title">
        <span class="text">All Students</span>
        <a href="add_student.php" style="position: relative;
    left: 700px;"><button class="btn btn-primary"> Add Student</button></a>
    </div>



    <table class="table">
        <thread>
            <tr>
                <th>Roll</th>
                <th>Name</th>
                <th>Class</th>
                <th>Section</th>
                <th>Operation</th>
            </tr>
        </thread>
        <?php

        $query = "select * from student";
        $data = mysqli_query($conn, $query);
        $total = mysqli_num_rows($data);
        if ($total != 0) {
            while ($result = mysqli_fetch_assoc($data)) {
                $cid = $result['cid'];
                $cname = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `class` WHERE `cid`='$cid'"));
                $sid = $result['sid'];
                $sname = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `section` WHERE `sid`='$sid'"));

                echo '
        <tr>
        <td>' . $result['roll'] . '</td>
        <td>' . $result['name'] . '</td>
        <td>' . $cname['cname'] . '</td>
        <td>' . $sname['sname'] . '</td>

        
        <td>
        <a href="update.php? updateid=' . $result['id'] . '"  class="text-light"><button  class="btn btn-primary">Edit <i class="bx bxs-edit-alt" ></i></button></a>
        <a href="delete.php? deleteid=' . $result['id'] . '"  class="text-light"><button  class="btn btn-danger">Delete <i class="bx bxs-trash" ></i></button></a>
        </td>

        </tr>';
            }
        } else {
            echo "NO records Found";
        };



        include 'footer.php';
