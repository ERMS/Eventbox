<?php
include "class.php";
session_start();
$con=connectdb();
$u_id=$_SESSION['user']['id'];
$f_id=$_GET['formid'];
$formV=new formValue;
$formV->registerFormValue($u_id,$f_id);
$event=mysqli_query($con,"SELECT `Event_ID` FROM `form` WHERE `Form_ID`='$f_id'");
$eventid=mysqli_fetch_array($event);
$e_id=$eventid['Event_ID'];
$part=new attend;
$part->request($u_id,$e_id);
header("location:event_details.php?id=".$e_id);

/*

stores the data for the generated form of an event by the user
sends request to join an event 

*/

?>
