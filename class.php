<?php include 'nav.php';
if(isset($_SESSION['admin'])){
    

}
else{
    echo "<script>alert('Unautorized Access')</script>";
    echo "<script>window.location='employeelogin.php'</script>";
}
?>

   

   
  
    <div class="container">
    <div class="title">
    <span class="text">All Classes</span>
    <a href="add_class.php" class="text"><button class="btn btn-primary" style="position: relative;
    left: 470px;"> Add Class</button> </i></a>
</div>

        <table class="table table-borderless">
            <thread>
                <tr>
                    <th>S/N</th>
                    <th>Class</th>
                    <th>Operation</th>
                </tr>
            </thread>
            <?php
            $c = 1;
            $query = "select * from class";
            $data = mysqli_query($conn, $query);
            $total = mysqli_num_rows($data);
            if ($total != 0) {
                while ($result = mysqli_fetch_assoc($data)) {
                 
                    echo '
        <tr>
        <td>' . $c . '</td>
        <td>' . $result['cname'] . '</td>
        <td>
        <a href="cupdate.php? updateid=' . $result['cid'] . '"  class="text-light"><button  class="btn btn-primary">Edit <i class="bx bxs-edit-alt" ></i></button></a>
        <a href="cdelete.php? deleteid=' . $result['cid'] . '"  class="text-light"><button  class="btn btn-danger">Delete <i class="bx bxs-trash" ></i></button></a>
        </td>
        </tr>';
                    $c++;
                }
            } 
            else {
                echo "NO records Found";
            };
 

            include 'footer.php';?>
   