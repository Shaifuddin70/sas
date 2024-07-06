<?php
include 'nav.php';
if (isset($_SESSION['stuff'])) {
} elseif (isset($_SESSION['admin'])) {
} else {
    echo "<script>alert('Unautorized Access')</script>";
    echo "<script>window.location='index.php'</script>";
}
?>

<div class="container">
    <form action="add_connect.php" method="post">
        <h1>Add New Section</h1>
        <div class="container mt-3">

            <table class="table table-borderless">
                <tr>
                    <th>Roll</th>
                    <th>Name</th>
                    <th>Class</th>
                    <th>Section</th>

                </tr>
                <tr>
                    <td> <input type="text" class=" form-control form-control-lg" required="true" name="roll" placeholder="Roll"></td>
                    <td> <input type="text" class=" form-control form-control-lg" required="true" name="name" placeholder="Student Name"></td>

                    <td>
                        <?php

                        $class = "SELECT * FROM class";
                        $result = mysqli_query($conn, $class);
                        ?>
                        <select class="form-control form-control-lg" aria-label="Default select example" name="class" id="class">
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
                        <select class="form-control form-control-lg" aria-label="Default select example" name="section" id="section">
                            <option selected disabled>Section</option>
                            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                                <option value="<?php echo $row['sid']; ?>"> <?php echo $row['sname']; ?> </option>
                            <?php endwhile; ?>
                        </select>
                    </td>
                </tr>
            </table>
            <div class="button">
                <button class="btn btn-primary" type="submit" name="submit">SUBMIT</button>
            </div>
        </div>
    </form>
    </body>

    </html>
    <?php include 'footer.php'; ?>