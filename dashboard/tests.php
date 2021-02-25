<?php

namespace ALCPT_QUIZ;

include __DIR__."/../inc/inside/header.php";
include __DIR__."/../classes/Database.php";
include __DIR__."/../classes/Test.php";
include __DIR__."/../classes/Session.php";

Session::init();

$Login = Session::getValue("login");
if(!$Login):
    header("Location:login.php");
endif;



$t = new Test();
$messge = "";
$path="";

if(isset($_POST['add'])):
  if(!empty($_FILES['fileName']['name'])):
    $path="audios/{$_FILES['fileName']['name']}";
    move_uploaded_file($_FILES['fileName']['tmp_name'], $path);
  else:
    $path="";
  endif;
  if(empty($_POST['testName'])):
    $messge="<div class=\"alert alert-danger\" role=\"alert\"><b>ERROR</b> : Test name field must not be empty!</div>";
    else:
      $t->AddTest($_POST,$path);
  endif;
endif;

if(isset($_POST['update'])):
    if(!empty($_FILES['fileName']['name'])):
      $path="audios/{$_FILES['fileName']['name']}";
      move_uploaded_file($_FILES['fileName']['tmp_name'], $path);
    else:
      $path="";
    endif;
  if(empty($_POST['testId'])):
    $messge="<div class=\"alert alert-danger\" role=\"alert\"><b>ERROR</b> : Select test id to modify!</div>";
    elseif(empty($_POST['testName'])):
    $messge="<div class=\"alert alert-danger\" role=\"alert\"><b>ERROR</b> : Test name field must not be empty to modify!</div>";
  else:
    $t->UpdateTestById($_POST,$path);
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
              
            
              <form action="" method="post" class="border border-primary p-4" enctype="multipart/form-data">
                <div class="mb-3">
                  <label for="testName" class="form-label">Test name : </label>
                  <input name="testName" type="text" class="form-control" id="IdTestName" >
                </div>
                <div class="mb-3">
                  <label for="formFile" class="form-label"></label>
                  <input type="file" name="fileName" class="form-control" >
                </div>
                <input name="add" id="IdAdd" value="Add" type="submit" class="btn btn-primary" >
              </form>


              <br>
              <form id="IdUpdateForm" action="" method="post" class="border border-primary p-4"  enctype="multipart/form-data">
                <select class="form-select form-select-lg mb-3" name="testId" aria-label=".form-select-lg example">
                  <option selected value="" >select id to modify</option>
                  <?= $t->DisplayOptions() ?>
                </select>
                <div class="mb-3">
                    <label for="testName" class="form-label">New test name : </label>
                    <input name="testName" type="text" class="form-control" id="IdTestName">
                </div>
                <div class="mb-3">
                  <label for="formFile" class="form-label"></label>
                  <input type="file" name="fileName" class="form-control" >
                </div>
                <input name="update" id="IdUpdate" value="Update" type="submit" class="btn btn-primary" >
              </form>

            </div>
            <div class="col-6">

            <table class="table table-bordered border-primary rounded">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Tests</th>
                    <th>Audio</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?= $t->Display() ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
    </div>
</div>
<?php include __DIR__."/../inc/inside/footer.php"; ?>