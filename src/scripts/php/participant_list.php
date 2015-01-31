<?php
include "class.php";
session_start();
$parts=$_POST['participants'];
$_SESSION['participantslist']=$parts;
header("location:show_details.php");

/*

stores the invited users email in a session

*/

?>
