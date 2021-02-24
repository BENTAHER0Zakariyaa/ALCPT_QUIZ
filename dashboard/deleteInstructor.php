<?php 
namespace ALCPT_QUIZ;

include __DIR__."/../classes/Instructor.php";
include __DIR__."/../classes/Session.php";

Session::init();

$Login = Session::getValue("login");
if(!$Login):
    header("Location:login.php");
endif;

if(isset($_GET['instructorId'])):
    if(!empty($_GET['instructorId'])):
        $i = new Instructor(); 
        $i->deleteInstructorById($_GET['instructorId']);
        header("Location:instructors.php");
    endif;
endif;