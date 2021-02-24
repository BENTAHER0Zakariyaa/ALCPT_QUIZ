<?php

namespace ALCPT_QUIZ;

  include __DIR__."./classes/Database.php";
  include __DIR__."./classes/Student.php";
  include __DIR__."./classes/Question.php";
  include __DIR__."./classes/Test.php";
  include __DIR__."./classes/Answer.php";
  include __DIR__."./classes/Instructor.php";

  if (isset($_GET['testId']) && !empty(isset($_GET['testId'])) && isset($_GET['studentId']) && !empty(isset($_GET['studentId']))) :
      
  $testId=$_GET['testId']; 
  $studentId=$_GET['studentId']; 
  $s=new Student();
  $t=new Test();
  $q=new Question();
  $a=new Answer();
  $i=new Instructor();
  $messge="";

  if(isset($_POST['end'])):
        unset($_POST['end']);
        // echo "<pre>";
        // print_r($_POST);
        // echo "</pre>";
        $a->addAnswers($_POST,$testId,$studentId);
        header("Location:endOfTheTest.php");
  endif;
  else : 
    header("Location:studentInfo.php");
  endif;


  ?>


  
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="public/lib/bootstrap.css?v=<? echo data()?>">
        <script src="./public/lib/jquery.js"></script>
        <script src="./public/lib/jquery.js"></script>
        <script src="./public/lib/countDown.js"></script>
    <title>ALCPT QUIZ</title>
  </head>
  <body>
    <audio autoplay>
        <source src="./dashboard/<?=$t->getTestAudio($testId) ;?>" type="audio/mpeg">
        <source src="./dashboard/<?=$t->getTestAudio($testId) ;?>" type="audio/mp3">
    </audio>

    <div class="container"> 
<!-- Display the countdown timer in an element -->

<input type="text"  class="fixed-top w-30" id="timer">
<script>
    $(document).ready(function () {
        
        $("#show").hide();
        var param = 1; // Change this if you want more or les than 2 hours
        var today = new Date();
        var newDate = today.setHours(today.getHours() + param);

        $('#timer').countdown(newDate, function(event) {
            if(  $('#timer').val() != "00:00:00")
            {
                $('#timer').val(event.strftime('%H:%M:%S'));
            }
            else{
                $("#hide").hide();
                $("#show").show();
                return;
            }
        });
    });
</script>

        <form class="m-5" action="" method="POST" >
            <div id="show">
                TIME IS OVER !
            </div>
                <div id="hide">
                <h2>Part I - Listening : </h2>
          <?php
            $questions = $q->getAllQuestionsByTestIdAndType($testId,"listening");
            foreach ($questions as $key => $question) { ?>
                <div class="card mb-2">
                    <div class="card-body">
                        <h3 class="card-title"><?= $question->questionNumber ;?>. 
                        <?php
                            $dashes=str_replace("\_","__________",$question->question);
                            $backlane=str_replace("\n","<br>",$dashes);
                            echo $backlane;
                         ?></h3>
                        <p class="card-text">
                        <div class="form-check">
                        A) 
                            <input name="<?= $question->questionNumber ;?>" value="<?= $question->questionId;?>:A" class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault1">
                            <?= $question->answerA ;?>
                            </label>
                        </div>
                        <div class="form-check">
                        B) 
                            <input name="<?= $question->questionNumber ;?>" value="<?= $question->questionId;?>:B" class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault1">
                            <?= $question->answerB ;?>
                            </label>
                        </div>
                        <div class="form-check">
                        C) 
                            <input name="<?= $question->questionNumber ;?>" value="<?= $question->questionId;?>:C" class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault1">
                            <?= $question->answerC ;?>
                            </label>
                        </div>
                        <div class="form-check">
                        D) 
                            <input name="<?= $question->questionNumber ;?>" value="<?= $question->questionId;?>:D" class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault1">
                            <?= $question->answerD ;?>
                            </label>
                        </div>
                        </p>
                    </div>
                </div>
                
            <?php }
          ?>
                 <h2>Part II - Reading : </h2>
          <?php
            $questions = $q->getAllQuestionsByTestIdAndType($testId,"reading");
            foreach ($questions as $key => $question) { ?>
                <div class="card mb-2">
                    <div class="card-body">
                        <h3 class="card-title"><?= $question->questionNumber ;?>. 
                        <?php
                            $dashes=str_replace("\_","__________",$question->question);
                            $backlane=str_replace("\n","<br>",$dashes);
                            echo $backlane;
                         ?></h3>
                        <p class="card-text">
                        <div class="form-check">
                        A) 
                            <input name="<?= $question->questionNumber ;?>" value="<?= $question->questionId;?>:A" class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault1">
                            <?= $question->answerA ;?>
                            </label>
                        </div>
                        <div class="form-check">
                        B) 
                            <input name="<?= $question->questionNumber ;?>" value="<?= $question->questionId;?>:B" class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault1">
                            <?= $question->answerB ;?>
                            </label>
                        </div>
                        <div class="form-check">
                        C) 
                            <input name="<?= $question->questionNumber ;?>" value="<?= $question->questionId;?>:C" class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault1">
                            <?= $question->answerC ;?>
                            </label>
                        </div>
                        <div class="form-check">
                        D) 
                            <input name="<?= $question->questionNumber ;?>" value="<?= $question->questionId;?>:D" class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault1">
                            <?= $question->answerD ;?>
                            </label>
                        </div>
                        </p>
                    </div>
                </div>
                
            <?php }
          ?>
                </div>
          <input name="end" id="IdSubmit" type="submit" value="Finish" class="form-control btn btn-primary">
        </form>
    </div>
  </body>
</html>