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
  <title>Dashboard</title>

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
      <h1>Grave Offences</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Offences</li>
          <li class="breadcrumb-item active">Grave Offences</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <div class="container">
        <h1 class="mt-4">4.1.3 GRAVE OFFENSES</h1>
        <p>These are offenses which are so severe. The proper penalty for which is exclusion or expulsion.</p>
        
        <ul class="list-group">
            <li class="list-group-item">4.1.3.1 Possession, use or sale prohibited drugs or chemicals and hallucinogenic drugs or 
                substances in any form within the school premises, or the possession of any regulated drug without the proper prescription.</li>
            <li class="list-group-item">4.1.3.2 Theft pilferage of school equipment, materials or supplies, extortion, robbery or an attempt thereof and any form of dishonesty.</li>
            <li class="list-group-item">4.1.3.3 Forgery or falsification and/ or alteration of academic or official records or documents of any kind.</li>
            <li class="list-group-item">4.1.3.4 Willful disregard of authority, disrespect, discourtesy and disobedience to any school official, member of faculty. 
                administration or their representative</li>
            <li class="list-group-item">4.1.3.5 Direct assault upon a person of authority or any school official, faculty member non-academic staff
                 or any corsonal of the school community</li>
            <li class="list-group-item">4.1.3.6 Having been convicted of a crime and/or moral turpitude in any court of justice.</li>
            <li class="list-group-item">4.1.3.7 Committing any act punishable under existing law of the land within and outside the campus and violation of 
                the laws of the Commission on Higher Education.</li>
            <li class="list-group-item">4.1.3.8 Tampering/altering such as changing original photos of ID cards, registration cards, and other 
                school forms.</li>
            <li class="list-group-item">4.1.3.9 Allowing other students or individuals to use their school ID for any purpose.</li>
            <li class="list-group-item">4.1.3.10 Using the name and seal of BESTLINK on printed matters such as program, invitation, announcement, tickets, certification,
                 solicitation atc., without permission from school president or her official representatives.</li>
            <li class="list-group-item">4.1.3.11 Exposing/ Destroying the image of the school that hampers its integrity in the different broadcasting network and 
                other social media platforms.</li>
            <li class="list-group-item">4.1.3.12 Posting inappropriate photos, videos or messages (Cyber Crime).</li>
            <li class="list-group-item">4.1.3.13 Bullying, harassing, defaming, or discriminating against fellow students, faculty, 
                administrators, employees or any other person in social media platforms.</li>
            <li class="list-group-item">4.1.3.14 Discussing, ventilating uploading grievances, concerns, or issues in social networking platforms.</li>
            <li class="list-group-item">4.1.3.15 Exploding of firecrackers, pyrotechnics, pillbox bomb, molotov bomb, and others.</li>
            <li class="list-group-item">4.1.3.16 Carrying deadly weapon and/ or dangerous weapon Including Improvised weapon, explosive and incendiaries Inside the campus.</li>
            <li class="list-group-item">4.1.3.17 Unauthorized use, opening and/or reading or browsing of computer program, files and the like.</li>
            <li class="list-group-item">4.1.3.18 Recruitment to fraternities, hazing and other similar act (RA 8049),</li>
            <li class="list-group-item">4.1.3.19 Unauthorized bringing of outsiders inside the classroom laboratory or office that destroys properties and/or distracts classroom instruction.</li>
            <li class="list-group-item">4.1.3.20 Provoking offensive action that leads to violence.</li>
            <li class="list-group-item">4.1.3.21 Holding of rallies, meetings, activities or programs without necessary permit from the school authorities.</li>
            <li class="list-group-item">4.1.3.22 Unauthorized copying of computer programs, files and others.</li>
            <li class="list-group-item">4.1.3.23-Uttering/expressing profane or indecent language.</li>
            <li class="list-group-item">4.1.3.24 Gambling or playing cards and any misdemeanor/ misbehavior within 100 meters away from the school.</li>
            <li class="list-group-item">4.1.3.25 Unauthorized selling of tickets/solicitation.</li>
        </ul>
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