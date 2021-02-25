<?php 

namespace ALCPT_QUIZ;

include __DIR__."/../inc/inside/header.php"; 
include __DIR__."/../classes/Database.php";
include __DIR__."/../classes/Session.php";
include __DIR__."/../classes/Question.php";
include __DIR__."/../classes/Test.php";

Session::init();

$Login = Session::getValue("login");
if(!$Login):
header("Location:login.php");
endif;

$q = new Question();

if(!isset($_GET['testId']) || empty($_GET['testId'])):
    header("Location:listTests.php");
endif;

$messge="";

if(isset($_POST['add'])):

    $testId=@$_GET['testId'];
    $questionNumber=@$_POST['questionNumber'];
    $questionType=@$_POST['questionType'];
    $correct=@$_POST['isCorrect'];
    $question=@$_POST['question'];
    $answerA=@$_POST['answerA'];
    $answerB=@$_POST['answerB'];
    $answerC=@$_POST['answerC'];
    $answerD=@$_POST['answerD'];

    $messge="";

    if(empty($questionNumber)):
        $messge="<div class=\"alert alert-danger\" role=\"alert\">[ADD] : Field question Number must not be empty!</div>";
    elseif($questionNumber < 0 ):
        $messge="<div class=\"alert alert-danger\" role=\"alert\">[ADD] : Field Question number must be > 0 !</div>";
    elseif(empty($questionType)):
        $messge="<div class=\"alert alert-danger\" role=\"alert\">[ADD] : Select question type</div>";
    elseif(empty($answerA)):
        $messge="<div class=\"alert alert-danger\" role=\"alert\">[ADD] : Field Answer (a) must be not empty!</div>";
    elseif(empty($answerB)):
        $messge="<div class=\"alert alert-danger\" role=\"alert\">[ADD] : Field Answer (b) must be not empty!</div>";
    elseif(empty($answerC)):
        $messge="<div class=\"alert alert-danger\" role=\"alert\">[ADD] : Field Answer (c) must be not empty!</div>";
    elseif(empty($answerD)):
        $messge="<div class=\"alert alert-danger\" role=\"alert\">[ADD] : Field Answer (d) must be not empty!</div>";
    elseif(empty($correct)):
        $messge="<div class=\"alert alert-danger\" role=\"alert\">[ADD] : SELECT correct answer!</div>";
    else :
        $_POST['testId']=$_GET['testId'];
      if($q->addQuestion($_POST)):
        $messge="<div class=\"alert alert-success\" role=\"alert\">[ADD] : Successfully!</div>";
        $questionNumber="";
        $questionType="";
        $correct="";
        $question="";
        $answerA="";
        $answerB="";
        $answerC="";
        $answerD="";
      else:
        $messge="<div class=\"alert alert-danger\" role=\"alert\">[ADD] : Question number ({$questionNumber}) existed!</div>";
      endif;

    endif;
endif;

if(isset($_POST['update'])):

    $testId=@$_GET['testId'];
    $questionNumber=@$_POST['questionNumber'];
    $questionType=@$_POST['questionType'];
    $correct=@$_POST['isCorrect'];
    $question=@$_POST['question'];
    $answerA=@$_POST['answerA'];
    $answerB=@$_POST['answerB'];
    $answerC=@$_POST['answerC'];
    $answerD=@$_POST['answerD'];

    $messge="";

    if(empty($questionNumber)):
        $messge="<div class=\"alert alert-danger\" role=\"alert\">[UPDATE] : Field question Number must not be empty!</div>";
    elseif($questionNumber < 0 ):
        $messge="<div class=\"alert alert-danger\" role=\"alert\">[UPDATE] : Field Question number must be > 0 !</div>";
    elseif(empty($questionType)):
        $messge="<div class=\"alert alert-danger\" role=\"alert\">[UPDATE] : Select question type</div>";
    elseif(empty($answerA)):
        $messge="<div class=\"alert alert-danger\" role=\"alert\">[UPDATE] : Field Answer (a) must be not empty!</div>";
    elseif(empty($answerB)):
        $messge="<div class=\"alert alert-danger\" role=\"alert\">[UPDATE] : Field Answer (b) must be not empty!</div>";
    elseif(empty($answerC)):
        $messge="<div class=\"alert alert-danger\" role=\"alert\">[UPDATE] : Field Answer (c) must be not empty!</div>";
    elseif(empty($answerD)):
        $messge="<div class=\"alert alert-danger\" role=\"alert\">[UPDATE] : Field Answer (d) must be not empty!</div>";
    elseif(empty($correct)):
        $messge="<div class=\"alert alert-danger\" role=\"alert\">[UPDATE] : SELECT correct answer!</div>";
    else :
        $_POST['testId']=$_GET['testId'];
      if($q->updateQuestion($_POST)):
        $messge="<div class=\"alert alert-success\" role=\"alert\">[UPDATE] : Successfully!</div>";
        $questionNumber="";
        $questionType="";
        $correct="";
        $question="";
        $answerA="";
        $answerB="";
        $answerC="";
        $answerD="";
      else:
        $messge="<div class=\"alert alert-danger\" role=\"alert\">[UPDATE] : Question number ({$questionNumber}) not existed!</div>";
      endif;

    endif;
endif;

if(isset($_POST['search'])):

    $testId=@$_GET['testId'];
    $questionNumber=@$_POST['questionNumber'];

    $messge="";

    if(empty($questionNumber)):
        $messge="<div class=\"alert alert-danger\" role=\"alert\">[SEARCH] : Field question Number must not be empty!</div>";
    elseif($questionNumber < 0 ):
        $messge="<div class=\"alert alert-danger\" role=\"alert\">[SEARCH] : Field Question number must be > 0 !</div>";
    else :
        $tmp=$q->getQuestionsByTestIdAndNumber($testId,$questionNumber);
      if(!empty($tmp)):
        $messge="<div class=\"alert alert-success\" role=\"alert\">[SEARCH] : Successfully!</div>";
        $questionNumber=$tmp->questionNumber;
        $questionType=$tmp->questionType;
        $correct=$tmp->correctAnswer;
        $question=$tmp->question;
        $answerA=$tmp->answerA;
        $answerB=$tmp->answerB;
        $answerC=$tmp->answerC;
        $answerD=$tmp->answerD;
      else:
        $messge="<div class=\"alert alert-danger\" role=\"alert\">[SEARCH] : Question number ({$questionNumber}) existed!</div>";
      endif;

    endif;
endif;

?>
    
<div class="main">
    <?php
      if(!empty($messge)):
          echo "<div class=\"p-2\">{$messge}<div>";
      endif;
    ?>
    <div class="p-5 content-dashboard">
        <div class="">
          <?php include __DIR__."/../inc/inside/nav.php"; ?>
           <div class="row">
               <div class="col-6">
                    <form action="" method="post" class="border border-primary mt-2 p-4">
                    
                    <!--  -->
                    <label for="questionNumber" class="form-label">Question number : </label>
                    <div class="input-group mb-3">
                        <input value="<?= @$questionNumber ?>" name="questionNumber" type="text" class="form-control">
                        <button class="btn btn-outline-primary" name="search" type="submit">Search</button>
                    </div>
                    
                    <select class="form-select form-select-lg mb-3" name="questionType" >
                        <option <?= isset($questionType) && $questionType=="" ?"selected":"" ?> value="" >Select question type</option>
                        <option <?= @$questionType=="listening"?"selected":"" ?> value="listening">Listening</option>
                        <option <?= @$questionType=="reading"?"selected":"" ?> value="reading">Reading</option>
                    </select>

                    <!--  -->
                    <div class="mt-3">
                        <label for="question" class="form-label">Question : </label>
                        <textarea class="form-control" name="question" id="IdQuestion" rows="5"><?= @$question?></textarea>
                    </div>
                    <!--  -->
                    <div class="input-group mt-3">
                        <div class="input-group-text">
                            <input <?= @$correct =="a"?"checked":"" ?> class="form-check-input mt-0" type="radio" name="isCorrect" value="a"  aria-label="Radio button for following text input">
                        </div>
                        <input value="<?= @$answerA?>" name="answerA" type="text" class="form-control" aria-label="Text input with radio button">
                    </div>
                    <!--  -->
                    <div class="input-group mt-2">
                        <div class="input-group-text">
                            <input <?= @$correct =="b"?"checked":"" ?>  class="form-check-input mt-0" type="radio" name="isCorrect" value="b" aria-label="Radio button for following text input">
                        </div>
                        <input value="<?= @$answerB?>" name="answerB" type="text" class="form-control" aria-label="Text input with radio button">
                    </div>
                    <div class="input-group mt-2">
                        <div class="input-group-text">
                            <input <?= @$correct =="c"?"checked":"" ?>  class="form-check-input mt-0" type="radio" name="isCorrect" value="c" aria-label="Radio button for following text input">
                        </div>
                        <input value="<?= @$answerC?>" name="answerC" type="text" class="form-control" aria-label="Text input with radio button">
                    </div>
                    <div class="input-group mt-2">
                        <div class="input-group-text">
                            <input <?= @$correct =="d"?"checked":"" ?>  class="form-check-input mt-0" type="radio" name="isCorrect" value="d" aria-label="Radio button for following text input">
                        </div>
                        <input value="<?= @$answerD?>" name="answerD" type="text" class="form-control" aria-label="Text input with radio button">
                    </div>
                    <!--  -->
                    <button type="submit" name="add" class="btn btn-success mt-3">Add</button>
                    <button type="submit" name="update" class="btn btn-primary mt-3">Update</button>
                </form>
               </div>
               <div class="col-6">
               <table class="table table-bordered border-primary rounded mt-2">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Question</th>
                        <th>Correct</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                        <?= isset($_GET['testId']) && !empty($_GET['testId']) ? $q->DisplayInTable($_GET['testId']):""; ?>
                    </tbody>
                </table>
               </div>
           </div>
        </div>
    </div>
</div>

<?php include __DIR__."/../inc/inside/footer.php"; ?>