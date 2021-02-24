<?php 

namespace ALCPT_QUIZ;


include __DIR__."/../inc/inside/header.php"; 
include __DIR__."/../classes/Database.php";
include __DIR__."/../classes/Session.php";
include __DIR__."/../classes/Test.php";

Session::init();

$Login = Session::getValue("login");
if(!$Login):
header("Location:login.php");
endif;

$t = new Test();
$messge="";

?>
    
<div class="main">
    <div class="p-5 content-dashboard">
        <div class="">
          <?php include __DIR__."/../inc/inside/nav.php"; ?>
          <div class="list-group mt-2">
            <a class="list-group-item active" aria-current="true">Choose test</a>
            <?= $t->DisplayTests() ;?>
          </div>
        </div>
    </div>
</div>

<?php include __DIR__."/../inc/inside/footer.php"; ?>