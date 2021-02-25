<?php

namespace ALCPT_QUIZ;

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

header('Content-Type:application/xls');
header('Content-Disposition:attachment;filename=result.xls');

echo $r->export($_COOKIE['testId']);


header("Location:results.php");

?>