<?PHP
  namespace ALCPT_QUIZ;

  include __DIR__."/../classes/Database.php";
  include __DIR__."/../classes/Question.php";

  $q = new Question();

  if(isset($_POST['add'])):

    $Nquestion=@$_POST['Nquestion'];
    $correct=@$_POST['isCorrect'];
    $question=@$_POST['question'];
    $answerA=@$_POST['answerA'];
    $answerB=@$_POST['answerB'];
    $answerC=@$_POST['answerC'];
    $answerD=@$_POST['answerD'];
    $error=false;
    $success=false;
    $messge="";

    if(empty($Nquestion) || empty($question) || empty($answerA) || empty($answerB) || empty($answerC) || empty($answerD) || empty($correct)):
      
      $error=true;
      $messge="<div class=\"alert alert-danger\" role=\"alert\">[ADD] : Fields must not be empty!</div>";
    
      elseif($Nquestion < 0 ):
        $error=true;
        $messge="<div class=\"alert alert-danger\" role=\"alert\">[ADD] : Field Question number must be > 0 !</div>";
      
    else :
      if($q->addQuestion($_POST)):
        $success=true;
        $error=false;
        $messge="<div class=\"alert alert-success\" role=\"alert\">[ADD] : Successfully!</div>";
      else:
        $error=true;
        $success=false;
        $messge="<div class=\"alert alert-danger\" role=\"alert\">[ADD] : Question number ({$Nquestion}) existed!</div>";
      endif;

    endif;
endif;

// *********************************************************** 

if(isset($_POST['delete'])):

    $Nquestion=@$_POST['Nquestion'];
    
    $success=false;
    $error=false;

    if(empty($Nquestion)):
        
      $error=true;
      $success=false;
      $messge="<div class=\"alert alert-danger\" role=\"alert\">[DELETE] : Field Question number must not be empty!</div>";

    else :

      if($q->deleteQuestionById($Nquestion)):
        $success=true;
        $error=false;
        $messge="<div class=\"alert alert-success\" role=\"alert\">[DELETE] : Successfully!</div>";
      else:
        $error=true;
        $success=false;
        $messge="<div class=\"alert alert-danger\" role=\"alert\">[DELETE] : Question number ({$Nquestion}) don't exist!</div>";
      endif;

    endif;
endif;

// *********************************************************** 

if(isset($_POST['update'])):
    
    $Nquestion=@$_POST['Nquestion'];
    $correct=@$_POST['isCorrect'];
    $question=@$_POST['question'];
    $answerA=@$_POST['answerA'];
    $answerB=@$_POST['answerB'];
    $answerC=@$_POST['answerC'];
    $answerD=@$_POST['answerD'];
    $error=false;
    $success=false;
    $messge="";

    if(empty($Nquestion) || empty($question) || empty($answerA) || empty($answerB) || empty($answerC) || empty($answerD) || empty($correct)):
      
      $error=true;
      $messge="<div class=\"alert alert-danger\" role=\"alert\">[ADD] : Fields must not be empty!</div>";
    elseif($Nquestion < 0 ):
        $error=true;
        $messge="<div class=\"alert alert-danger\" role=\"alert\">[ADD] : Field Question number must be > 0 !</div>";
    else :
      if($q->deleteQuestionById($Nquestion)):
        $q->addQuestion($_POST);
        $success=true;
        $error=false;
        $messge="<div class=\"alert alert-success\" role=\"alert\">[UPDATE] : Successfully!</div>";
      else:
        $error=true;
        $success=false;
        $messge="<div class=\"alert alert-danger\" role=\"alert\">[UPDATE] : Question number ({$Nquestion}) don't exist!</div>";
      endif;
    endif;
endif;

/************************************ */

if(isset($_POST['search'])):

    $Nquestion=@$_POST['Nquestion'];

    if(empty($Nquestion)):
      $error=true;
      $messge="<div class=\"alert alert-danger\" role=\"alert\">[SEARCH] : Field Question number must not be empty!</div>";
    elseif($Nquestion < 0 ):
      $error=true;
      $messge="<div class=\"alert alert-danger\" role=\"alert\">[SEARCH] : Field Question number must be > 0 !</div>";
    else :
      if($q->isExisted($Nquestion)):
        $error=false;
        $data = $q->getQuestionById($Nquestion);
      else:
        $error=true;
        $messge="<div class=\"alert alert-danger\" role=\"alert\">[SEARCH] : Question number ({$Nquestion}) don't exist!</div>";
      endif;
    endif;
endif;


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../public/lib/bootstrap.css?v=<? echo data()?>">
        <link rel="stylesheet" href="../public/lib/bootstrap.js">
        <title>ALCPT QUIZ - Questions Management</title>
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
            <a class="nav-link active" href="view.php">View</a>
            <a class="nav-link active" aria-current="page" href="questions.php">Management</a>
            <a class="nav-link active" href="help.php">Help</a>
            </div>
        </div>
        </div>
    </nav>

  <div class="container pt-5"> 
    <form action="" method="POST">
    <!--  -->
    <?php 
      if(@$error):
        echo $messge;
      elseif(@$success):
        echo $messge;
      endif;
    ?>
    <!--  -->
    <div class="mt-3">
        <label for="Nquestion" class="form-label">Question number : </label>
        <div class="input-group mb-3">
            <input value="<?= isset($data)?$data["question"]->questionId:""; ?>" name="Nquestion" type="number" class="form-control">
            <button name="search" type="submit" class="btn btn-outline-secondary" >search</button>
        </div>
    </div>
    <!--  -->
      <div class="mt-3">
        <label for="question" class="form-label">Question : </label>
        <textarea class="form-control" name="question" id="IdQuestion" rows="3"><?= isset($data)?$data["question"]->question:""; ?></textarea>
      </div>
    <!--  -->
      <div class="input-group mt-3">
        <div class="input-group-text">
          <input <?= isset($data) && $data["answers"][0]->isCorrect?"checked":""; ?> class="form-check-input mt-0" type="radio" name="isCorrect" value="a"  aria-label="Radio button for following text input">
        </div>
        <input value="<?= isset($data)?$data["answers"][0]->answer:""; ?>" name="answerA" type="text" class="form-control" aria-label="Text input with radio button">
      </div>
      <div class="input-group mt-2">
        <div class="input-group-text">
          <input <?= isset($data) && $data["answers"][1]->isCorrect?"checked":""; ?> class="form-check-input mt-0" type="radio" name="isCorrect" value="b" aria-label="Radio button for following text input">
        </div>
        <input value="<?= isset($data)?$data["answers"][1]->answer:""; ?>" name="answerB" type="text" class="form-control" aria-label="Text input with radio button">
      </div>
      <div class="input-group mt-2">
        <div class="input-group-text">
          <input <?= isset($data) && $data["answers"][2]->isCorrect?"checked":""; ?> class="form-check-input mt-0" type="radio" name="isCorrect" value="c" aria-label="Radio button for following text input">
        </div>
        <input value="<?= isset($data)?$data["answers"][2]->answer:""; ?>" name="answerC" type="text" class="form-control" aria-label="Text input with radio button">
      </div>
      <div class="input-group mt-2">
        <div class="input-group-text">
          <input <?= (isset($data) && $data["answers"][3]->isCorrect)?"checked":""; ?> class="form-check-input mt-0" type="radio" name="isCorrect" value="d" aria-label="Radio button for following text input">
        </div>
        <input value="<?= isset($data)?$data["answers"][3]->answer:""; ?>" name="answerD" type="text" class="form-control" aria-label="Text input with radio button">
      </div>
    <!--  -->
      <button type="submit" name="add" class="btn btn-success mt-3">Add</button>
      <button type="submit" name="delete" class="btn btn-danger mt-3">Delete</button>
      <button type="submit" name="update" class="btn btn-primary mt-3">Update</button>
    </form>
  </div>
</body>
</html>