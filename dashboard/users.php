<?php

namespace ALCPT_QUIZ;

include __DIR__."/../inc/inside/header.php"; 
include __DIR__."/../classes/User.php";

Session::init();

$Login = Session::getValue("login");
if(!$Login):
  header("Location:login.php");
endif;

$u = new User(); 
$messge="";

if(isset($_POST['add'])):
    $userName=$_POST['userName'];
    $userPassword=$_POST['userPassword'];
    if(empty($userName) && empty($userPassword)):
      $messge="<div class=\"alert alert-danger\" role=\"alert\"><b>ERROR</b> : Fields must not be empty!</div>";
    elseif(empty($userName)):
      $messge="<div class=\"alert alert-danger\" role=\"alert\"><b>ERROR</b> : User name field must not be empty!</div>";
    elseif(empty($userPassword)):
      $messge="<div class=\"alert alert-danger\" role=\"alert\"><b>ERROR</b> : Password field must not be empty!</div>";
    else:
      $u->AddUser($_POST);
      $messge="<div class=\"alert alert-success\" role=\"alert\"><b>SUCCESSFULLY</b> The addition process was successful!</div>";
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
        <div class="">
          <?php include __DIR__."/../inc/inside/nav.php"; ?>
          
          <div class="row mt-2">
            <div class="col-6">

              <form action="" method="post" class="border border-primary p-4">
                <div class="mb-3">
                  <label for="userName" class="form-label">User Name : </label>
                  <input name="userName" type="text" class="form-control" id="IdUserName" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                  <label for="userPassword" class="form-label">Password : </label>
                  <input name="userPassword" type="password" class="form-control" id="IdUserPassword">
                </div>
                <input name="add" id="IdAdd" value="Add" type="submit" class="btn btn-primary" >
              </form>

            </div>
            <div class="col-6">
            <table class="table table-bordered border-primary rounded">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Users name</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?= $u->Display() ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
    </div>
</div>
<?php include __DIR__."/../inc/inside/footer.php"; ?>