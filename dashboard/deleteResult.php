<?php 
namespace ALCPT_QUIZ;

include __DIR__."/../classes/Database.php";
include __DIR__."/../classes/Student.php";
include __DIR__."/../classes/Session.php";

Session::init();

$Login = Session::getValue("login");
if(!$Login):
    header("Location:login.php");
endif;

if(isset($_GET['testId'])):
    if(!empty($_GET['testId'])):
        $s = new Student(); 
        $s->deleteFromTest($_GET['testId']);
        header("Location:results.php");
    endif;
endif;