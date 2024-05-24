<?php 
session_start();
if (isset($_SESSION['admin_id']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Admin') {
       include "../db_connection.php";
       include "data/student.php";
       include "data/subject.php";
       include "data/semester.php";
       include "data/section.php";

       if(isset($_GET['student_id'])){

       $student_id = $_GET['student_id'];

       $student = getStudentById($student_id, $conn);    
 ?>
<?php
       include "../header.php";
?>
<body>
    <?php 
        include "../nav.php";
        if ($student != 0) {
     ?>
     <div class="container mt-5">
         <div class="card" style="width: 22rem;">
          <img src="../img/student-<?=$student['gender']?>.png" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title text-center">@<?=$student['username']?></h5>
          </div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">First name: <?=$student['fname']?></li>
            <li class="list-group-item">Last name: <?=$student['lname']?></li>
            <li class="list-group-item">Username: <?=$student['username']?></li>
            <li class="list-group-item">Address: <?=$student['address']?></li>
            <li class="list-group-item">Date of Birth: <?=$student['date_of_birth']?></li>
            <li class="list-group-item">Email address: <?=$student['email_address']?></li>
            <li class="list-group-item">Gender: <?=$student['gender']?></li>
            <li class="list-group-item">Date of Joining: <?=$student['date_of_joined']?></li>

            <li class="list-group-item">Grade: 
                 <?php 
                      $grade = $student['semester'];
                      $g = getGradeById($grade, $conn);
                      echo $g['semester_code'].'-'.$g['semester'];
                  ?>
            </li>
            <li class="list-group-item">Section: 
                 <?php 
                    $section = $student['section'];
                    $s = getSectionById($section, $conn);
                    echo $s['section'];
                  ?>
            </li>
            <li class="list-group-item">Parent first name: <?=$student['parent_fname']?></li>
            <li class="list-group-item">Parent last name: <?=$student['parent_lname']?></li>
            <li class="list-group-item">Parent phone number: <?=$student['parent_phone_number']?></li>
          </ul>
          <div class="card-body">
            <a href="student.php" class="card-link">Go Back</a>
          </div>
        </div>
     </div>
     <?php 
        }else {
          header("Location: teacher.php");
          exit;
        }
     ?>
</body>
<?php 
        include "../footer.php";
?>
<?php 

    }else {
        header("Location: student.php");
        exit;
    }

  }else {
    header("Location: ../login.php");
    exit;
  } 
}else {
	header("Location: ../login.php");
	exit;
} 

?>
