<?php

namespace ALCPT_QUIZ;

include __DIR__."/../inc/inside/header.php"; 
include __DIR__."/../classes/User.php";

$u = new User(); 
$messge="";
Session::init();
Session::destroy();

if(isset($_POST['login'])):
    $userName=$_POST['userName'];
    $userPassword=$_POST['userPassword'];
    if(empty($userName) && empty($userPassword)):
      $messge="<div class=\"alert alert-danger\" role=\"alert\"><b>ERROR</b> : Fields must not be empty!</div>";
    elseif(empty($userName)):
      $messge="<div class=\"alert alert-danger\" role=\"alert\"><b>ERROR</b> : User name field must not be empty!</div>";
    elseif(empty($userPassword)):
      $messge="<div class=\"alert alert-danger\" role=\"alert\"><b>ERROR</b> : Password field must not be empty!</div>";
    else:
      $log = $u->userLogin($_POST);
      if($log==1):
        $messge="<div class=\"alert alert-danger\" role=\"alert\"><b>ERROR</b> : This user name not exist!</div>";
      elseif($log==2):
        $messge="<div class=\"alert alert-danger\" role=\"alert\"><b>ERROR</b> : The password is incorrect!</div>";
      endif;
    endif;
endif;

?>

<div class="main">
    <?php
      if(!empty($messge)):
          echo "<div class=\"p-2\">{$messge}<div>";
      endif;
    ?>
    <div class="content">
        <h1 ><span class="badge bg-primary">Administrator</span></h1>
        <form class="p-4 border border-primary rounded" action="" method="POST">
            <div class="mb-3">
                <label for="userName" class="form-label">User name : </label>
                <input name="userName" id="IdUserName" type="text" class="form-control">
            </div>
            <div class="mb-3">
                <label for="userPassword" class="form-label">Password : </label>
                <input name="userPassword" id="IdUserPassword" type="password" class="form-control">
            </div>
            <div class="">
                <input name="login" id="IdLogin" type="submit" value="Login" class="form-control btn btn-primary">
            </div>
        </form>
    </div>
</div>

<?php include __DIR__."/../inc/inside/footer.php"; ?>