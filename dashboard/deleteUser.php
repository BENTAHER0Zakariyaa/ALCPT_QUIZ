<?php 

namespace ALCPT_QUIZ;

include __DIR__."/../classes/User.php";

Session::init();

$Login = Session::getValue("login");
if(!$Login):
    header("Location:login.php");
endif;

if(isset($_GET['id'])):
    if(!empty($_GET['id'])):
        $u = new User(); 
        if ($u->isExisted($_GET['id'])) :
            $u->DeleteUserById($_GET['id']);
        endif;
        header("Location:users.php");
    endif;
endif;