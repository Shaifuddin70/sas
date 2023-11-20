<?php
session_start();
include("db_connect.php");
$db = new dbObj();
$conn =  $db->getConnstring();


?>
<!DOCTYPE html>

<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8" />
  <title>Rajarbagh Police Lines School and College</title>
  <link rel="stylesheet" href="school.css" />
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="Jquery/jquery.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
  <link rel="icon" href="image/slogo.jpg" type="image/png">
 

  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>
  <div class="sidebar open">
    <div class="logo-details">
      <img src="image/slogo.jpg" style="height: 40px; width:40px;   border-radius: 50%;" alt="profileImg" />
      <div class="logo_name">RPLSC</div>
      <i class="bx bx-menu" id="btn"></i>
    </div>
    <ul class="nav-list">
    <?php if (isset($_SESSION['admin'])) {
     echo ' 
    
     <li>
        <a href="dashboard.php">
          <i class="bx bx-grid-alt"></i>
          <span class="links_name">Dashboard</span>
        </a>
        <span class="tooltip">Dashboard</span>
      </li>
      <li>
        <a href="student.php">
          <i class="bx bx-user"></i>
          <span class="links_name">Student</span>
        </a>
        <span class="tooltip">Student</span>
      </li>
      <li>
        <a href="class.php">
          <i class="bx bx-chat"></i>
          <span class="links_name">Class</span>
        </a>
        <span class="tooltip">Class</span>
      </li>
      <li>
        <a href="section.php">
          <i class="bx bx-pie-chart-alt-2"></i>
          <span class="links_name">Section</span>
        </a>
        <span class="tooltip">Section</span>
      </li>
      <li>
        <a href="teacher.php">
          <i class="bx bx-folder"></i>
          <span class="links_name">Teacher</span>
        </a>
        <span class="tooltip">Teacher</span>
      </li>
      <li>
        <a href="adminrecord.php">
          <i class="bx bx-folder"></i>
          <span class="links_name">Attendance</span>
        </a>
        <span class="tooltip">Attendance</span>
      </li>'
      
      
      ;}?>

      <!-- Teacher -->
      <?php if (isset($_SESSION['teacher'])) { echo'
        
        <ul class="nav-list">
     <li>
        <a href="attendance.php">
          <i class="bx bx-grid-alt"></i>
          <span class="links_name">Attendance</span>
        </a>
        <span class="tooltip">Attendance</span>
      </li>
      <li>
        <a href="attendancerecord.php">
          <i class="bx bx-user"></i>
          <span class="links_name">Attendace Report</span>
        </a>
        <span class="tooltip">Attendace Report</span>
      </li>
        ';}?>

      <li class="profile" >
      <div class="profile-details">
          <img src="image/user.png" alt="profileImg" />
          
          <div class="name_job">
          
          <a href="profile.php" ><div style="background-color: #1D1B31; color:white;">
            <?php
            $query = mysqli_query($conn, "SELECT * FROM `employee` WHERE `id`='$_SESSION[eid]'");
            $fetch = mysqli_fetch_array($query);
          echo $fetch['name'];?>
          </div></a>
            <div class="job">
              <?php
              $query = mysqli_query($conn, "SELECT * FROM `employee` WHERE `id`='$_SESSION[eid]'");
              $fetch = mysqli_fetch_array($query);
              $role = $fetch["role"];
              
              $query = mysqli_query($conn, "SELECT * FROM `role` WHERE `id`='$role'"); 
              $fetch = mysqli_fetch_array($query);
              echo $fetch['name'];
              ?>
          </div>
          </div>
        </div>
        <a href="logout.php" id="log_out">
        <i class="bx bx-log-out" ></i>
        </a>
      </li>
        
    </ul>
  </div>
  <section class="home-section">
    <div class="text"></div>