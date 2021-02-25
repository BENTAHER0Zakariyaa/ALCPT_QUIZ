<?php

namespace ALCPT_QUIZ;

include __DIR__."/../inc/inside/header.php"; 
include __DIR__."/../classes/Database.php";
include __DIR__."/../classes/Instructor.php";
include __DIR__."/../classes/Session.php";

Session::init();

$Login = Session::getValue("login");
if(!$Login):
  header("Location:login.php");
endif;

$i = new Instructor(); 
$messge="";

if(isset($_POST['add'])):
    $instructorName=$_POST['instructorName'];
    $instructorRank=$_POST['instructorRank'];
    if(empty($instructorName) && empty($instructorRank)):
      $messge="<div class=\"alert alert-danger\" role=\"alert\"><b>ERROR</b> : Fields must not be empty!</div>";
    elseif(empty($instructorName)):
      $messge="<div class=\"alert alert-danger\" role=\"alert\"><b>ERROR</b> : Name field must not be empty!</div>";
    elseif(empty($instructorRank)):
      $messge="<div class=\"alert alert-danger\" role=\"alert\"><b>ERROR</b> : Rank field must not be empty!</div>";
    else:
      $i->AddInstructor($_POST);
      $messge="<div class=\"alert alert-success\" role=\"alert\"><b>SUCCESSFULLY</b> The addition process was successful!</div>";
    endif;
endif;
if(isset($_POST['update'])):
    $instructorId=$_POST['instructorId'];
    $instructorName=$_POST['instructorName'];
    $instructorRank=$_POST['instructorRank'];
    if(empty($instructorName) && empty($instructorRank) && empty($instructorId)):
      $messge="<div class=\"alert alert-danger\" role=\"alert\"><b>ERROR</b> : Fields must not be empty!</div>";
    elseif(empty($instructorId)):
      $messge="<div class=\"alert alert-danger\" role=\"alert\"><b>ERROR</b> : Please select an Id!</div>";
    elseif(empty($instructorName)):
      $messge="<div class=\"alert alert-danger\" role=\"alert\"><b>ERROR</b> : Name field must not be empty!</div>";
    elseif(empty($instructorRank)):
      $messge="<div class=\"alert alert-danger\" role=\"alert\"><b>ERROR</b> : Rank field must not be empty!</div>";
    else:
      $i->UpdateInstructorById($_POST);
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
                  <label for="instructorName" class="form-label">Instructor Name : </label>
                  <input value="<?= isset($_POST['add'])?@$instructorName:"" ?>" name="instructorName" type="text" class="form-control" id="IdInstructorName">
                </div>
                <select class="form-select form-select-lg mb-3" name="instructorRank" aria-label=".form-select-lg example">
                  <option <?= isset($_POST['add']) && isset($instructorRank) && $instructorRank=="" ?"selected":"" ?> value="" >Select your rank</option>
                  <option <?= isset($_POST['add']) && isset($instructorRank) && $instructorRank=="eleve sous-officier" ?"selected":"" ?> value="eleve sous-officier">Eleve sous-officier</option> 
                  <option <?= isset($_POST['add']) && isset($instructorRank) && $instructorRank=="eleve officier" ?"selected":"" ?> value="eleve officier">Eleve officier</option> 
                  <option <?= isset($_POST['add']) && isset($instructorRank) && $instructorRank=="sergent" ?"selected":"" ?> value="sergent">Sergent</option> 
                  <option <?= isset($_POST['add']) && isset($instructorRank) && $instructorRank=="sergent-chef" ?"selected":"" ?> value="sergent-chef">Sergent-chef</option> 
                  <option <?= isset($_POST['add']) && isset($instructorRank) && $instructorRank=="adjudant" ?"selected":"" ?> value="adjudant">Adjudant </option> 
                  <option <?= isset($_POST['add']) && isset($instructorRank) && $instructorRank=="adjudant" ?"selected":"" ?> value="adjudant-chef">Adjudant-chef</option> 
                  <option <?= isset($_POST['add']) && isset($instructorRank) && $instructorRank=="sous-lieutenant" ?"selected":"" ?> value="sous-lieutenant">Sous-lieutenant</option> 
                  <option <?= isset($_POST['add']) && isset($instructorRank) && $instructorRank=="lieutenant" ?"selected":"" ?> value="lieutenant">Lieutenant</option> 
                  <option <?= isset($_POST['add']) && isset($instructorRank) && $instructorRank=="capitaine" ?"selected":"" ?> value="capitaine">Capitaine</option> 
                  <option <?= isset($_POST['add']) && isset($instructorRank) && $instructorRank=="commandant" ?"selected":"" ?> value="commandant">Commandant</option> 
                  <option <?= isset($_POST['add']) && isset($instructorRank) && $instructorRank=="lieutenant-colonel" ?"selected":"" ?> value="lieutenant-colonel">Lieutenant-colonel</option>  
                  <option <?= isset($_POST['add']) && isset($instructorRank) && $instructorRank=="colonel" ?"selected":"" ?> value="colonel">Colonel</option> 
                  <option <?= isset($_POST['add']) && isset($instructorRank) && $instructorRank=="colonel major" ?"selected":"" ?> value="colonel major">Colonel major</option> 
                </select>
                <input name="add" id="IdAdd" value="Add" type="submit" class="btn btn-primary" >
              </form>

              <form action="" method="post" class="border border-primary mt-2 p-4">

              <select class="form-select form-select-lg mb-3" name="instructorId" aria-label=".form-select-lg example">
                  <option value="" selected >Select id to modify</option>
                  <?= $i->DisplayOptions();?>
                </select>

                <div class="mb-3">
                  <label for="instructorName" class="form-label">Instructor Name : </label>
                  <input value="<?= isset($_POST['update'])?@$instructorName:"" ?>" name="instructorName" type="text" class="form-control" id="IdInstructorName">
                </div>
                <select class="form-select form-select-lg mb-3" name="instructorRank" aria-label=".form-select-lg example">
                  <option <?= isset($_POST['update']) && isset($instructorRank) && $instructorRank=="" ?"selected":"" ?> value="" >Select your rank</option>
                  <option <?= isset($_POST['update']) && isset($instructorRank) && $instructorRank=="eleve sous-officier" ?"selected":"" ?> value="eleve sous-officier">Eleve sous-officier</option> 
                  <option <?= isset($_POST['update']) && isset($instructorRank) && $instructorRank=="eleve officier" ?"selected":"" ?> value="eleve officier">Eleve officier</option> 
                  <option <?= isset($_POST['update']) && isset($instructorRank) && $instructorRank=="sergent" ?"selected":"" ?> value="sergent">Sergent</option> 
                  <option <?= isset($_POST['update']) && isset($instructorRank) && $instructorRank=="sergent-chef" ?"selected":"" ?> value="sergent-chef">Sergent-chef</option> 
                  <option <?= isset($_POST['update']) && isset($instructorRank) && $instructorRank=="adjudant" ?"selected":"" ?> value="adjudant">Adjudant </option> 
                  <option <?= isset($_POST['update']) && isset($instructorRank) && $instructorRank=="adjudant" ?"selected":"" ?> value="adjudant-chef">Adjudant-chef</option> 
                  <option <?= isset($_POST['update']) && isset($instructorRank) && $instructorRank=="sous-lieutenant" ?"selected":"" ?> value="sous-lieutenant">Sous-lieutenant</option> 
                  <option <?= isset($_POST['update']) && isset($instructorRank) && $instructorRank=="lieutenant" ?"selected":"" ?> value="lieutenant">Lieutenant</option> 
                  <option <?= isset($_POST['update']) && isset($instructorRank) && $instructorRank=="capitaine" ?"selected":"" ?> value="capitaine">Capitaine</option> 
                  <option <?= isset($_POST['update']) && isset($instructorRank) && $instructorRank=="commandant" ?"selected":"" ?> value="commandant">Commandant</option> 
                  <option <?= isset($_POST['update']) && isset($instructorRank) && $instructorRank=="lieutenant-colonel" ?"selected":"" ?> value="lieutenant-colonel">Lieutenant-colonel</option>  
                  <option <?= isset($_POST['update']) && isset($instructorRank) && $instructorRank=="colonel" ?"selected":"" ?> value="colonel">Colonel</option> 
                  <option <?= isset($_POST['update']) && isset($instructorRank) && $instructorRank=="colonel major" ?"selected":"" ?> value="colonel major">Colonel major</option> 
                </select>
                <input name="update" id="IdUpdate" value="Update" type="submit" class="btn btn-primary" >
              </form>

            </div>
            <div class="col-6">
            <table class="table table-bordered border-primary rounded">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Rank</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?= $i->Display(); ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
    </div>
</div>
<?php include __DIR__."/../inc/inside/footer.php"; ?>