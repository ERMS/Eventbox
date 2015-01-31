<?php
include "connectdb.php";
$con=connectdb();
$del=json_decode($_GET['deleteEvent'],true);							 // decode the encoded array variable to an array variable
foreach ($del as $value) 
{
	mysqli_query($con,"DELETE FROM `event` WHERE `Event_ID`='$value'");
}
header("location:my_event.php");

/*

deletes every selected event

*/
?>
