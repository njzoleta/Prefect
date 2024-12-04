<?php
session_start();
  include('connect.php');
  include('checklog.php');
  check_login();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Student Conduct</title>

  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">

</head>
<body>

<!-- ======= Header ======= -->
<?php include('C:\xampp\htdocs\Prefect\inc\header.php'); ?>
<!-- End Header -->


<!-- ======= Sidebar ======= -->  
<?php include('C:\xampp\htdocs\Prefect\inc\sidebar.php'); ?>
<!-- End Sidebar-->


  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Student Conduct</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Prefect Information</li>
          <li class="breadcrumb-item active">Student Code of Conduct of agreement</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <div class="container">
        <h1 class="mt-4">STUDENT CODE OF CONDUCT AGREEMENT</h1>
        <p>As a student/scholarship grantee of this institution, I commit to abide by the school's policies, procedures, 
            rule and regulations as set forth in the STUDENT HANDBOOK, specifically the following statements below:
        </p>
        
        <ul class="list-group">
            <li class="list-group-item">1. I shall live up to the school's vision, mission, institution goals, core values, and advocacies.</li>
            <li class="list-group-item">2. I shall MAINTAIN GOOD BEHAVIOR befitting of a student in and off campus.</li>
            <li class="list-group-item">3. I shall be respectful in my interaction with school administrators, teachers, other school personnel, parents and visitors.</li>
            <li class="list-group-item">4. I shall refrain from saying inappropriate, disrespectful, and foul words in dealing with the people around me.</li>
            <li class="list-group-item">5. I shall refrain from speaking negatively about other people, Including other schools, in any way.</li>
            <li class="list-group-item">6. I shall report to proper school authority cases or incidents that violate the stipulations above.</li>
            <li class="list-group-item">7. I shall consider myself responsible for the content i posted ONLINE</li>
            <li class="list-group-item">7.1 I shall refrain from sending inappropriate or malicious images, videos, and messages to classmates, school mates, friends, teachers, and school in general.
                school forms.</li>
            <li class="list-group-item">7.2. I shall not engage in ONLINE BEHAVIOR that might be interpreted as dishonest, indecent, immature, rude, disrespectful, 
                discriminatory, violent, arrogant, Immoral, or aggressive.</li>
            <li class="list-group-item">7.3. I shall refrain from engaging in arguments and inflammatory debates whether ONLINE OR IN PERSON</li>
            <li class="list-group-item">7.4 I shall not UPLOAD OR SHARE Inappropriate images, videos or messages.</li>
            <li class="list-group-item">7.5 I shall not express concems/complaints towards the institutions. administrators, teachers, other employees, parents/guardians, and students using social media platforms. Instead,
                 I shall confront concerns accordingly and in person, seeking assistance from my teacher/s or administrators when necessary</li>
        </ul>

        <p>Always remember, a person who places A PHOTO, VIDEO MESSAGE on the INTERNET is deemed to have intended to forsake and renounce all privacy rights to such imagery or text.</p>
        <p>Any violation of the agreement above will be subjected to appropriate disciplinary action as stipulated in the STUDENT HANDBOOK.</p>
        <p>If found guilty, the scholarship will be deemed null and void and shall be forced to pay the school's required TUITION FEE</p>
    </div>
    

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>Prefect Department</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
    <a href="">Prefect Department</a>
    </div>
  </footer><!-- End Footer -->






  <!-- Javascript -->
  <script src="assets/js/main.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>