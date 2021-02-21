<?PHP
  namespace ALCPT_QUIZ;

  include __DIR__."/../classes/Database.php";
  include __DIR__."/../classes/Question.php";

  $q = new Question();

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/lib/bootstrap.css?v=<? echo data()?>">
    <link rel="stylesheet" href="../public/lib/bootstrap.js">
    <title>ALCPT QUIZ - Dashboard</title>
  </head>
  <body>

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php">Dashboard</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
        <a class="nav-link active" href="index.php">Home</a>
          <a class="nav-link active" aria-current="page" href="view.php">View</a>
          <a class="nav-link active" href="questions.php">Management</a>
          <a class="nav-link active" href="help.php">Help</a>
        </div>
      </div>
    </div>
  </nav>

    <div class="container pt-5"> 
      <?php 
          $q->getAllQuestionForAdmin()
      ?>
    </div>

  </body>
</html>