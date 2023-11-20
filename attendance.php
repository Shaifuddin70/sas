<?php
include 'nav.php';

$eid = $_SESSION['eid'];
$query = "SELECT * FROM employee WHERE id='$eid'";
$class = mysqli_fetch_assoc(mysqli_query($conn, $query));

$class_id = $class['cid'];
$section_id = $class['sid'];

$query = "SELECT * FROM student WHERE cid = $class_id AND `sid` = $section_id order by roll asc";
$data = mysqli_query($conn, $query);
$date = date("Y-m-d");
?>

<head>
    <style>
        .inputbox {
            position: relative;
            width: 150px;
            padding: 10px 10px 0px;
            background: transparent;
            border: 1px solid #dddfe2;
            border-radius: 10px;
            outline: none;
            color: rgb(0, 0, 0);
            letter-spacing: .1em;
            z-index: 10;
        }
    </style>
</head>

<div class="container" style="height: 0;">
    <h1> Attendance</h1><br>
    <p>Date: <?php echo "$date" ?></p>
    <?php
if (isset($_SESSION['attendstatus'])) {
    echo "<h4>" . $_SESSION['attendstatus'] . "</h4>";
    unset($_SESSION['attendstatus']);
}
?>
    <form action="attendance_connect.php" method="post" id="attendance-form">
        <div id="table">
            <h1 id="invisible" class="d-none">Issue Report</h1>
            <table class=" table">
                <thead>
                    <tr>
                        <th>Roll</th>
                        <th>Name</th>
                        <th>Class</th>
                        <th>Section</th>
                        <th>Attendance</th>
                    </tr>
                </thead>

                <?php
                $total = mysqli_num_rows($data);
                $c = 1;
                if ($total != 0) {
                    while ($result = mysqli_fetch_assoc($data)) {
                        $cid = $result['cid'];
                        $class = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `class` WHERE cid='$cid'"));
                        $sid = $result['sid'];
                        $section = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `section` WHERE sid='$sid'"));

                        echo '
                        <tr>
                            <td>' . $result['roll'] . '</td>
                            <td>' . $result['name'] . '</td>
                            <td>' . $class['cname'] . '</td>
                            <td>' . $section['sname'] . '</td>
                            <td>
                                <input type="radio" name="attend[' . $result['id'] . ']" value="1" id="present-' . $c . '">
                                <label for="present-' . $c . '">Present</label>
                                <input type="radio" name="attend[' . $result['id'] . ']" value="0" id="absent-' . $c . '">
                                <label for="absent-' . $c . '">Absent</label>
                            </td>
                        </tr>';
                        $c++;
                    }
                } else {
                    echo "No records found";
                };
                ?>
            </table>
            <div class="button">
                <button class="btn btn-primary" style="align-items: center;" type="submit" name="submit">SUBMIT</button>
            </div>
        </div>
    </form>
</div>

<?php
include 'footer.php';
?>

<script>
// Function to clear the form fields
function clearForm() {
    document.getElementById("attendance-form").reset();
}

</script>
