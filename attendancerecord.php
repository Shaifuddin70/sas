<?php
include 'nav.php';

$query = mysqli_query($conn, "SELECT `cid`,`sid` FROM `employee` WHERE `id`='$_SESSION[eid]'");
$fetch = mysqli_fetch_assoc($query);

$cid = $fetch['cid']; // Access the 'cid' value from the $fetch array
$sid = $fetch['sid']; // Access the 'sid' value from the $fetch array

// Use the retrieved $cid and $sid values to fetch the class and section names
$class_query = mysqli_query($conn, "SELECT `cname` FROM `class` WHERE cid='$cid'");
$section_query = mysqli_query($conn, "SELECT `sname` FROM `section` WHERE `sid`='$sid'");

$class = mysqli_fetch_assoc($class_query)['cname']; // Access the 'cname' value from the result
$section = mysqli_fetch_assoc($section_query)['sname']; // Access the 'sname' value from the result




$sub_sql = "";
$eq = "";
$student = "";

if (isset($_POST['submit'])) {
    if (!empty($_POST['name'])) {
        $student = $_POST['name'];
        $eq = " AND student.id='$student'";
    }

    if ($_POST['from'] == null) {
        $from = '01/01/1998';
    } else {
        $from = $_POST['from'];
    }

    if ($_POST['to'] == null) {
        $to = '01/01/2098';
    } else {
        $to = $_POST['to'];
    }

    $fromarr = explode("/", $from);
    $from = $fromarr[2] . '-' . $fromarr[1] . '-' . $fromarr[0];

    $toarr = explode("/", $to);
    $to = $toarr[2] . '-' . $toarr[1] . '-' . $toarr[0];

    $sub_sql = "WHERE attendance.attendance_date >= '$from' AND attendance.attendance_date <= '$to'";
}

$query = "SELECT student.name, attendance.attendance_date,attendance.attendance_value   
          FROM student
          JOIN attendance ON student.id = attendance.student_id
          $sub_sql $eq
          ORDER BY attendance.id DESC";
?>

<head>
    <style>
        .inputbox {
            position: relative;
            width: 150px;
            padding: 0px 10px 0px;
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
    <h1> Attendance Report</h1>
    <button onclick="purchaseReport()" class="btn btn-info"> Creat Report</button>
    <form method="post">
                <div class="input-group date" style="left: 200px;bottom: 35px;">
                    <label for="from" class="col-1 col-form-label">Student:</label>
                    <?php
                        $student = "SELECT * FROM student Where `cid`=$cid AND `sid`=$sid";
                        $result = mysqli_query($conn, $student);
                        ?>
                        <select class="inputbox" aria-label="Default select example" name="name" id="name">
                            <option selected disabled>Select Std.</option>
                            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                                <option value="<?php echo $row['id']; ?>"> <?php echo $row['name']; ?> </option>
                            <?php endwhile; ?>
                        </select>
                        
                    <label for="from" class="col-1 col-form-label">From:</label>
                    <input type="text" id="from" class="inputbox"  name="from"  autocomplete="off">
                    <label for="to" class="col-0 col-form-label">to</label>
                    <input type="text" id="to" class="inputbox" name="to"  autocomplete="off">
                    <input type="submit" class="btn btn-info" name="submit" value="Filter">
              
            </form>
</div>
<div id="table">
  <h1 id="invisible" class="d-none"  >Issue Report</h1>
<table class="table ">
    <thread>
        <tr>
            <th>S/N</th>
            <th>Student Name</th>
            <th>Class</th>
            <th>Section</th>
            <th>Date</th>
            <th>Status</th>

        </tr>
    </thread>

    <?php
    $data = mysqli_query($conn, $query);
    $total = mysqli_num_rows($data);
    $c = 1;
    if ($total != 0) {
        while ($result = mysqli_fetch_assoc($data)) {


            echo '
    <tr>
        <td>' . $c . '</td>
        <td>' . $result['name'] . '</td>
        <td>' . $class . '</td>
        <td>' . $section . '</td>
        <td>' . $result['attendance_date'] . '</td>
        <td>' . ($result['attendance_value'] == 0 ? 'Absent' : 'Present') . '</td>
        <td>
        </td>
    </tr>';

            $c++;
        }
    } else {
        echo "NO records Found";
    };
    ?>
</table>
</div>
<script>
    $(function() {
        var dateFormat = "dd/mm/yy",
            from = $("#from")
            .datepicker({
                defaultDate: "+1w",
                changeMonth: true,
                numberOfMonths: 1,
                dateFormat: "dd/mm/yy",
            })
            .on("change", function() {
                to.datepicker("option", "minDate", getDate(this));
            }),
            to = $("#to").datepicker({
                defaultDate: "+1w",
                changeMonth: true,
                numberOfMonths: 1,
                dateFormat: "dd/mm/yy",
            })
            .on("change", function() {
                from.datepicker("option", "maxDate", getDate(this));
            });

        function getDate(element) {
            var date;
            try {
                date = $.datepicker.parseDate(dateFormat, element.value);
            } catch (error) {
                date = null;
            }

            return date;
        }
    });

    const purchaseReport = () => {
    $("#invisible").removeClass("d-none");
    var divName= "table";   
var printContents = document.getElementById(divName).innerHTML;
var originalContents = document.body.innerHTML;

document.body.innerHTML = printContents;

window.print();

document.body.innerHTML = originalContents;
$("#invisible").addClass("d-none");
  }
</script>
<?php
include 'footer.php';
?>