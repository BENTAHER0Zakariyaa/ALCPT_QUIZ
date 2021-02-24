<?php 

namespace ALCPT_QUIZ;

include __DIR__."/../classes/Database.php";
include __DIR__."/../classes/Test.php";
include __DIR__."/../classes/Session.php";

Session::init();

$Login = Session::getValue("login");
if($Login):
    Session::destroy();
    header("Location:login.php");
endif;