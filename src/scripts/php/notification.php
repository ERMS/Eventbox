
<!--   
    This file is part of Eventbox.

    Eventbox is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    Eventbox is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with Eventbox. If not, see <http://www.gnu.org/licenses/>.
-->

<?php

	include "class.php";

	$con=connectdb();

	$e_id=$_POST['e_id'];
	$v=mysqli_query($con,"SELECT * FROM `user` WHERE `User_ID`=(SELECT `User_ID` FROM `event` WHERE `Event_ID`='$e_id')");
	$u=mysqli_fetch_array($v);

	$user_name=$u['User_FirstName']." ".$u['User_LastName'];
	$parts=$_POST['participants'];
	$Smail=new mail;											// instantiate the object mail
	$Smail->setMail($e_id,$user_name);	                        // deffining method setMail that generates the message
	foreach($parts as $email)									// selects every mail
	{
		$Smail->sendMail($email,$e_id);							// sends the generated mail to every selected emails
	}
	
	header("location:event_details.php?id=".$e_id);

?>
