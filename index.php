<?php include __DIR__."/inc/outside/header.php"; 
if (isset($_COOKIE['testId']) && isset($_COOKIE['studentId'])) {
  unset($_COOKIE['testId']); 
  setcookie('testId', "", time()-(60*60*3),); 
  unset($_COOKIE['studentId']); 
  setcookie('studentId', "", time()-(60*60*3),);  
}
?>
  <div class="main">
    <div class="content">
      <div class="buttons">
        <a href="studentInfo.php" class="btn btn-outline-primary">Student</a>
        <a href="dashboard/login.php" class="btn btn-primary">Instructor</a>
      </div>
    </div>
  </div>
<?php include __DIR__."/inc/outside/footer.php"; ?>