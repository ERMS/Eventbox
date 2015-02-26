
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

	session_start();

	$user_id=$_SESSION['user']['id'];
	$user_name=$_SESSION['user']['name'];
	$event=$_SESSION['eventobject'];
	$forms=$_SESSION['formobject'];
	$parts=$_SESSION['participantslist'];
	$event->createEvent($user_id);					//	stores the event in the database			
	$event->manageEvent($user_id);					//	keeps the date and time when was the event created
	
	$events=mysqli_query($con,"SELECT * FROM `event` WHERE `User_ID`='$user_id' ORDER BY `Event_ID` DESC LIMIT 1");
	$e=mysqli_fetch_array($events);
	$e_id=$e['Event_ID'];
	$forms->createTableform($user_id,$e_id);		//  stores the generated form
	$Smail=new mail;	
	$Smail->setMail($e_id,$user_name);				//  generate the mail to be send
	
	foreach($parts as $email)						//  select every mail
	{
		$Smail->sendMail($email,$e_id);				//  send mail to every selected mail
	}
	
	unset($_SESSION['eventobject']);				//	
	unset($_SESSION['formobject']);					//	removes the hold data in the sessions
	unset($_SESSION['participantslist']);			//
	header("location:event_details.php?id=".$e_id);	//  shows the created event details
?>
