<?php
if (isset($_COOKIE['testId']) && isset($_COOKIE['studentId'])) {
    unset($_COOKIE['testId']); 
    setcookie('testId', "", time()-(60*60*3),); 
    unset($_COOKIE['studentId']); 
    setcookie('studentId', "", time()-(60*60*3),);  
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/lib/bootstrap.css?v=<? echo data()?>">
    <link rel="stylesheet" href="public/sass/style.css?v=<? echo data()?>">
    <script src="public/lib/bootstrap.js"></script>
    <title>BYE</title>
</head>
<body>
<div class="container"> 
    <div class="by">
       <div class="by-content">
            <a href="index.php" class="btn btn-primary">Exit</a>
       </div>
    </div>
</div>
</body>
</html>