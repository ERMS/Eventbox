<?php
include "class.php";
$con=connectdb();
$e_id=$_POST['e_id'];
$v=mysqli_query($con,"SELECT * FROM `user` WHERE `User_ID`=(SELECT `User_ID` FROM `event` WHERE `Event_ID`='$e_id')");
$u=mysqli_fetch_array($v);
$user_name=$u['User_FirstName']." ".$u['User_LastName'];
$parts=$_POST['participants'];
$Smail=new mail;											// instantiate the object mail
$Smail->setMail($e_id,$user_name);							// deffining method setMail that generates the message
foreach($parts as $email)									// selects every mail
{
	$Smail->sendMail($email,$e_id);							// sends the generated mail to every selected emails
}
header("location:event_details.php?id=".$e_id);
?>
