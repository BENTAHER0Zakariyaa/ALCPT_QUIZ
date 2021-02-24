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
                  <input name="instructorName" type="text" class="form-control" id="IdInstructorName">
                </div>
                <select class="form-select form-select-lg mb-3" name="instructorRank" aria-label=".form-select-lg example">
                  <option selected>Select rank</option>
                  <option value="ESO">ESO</option>
                  <option value="sergent">sergent</option>
                  <option value="colonel">colonel</option>
                  <option value="adjudant">adjudant</option>
                  <option value="capitaine">capitaine</option>
                  <option value="lieutenant">lieutenant</option>
                  <option value="commandant">commandant</option>
                  <option value="sergent-chef">sergent-chef</option>
                  <option value="adjudant-chef">adjudant-chef</option>
                  <option value="sous-lieutenant">sous-lieutenant</option>
                  <option value="lieutenant-colonel">lieutenant-colonel</option>
                </select>
                <input name="add" id="IdAdd" value="Add" type="submit" class="btn btn-primary" >
              </form>

              <form action="" method="post" class="border border-primary mt-2 p-4">

              <select class="form-select form-select-lg mb-3" name="instructorId" aria-label=".form-select-lg example">
                  <option selected>Select id to modify</option>
                  <?= $i->DisplayOptions();?>
                </select>

                <div class="mb-3">
                  <label for="instructorName" class="form-label">Instructor Name : </label>
                  <input name="instructorName" type="text" class="form-control" id="IdInstructorName">
                </div>
                <select class="form-select form-select-lg mb-3" name="instructorRank" aria-label=".form-select-lg example">
                  <option selected>Select rank</option>
                  <option value="ESO">ESO</option>
                  <option value="sergent">sergent</option>
                  <option value="colonel">colonel</option>
                  <option value="adjudant">adjudant</option>
                  <option value="capitaine">capitaine</option>
                  <option value="lieutenant">lieutenant</option>
                  <option value="commandant">commandant</option>
                  <option value="sergent-chef">sergent-chef</option>
                  <option value="adjudant-chef">adjudant-chef</option>
                  <option value="sous-lieutenant">sous-lieutenant</option>
                  <option value="lieutenant-colonel">lieutenant-colonel</option>
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