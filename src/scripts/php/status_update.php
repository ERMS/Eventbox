<?php 
include "class.php";
$con=connectdb();
$status=$_POST['status'];
$ap=new attend;									// instantiate the attend object
if($_POST['respond']=='Approve') 				// depends on the user whether to approve or decline an join request
{
	$ap->approved($status);						// approve the join request/invitation
}
else
{	
	$ap->decline($status);						// decline the join request/invitation
}
?>
