<?php 
namespace ALCPT_QUIZ;

include __DIR__."/../classes/Database.php";
include __DIR__."/../classes/Question.php";
include __DIR__."/../classes/Session.php";

Session::init();

$Login = Session::getValue("login");
if(!$Login):
    header("Location:login.php");
endif;

if(isset($_GET['questionId'])):
    if(!empty($_GET['questionId'])):
        $q = new Question(); 
        $q->deleteQuestionById($_GET['questionId']);
        header("Location:questions.php?testId={$_GET['testId']}");
    endif;
endif;