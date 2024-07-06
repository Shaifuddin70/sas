<?php include 'nav.php';
if (isset($_SESSION['admin'])) {
} else {
    echo "<script>alert('Unautorized Access')</script>";
    echo "<script>window.location='index.php'</script>";
}
?>

<div class="container">
    <div class="title">
        <span class="text">All Section</span>
        <a href="add_section.php" class="text"><button class="btn btn-primary" style="position: relative;
    left: 470px;"> Add Section</button> </i></a>
    </div>

    <table class="table table-borderless">
        <thread>
            <tr>
                <th>S/N</th>
                <th>Section</th>
                <th>Operation</th>
            </tr>
        </thread>
        <?php
        $c = 1;
        $query = "select * from section";
        $data = mysqli_query($conn, $query);
        $total = mysqli_num_rows($data);
        if ($total != 0) {
            while ($result = mysqli_fetch_assoc($data)) {

                echo '
        <tr>
        <td>' . $c . '</td>
        <td>' . $result['sname'] . '</td>
        <td>
        <a href="supdate.php? updateid=' . $result['sid'] . '"  class="text-light"><button  class="btn btn-primary">Edit <i class="bx bxs-edit-alt" ></i></button></a>
        <a href="sdelete.php? deleteid=' . $result['sid'] . '"  class="text-light"><button  class="btn btn-danger">Delete <i class="bx bxs-trash" ></i></button></a>
        </td>
        </tr>';
                $c++;
            }
        } else {
            echo "NO records Found";
        };


        include 'footer.php'; ?>