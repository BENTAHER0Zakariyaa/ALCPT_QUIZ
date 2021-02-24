<?PHP
  namespace ALCPT_QUIZ;

  include __DIR__."./classes/Database.php";
  include __DIR__."./classes/Student.php";
  include __DIR__."./classes/Test.php";
  include __DIR__."./classes/Instructor.php";

  $s=new Student();
  $t=new Test();
  $i=new Instructor();
  $messge="";

if(isset($_POST['add'])):
    $data=$_POST;

    $testId = $data["testId"];
    $lastName = $data["lastName"];
    $fistName = $data["fistName"];
    $matricule = $data["matricule"];
    $rank = $data["rank"];
    $service = $data["service"];
    $country = $data["country"];
    $instructorName = $data["instructorName"];
    
    if(empty($testId) && empty($lastName)  && empty($fistName)  && empty($matricule)  && empty($lastName)  && empty($lastName)):
      $messge="<div class=\"alert alert-danger\" role=\"alert\"><b>ERROR</b> : Fields must not be empty!</div>";
    else:
      $id=$s->AddStudent($data);
      header("Location:quiz.php?testId={$testId}&studentId={$id}");
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

    <!-- <audio autoplay>
    <source src="./dashboard/audios/TRAINING_.mp3" type="audio/mpeg">
    <source src="./dashboard/audios/TRAINING_.mp3" type="audio/mp3">
    </audio> -->

    <div class="container"> 
    <?php
      if(!empty($messge)):
          echo "<div class=\"p-2\">{$messge}<div>";
      endif;
    ?>
        <form class="m-5" action="" method="POST" >
          <div class="mb-3">
            <label for="lastName" class="form-label">Last Name : </label>
            <input name="lastName" type="text" class="form-control" id="IdLastName">
          </div>

          <div class="mb-3">
            <label for="fistName" class="form-label">Fist Name : </label>
            <input name="fistName" type="text" class="form-control" id="IdFistName">
          </div>

          <div class="mb-3">
            <label for="matricule" class="form-label">"Matricule" : </label>
            <input name="matricule" type="text" class="form-control" id="IdMatricule">
          </div>

          <div class="mb-3">
            <label for="service" class="form-label">Service : </label>
            <input name="service" type="text" class="form-control" id="IdService">
          </div>

          <select name="rank" class="form-select mb-2" aria-label="Default select example">
            <option selected>Select your rank</option>
            <option value="Eleve sous-officier">Eleve sous-officier</option> 
            <option value="Sergent">Sergent</option> 
            <option value="Sergent-chef">Sergent-chef</option> 
            <option value="Adjudant">Adjudant </option> 
            <option value="Adjudant-chef">Adjudant-chef</option> 
            <option value="Sous-lieutenant">Sous-lieutenant</option> 
            <option value="Lieutenant">Lieutenant</option> 
            <option value="Capitaine">Capitaine</option> 
            <option value="Commandant">Commandant</option> 
            <option value="Lieutenant-colonel">Lieutenant-colonel</option>  
            <option value="Colonel">Colonel</option> 
          </select>

          <div class="form-group mb-2">
          <div class="form-label">Country : </div>
          <label class="form-check-label" for="country">
            <div class="form-check mb-2">
              <input class="form-check-input" value="moroccan" type="radio" name="country" id="IdCountry">
              <label class="form-check-label" for="country">
                Moroccan
              </label>
            </div>
            <div class="form-check mb-2">
            <input class="form-check-input" value="foreign" type="radio" name="country" id="IdCountry">
              <label class="form-check-label" for="country">
                Foreign
              </label>
            </div>  
          </div>
          <hr width="80%">
          <select name="testId" class="form-select mb-2" aria-label="Default select example">
            <option selected>Select test</option>
            <?= $t->DisplayOptionsName(); ?>
          </select>
          <select name="instructorName" class="form-select mb-2" aria-label="Default select example">
            <option selected>Select instructor Name</option>
            <?= $i->DisplayOptionsName(); ?>
          </select>
          <input name="add" id="IdSubmit" type="submit" value="Submit" class="form-control btn btn-primary">
        </form>
    </div>
  </body>
</html>