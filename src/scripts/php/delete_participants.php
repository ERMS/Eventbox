<?php
include "connectdb.php";
$con=connectdb();
$del=json_decode($_GET['deleteP'],true);							// decodes the encoded array varible to an array variable
$id=$_GET['id'];
foreach ($del as $value) 
{
	mysqli_query($con,"DELETE FROM `attendance` WHERE `Attendee_ID`='$value'");
}
header("location:event_details.php?id=".$id);

/*

deletes all the selected participants on an event

*/
?>
