<?php
include "class.php";
session_start();
$form=new form;
$_SESSION['formobject']=$form;
header("location:add_participant.php");

/*

holds the object form object in a session to be able to access this object on other pages

*/

?>
