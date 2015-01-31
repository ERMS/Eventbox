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
$id=mysqli_query($con,"SELECT `Attendee_ID` FROM `attendance` WHERE `Event_ID`='$e_id' AND `User_ID`='$u_id'");
$a_id=mysqli_fetch_array($id);
$ap=new attend;
$ap->approved($a_id['Attendee_ID']);
header("location:event_details.php?id=".$e_id);

/*

the objects formValue and attend are instantiated
upon creation of the object the passed data are stored after defining the class method
then displays the event details on the next page

*/

?>
