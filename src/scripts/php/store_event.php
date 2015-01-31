<?php
include "class.php";
session_start();
$event = new event();
$_SESSION['eventobject']=$event;
header("location:registration_form.php");

/*

stores the event object in a session to be accessible in another page

*/
?>
