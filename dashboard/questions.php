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

    if(empty($questionNumber) || empty($testId) || empty($questionType) || empty($answerA) || empty($answerB) || empty($answerC) || empty($answerD) || empty($correct)):
      
        $messge="<div class=\"alert alert-danger\" role=\"alert\">[ADD] : Fields must not be empty!</div>";
    
      elseif($questionNumber < 0 ):
        $messge="<div class=\"alert alert-danger\" role=\"alert\">[ADD] : Field Question number must be > 0 !</div>";
      
    else :
        $_POST['testId']=$_GET['testId'];
      if($q->addQuestion($_POST)):
        $messge="<div class=\"alert alert-success\" role=\"alert\">[ADD] : Successfully!</div>";
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

    if(empty($questionNumber) || empty($testId) || empty($questionType)  || empty($question) || empty($answerA) || empty($answerB) || empty($answerC) || empty($answerD) || empty($correct)):
      
        $messge="<div class=\"alert alert-danger\" role=\"alert\">[ADD] : Fields must not be empty!</div>";
    
      elseif($questionNumber < 0 ):
        $messge="<div class=\"alert alert-danger\" role=\"alert\">[ADD] : Field Question number must be > 0 !</div>";
      
    else :
        $_POST['testId']=$_GET['testId'];
      if($q->updateQuestion($_POST)):
        $messge="<div class=\"alert alert-success\" role=\"alert\">[ADD] : Successfully!</div>";
      else:
        $messge="<div class=\"alert alert-danger\" role=\"alert\">[ADD] : Question number ({$questionNumber}) existed!</div>";
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
                    <select class="form-select form-select-lg mb-3" name="questionNumber" >
                        <option selected>Select question number</option>
                        <?php 
                            for($i=1; $i <= 100; $i++) { ?>
                                <option value="<?= $i; ?>"> <?= $i; ?> </option>
                            <?php }
                        ?>
                    </select>
                    
                    <select class="form-select form-select-lg mb-3" name="questionType" >
                        <option selected>Select question type</option>
                        <option value="listening">Listening</option>
                        <option value="reading">Reading</option>
                    </select>

                    <!--  -->
                    <div class="mt-3">
                        <label for="question" class="form-label">Question : </label>
                        <textarea class="form-control" name="question" id="IdQuestion" rows="5"></textarea>
                    </div>
                    <!--  -->
                    <div class="input-group mt-3">
                        <div class="input-group-text">
                            <input class="form-check-input mt-0" type="radio" name="isCorrect" value="a"  aria-label="Radio button for following text input">
                        </div>
                        <input name="answerA" type="text" class="form-control" aria-label="Text input with radio button">
                    </div>
                    <!--  -->
                    <div class="input-group mt-2">
                        <div class="input-group-text">
                            <input class="form-check-input mt-0" type="radio" name="isCorrect" value="b" aria-label="Radio button for following text input">
                        </div>
                        <input  name="answerB" type="text" class="form-control" aria-label="Text input with radio button">
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