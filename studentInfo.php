<?PHP
  namespace ALCPT_QUIZ;


include __DIR__."./classes/Database.php";
  include __DIR__."./classes/Student.php";
  include __DIR__."./classes/Test.php";
  include __DIR__."./classes/Instructor.php";
  include __DIR__."./classes/Cookie.php";

  $s=new Student();
  $t=new Test();
  $i=new Instructor();
  $messge="";

  if(!empty(@Cookie::getCookie("testId")) && !empty(@Cookie::getCookie("studentId"))):
    header("Location:quiz.php");
  endif;
  
if(isset($_POST['add'])):

    $lastName = $_POST["lastName"];
    $firstName = $_POST["firstName"];
    $matricule = $_POST["matricule"];
    $service = $_POST["service"];
    $rank = $_POST["rank"];
    $country = $_POST["country"];
    $testId = $_POST["testId"];
    $instructorName = $_POST["instructorName"];
    
    if(empty($testId) && empty($lastName)  && empty($firstName)  && empty($matricule)  && empty($lastName)  && empty($lastName)):
    $messge="<div class=\"alert alert-danger\" role=\"alert\"><b>ERROR</b> : Fields must not be empty!</div>"; 
    elseif(empty($lastName)):
      $messge="<div class=\"alert alert-danger\" role=\"alert\"><b>ERROR</b> : Field last name must not be empty!</div>"; 
    elseif(empty($firstName)):
      $messge="<div class=\"alert alert-danger\" role=\"alert\"><b>ERROR</b> : Field first name not be empty!</div>"; 
    elseif(empty($matricule)):
      $messge="<div class=\"alert alert-danger\" role=\"alert\"><b>ERROR</b> : Field matricule must not be empty!</div>"; 
    elseif(empty($service)):
      $messge="<div class=\"alert alert-danger\" role=\"alert\"><b>ERROR</b> : Field service must not be empty!</div>"; 
    elseif(empty($rank)):
      $messge="<div class=\"alert alert-danger\" role=\"alert\"><b>ERROR</b> : Select your rank</div>"; 
    elseif(empty($country)):
    $messge="<div class=\"alert alert-danger\" role=\"alert\"><b>ERROR</b> : Select your country</div>"; 
    elseif(empty($instructorName)):
      $messge="<div class=\"alert alert-danger\" role=\"alert\"><b>ERROR</b> : Select instructor name!</div>"; 
    elseif(empty($instructorName)):
      $messge="<div class=\"alert alert-danger\" role=\"alert\"><b>ERROR</b> : Select instructor name!</div>"; 
    else:
      $test = $s->AddStudent($_POST);
      if ($test == true) :
        header("Location:quiz.php");
      elseif($test == false):
          $messge="<div class=\"alert alert-danger\" role=\"alert\"><b>ERROR</b> : You have already skipped this test!</div>"; 
      endif;
     endif;
endif;

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="public/lib/bootstrap.css?v=<? echo data()?>">
        <link rel="stylesheet" href="public/lib/bootstrap.js">
    <title>ALCPT QUIZ</title>
  </head>
  <body>

    <div class="container"> 
    <?php
      if(!empty($messge)):
          echo "<div class=\"p-2\">{$messge}<div>";
      endif;
    ?>
        <form class="m-5" action="" method="POST" >
          <div class="mb-3">
            <label for="lastName" class="form-label">Last Name : </label>
            <input name="lastName" value="<?= @$lastName ?>" type="text" class="form-control" id="IdLastName">
          </div>

          <div class="mb-3">
            <label for="firstName" class="form-label">First Name : </label>
            <input name="firstName" value="<?= @$firstName ?>" type="text" class="form-control" id="IdFirstName">
          </div>

          <div class="mb-3">
            <label for="matricule" class="form-label">SCN : </label>
            <input name="matricule" value="<?= @$matricule ?>" type="text" class="form-control" id="IdMatricule">
          </div>

          <div class="mb-3">
            <label for="service" class="form-label">Service : </label>
            <input name="service" type="text" value="<?= @$service ?>" class="form-control" id="IdService">
          </div>

          <select name="rank" class="form-select mb-2" aria-label="Default select example">
            <option <?= isset($rank) && $rank=="" ?"selected":"" ?> value="" >Select your rank</option>
            <option <?= isset($rank) && $rank=="eleve sous-officier" ?"selected":"" ?> value="eleve sous-officier">Eleve sous-officier</option> 
            <option <?= isset($rank) && $rank=="eleve officier" ?"selected":"" ?> value="eleve officier">Eleve officier</option> 
            <option <?= isset($rank) && $rank=="sergent" ?"selected":"" ?> value="sergent">Sergent</option> 
            <option <?= isset($rank) && $rank=="sergent-chef" ?"selected":"" ?> value="sergent-chef">Sergent-chef</option> 
            <option <?= isset($rank) && $rank=="adjudant" ?"selected":"" ?> value="adjudant">Adjudant </option> 
            <option <?= isset($rank) && $rank=="adjudant" ?"selected":"" ?> value="adjudant-chef">Adjudant-chef</option> 
            <option <?= isset($rank) && $rank=="sous-lieutenant" ?"selected":"" ?> value="sous-lieutenant">Sous-lieutenant</option> 
            <option <?= isset($rank) && $rank=="lieutenant" ?"selected":"" ?> value="lieutenant">Lieutenant</option> 
            <option <?= isset($rank) && $rank=="capitaine" ?"selected":"" ?> value="capitaine">Capitaine</option> 
            <option <?= isset($rank) && $rank=="commandant" ?"selected":"" ?> value="commandant">Commandant</option> 
            <option <?= isset($rank) && $rank=="lieutenant-colonel" ?"selected":"" ?> value="lieutenant-colonel">Lieutenant-colonel</option>  
            <option <?= isset($rank) && $rank=="colonel" ?"selected":"" ?> value="colonel">Colonel</option> 
            <option <?= isset($rank) && $rank=="colonel major" ?"selected":"" ?> value="colonel major">Colonel major</option> 
          </select>

          <select name="country" class="form-select mb-2" aria-label="Default select example">
            <option selected value="" >Select your Origins</option>
            <option <?= isset($rank) && $country=="moroccan" ?"selected":"" ?> value="moroccan">Moroccan</option> 
            <option <?= isset($rank) && $country=="foreign" ?"selected":"" ?> value="foreign">Foreign</option> 
          </select>

          <hr width="80%">

          <select name="testId" class="form-select mb-2" aria-label="Default select example">
            <option value="" selected >Select test</option>
            <?= $t->DisplayOptionsName(); ?>
          </select>

          <select name="instructorName" class="form-select mb-2" aria-label="Default select example">
            <option value="" selected >Select instructor Name</option>
            <?= $i->DisplayOptionsName(); ?>
          </select>

          <input name="add" id="IdSubmit" type="submit" value="Start" class="form-control btn btn-primary">
        </form>
    </div>
  </body>
</html>