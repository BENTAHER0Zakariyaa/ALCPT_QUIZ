<?PHP

  namespace ALCPT_QUIZ;

  include __DIR__."/../classes/Database.php";
  include __DIR__."/../classes/Question.php";

  if(isset($_POST['add'])):
    
    // echo '<pre>';
    // print_r($_POST);
    // echo '</pre>';

    $Nquestion=@$_POST['Nquestion'];
    $correct=@$_POST['isCorrect'];
    $question=@$_POST['question'];
    $answerA=@$_POST['answerA'];
    $answerB=@$_POST['answerB'];
    $answerC=@$_POST['answerC'];
    $answerD=@$_POST['answerD'];
    $error=false;

    if(empty($Nquestion) || empty($question) || empty($answerA) || empty($answerB) || empty($answerC) || empty($answerD) || empty($correct)):
      
      $error=true;

    else :

      $q = new Question();
      $q->addQuestion($_POST);

    endif;
  endif;
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../public/bootstrap.css?v=<? echo data()?>">
        <link rel="stylesheet" href="../public/bootstrap.js">
        <title>ALCPT QUIZ - Dashboard</title>
    </head>
<body>

  <nav class="navbar navbar-light bg-light">
    <div class="container-fluid">
      <span class="navbar-brand mb-0 h1">Dashboard</span>
    </div>
  </nav>

  <div class="container pt-5">
    <form action="" method="POST">
    <!--  -->
    <?php 
      if(@$error):
        echo "<div class=\"alert alert-danger\" role=\"alert\">Fields must not be empty!</div>";
      endif;
    ?>
    <!--  -->
    <div class="mt-3">
      <label for="exampleFormControlInput1" class="form-label">Question number : </label>
      <input name="Nquestion" type="number" class="form-control" >
    </div>
    <!--  -->
      <div class="mt-3">
        <label for="exampleFormControlTextarea1" class="form-label">Question : </label>
        <textarea class="form-control" name="question" id="IdQuestion" rows="3"></textarea>
      </div>
    <!--  -->
      <div class="input-group mt-3">
        <div class="input-group-text">
          <input class="form-check-input mt-0" type="radio" name="isCorrect" value="a" aria-label="Radio button for following text input">
        </div>
        <input name="answerA" type="text" class="form-control" aria-label="Text input with radio button">
      </div>
      <div class="input-group mt-2">
        <div class="input-group-text">
          <input class="form-check-input mt-0" type="radio" name="isCorrect" value="b" aria-label="Radio button for following text input">
        </div>
        <input name="answerB" type="text" class="form-control" aria-label="Text input with radio button">
      </div>
      <div class="input-group mt-2">
        <div class="input-group-text">
          <input class="form-check-input mt-0" type="radio" name="isCorrect" value="c" aria-label="Radio button for following text input">
        </div>
        <input name="answerC" type="text" class="form-control" aria-label="Text input with radio button">
      </div>
      <div class="input-group mt-2">
        <div class="input-group-text">
          <input class="form-check-input mt-0" type="radio" name="isCorrect" value="d" aria-label="Radio button for following text input">
        </div>
        <input name="answerD" type="text" class="form-control" aria-label="Text input with radio button">
      </div>
    <!--  -->
      <button type="submit" name="add" class="btn btn-success mt-3">Add</button>
    </form>
  </div>
</body>
</html>