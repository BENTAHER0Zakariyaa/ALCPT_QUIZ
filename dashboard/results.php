<?php

namespace ALCPT_QUIZ;

include __DIR__."/../inc/inside/header.php"; 
include __DIR__."/../classes/Database.php";
include __DIR__."/../classes/Result.php";
include __DIR__."/../classes/Test.php";
include __DIR__."/../classes/Session.php";

Session::init();
$t = new Test();
$r = new Result();
$Login = Session::getValue("login");
if(!$Login):
  header("Location:login.php");
endif;

if(isset($_POST['show'])):
    if(empty($_POST['testId'])):
      $messge="<div class=\"alert alert-danger\" role=\"alert\">[ADD] : Please select test!</div>";
      $table="";
    else : 
      $table = $r->showResult($_POST['testId']);
      setcookie('testId', $_POST['testId'],  time()+60);
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
        <div class="m-5" >
          <?php include __DIR__."/../inc/inside/nav.php"; ?>
          <form action="" method="post" class="border border-primary p-4">
            <select name="testId" class="form-select mb-2" aria-label="Default select example">
              <option value="" selected>Select test</option>
              <?= $t->DisplayOptionsName(); ?>
            </select>
            <input name="show" id="IdShow" value="Show" type="submit" class="btn btn-primary" >
          </form>
          <div >
            <?php echo empty($table)?"": $table;?>
          </div>
        </div>
    </div>
</div>
<?php include __DIR__."/../inc/inside/footer.php"; ?>