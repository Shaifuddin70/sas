<?php
session_start();
include 'nav.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
   // Check if the 'attend' array is set in the POST data
   if (isset($_POST['attend']) && is_array($_POST['attend'])) {
      

       foreach ($_POST['attend'] as $student_id => $attendance_value) {
         
           $date = date("Y-m-d");
           $existingQuery = "SELECT * FROM attendance WHERE student_id = '$student_id' AND attendance_date = '$date'";
           $existingResult = mysqli_query($conn, $existingQuery);
           if (mysqli_num_rows($existingResult) == 0) {
               
               $query = "INSERT INTO attendance (student_id, attendance_date, attendance_value) 
                         VALUES ('$student_id', '$date', '$attendance_value')";

               $result = mysqli_query($conn, $query);

               if ($result) {
                   $_SESSION ["attendstatus"] = "Attendance is Stored";
               }
           }else{
            $_SESSION ["attendstatus"] = "Attendance is already Taken";
           }
       }

     
       header("Location: attendance.php");
       exit;
   } else {
       
       $_SESSION ["attendstatus"] = "No attendance data received.";
       header("Location: attendance.php");
   }
} else {
   echo "Invalid request.";
}
?>

