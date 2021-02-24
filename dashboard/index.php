<?php 

namespace ALCPT_QUIZ;

include __DIR__."/../classes/Database.php";
include __DIR__."/../inc/inside/header.php"; 
include __DIR__."/../classes/Session.php";

Session::init();

$Login = Session::getValue("login");
  if(!$Login):
    header("Location:login.php");
  endif;
?>

<div class="main">
    <div class="p-5 content-dashboard">
        <div>
          <?php include __DIR__."/../inc/inside/nav.php"; ?>
          <center class="wb"><h1 >WELCOME BACK :) </h1></center>
        </div>
    </div>
</div>

<?php include __DIR__."/../inc/inside/footer.php"; ?>