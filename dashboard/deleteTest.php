<?php 

namespace ALCPT_QUIZ;

include __DIR__."/../classes/Database.php";
include __DIR__."/../classes/Test.php";
include __DIR__."/../classes/Session.php";

Session::init();

$Login = Session::getValue("login");
if(!$Login):
    header("Location:login.php");
endif;

if(isset($_GET['id'])):
    if(!empty($_GET['id'])):
        $t = new Test(); 
        if ($t->isExisted($_GET['id'])) :
            $t->DeleteTestById($_GET['id']);
        endif;
        header("Location:tests.php");
    endif;
endif;