<?php include 'nav.php';
if (isset($_SESSION['admin'])) {
} else {
    echo "<script>alert('Unautorized Access')</script>";
    echo "<script>window.location='index.php'</script>";
}
$totalem = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `employee`"));
$totalem = $totalem - 1;

$totals = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `student`"));

$totalc = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `item_catagory`"));
$totalis = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `issue`"));
$totalr = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `item_request`"));

// pattendance persent
$attquery = mysqli_query($conn, "SELECT *FROM `attendance`");
$atttotal = mysqli_num_rows($attquery);
$present = 0;
$absent = 0;
if ($atttotal != 0) {
    while ($attresult =  mysqli_fetch_assoc($attquery)) {
        if ($attresult['attendance_value'] == 1) {
            $present++;
        }
    }
}
$attendance = number_format(($present / $atttotal) * 100, 2);



?>
<div class="dash-content">
    <div class="overview">
        <div class="title">
            <i class="uil uil-tachometer-fast-alt"></i>
            <span class="text">Dashboard</span>
        </div>

        <div class="boxes">
            <div class="box box1">
                <i class="uil uil-users-alt"></i>
                <span class="text">Total Teacher</span>
                <a href="teacher.php"><span class="number"><?php echo "$totalem" ?></span></a>
            </div>
            <div class="box box2">
                <i class="uil uil-chart"></i>
                <span class="text">Total Student</span>
                <a href="student.php"><span class="number"><?php echo "$totals" ?></span></a>
            </div>
            <div class="box box3">
                <i class="uil uil-shopping-cart"></i>
                <span class="text">Total Item</span>
                <span class="number"><?php echo "$attendance" ?> %</span>
            </div>
        </div>
        <br>
        <table class="table">
            <thread>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Department</th>
                    <th>Class</th>
                    <th>Section</th>
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
        </tr>';
                }
            } else {
                echo "NO records Found";
            };


            include 'footer.php';
            ?>
        </table>


    </div>

    <?php
    include 'footer.php';
    ?>