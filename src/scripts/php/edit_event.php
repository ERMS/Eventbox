
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
	error_reporting(0);
	include "connectdb.php";
	$con=connectdb();
	session_start();

	$user=$_SESSION['user']['id'];
	$id=$_POST['id'];
	$title=$_POST['title'];
	if($_FILES['logo']['size']!=0)
	{
		$logo=base64_encode(file_get_contents($_FILES['logo']['tmp_name']));                 // convert image into binary;
	}
	else
	{
		$query=mysqli_query($con,"SELECT * FROM `event` WHERE `Event_ID`='$id'");
		$data=mysqli_fetch_array($query);
		$logo=$data['Event_Logo'];
	}
	$file=$_POST['file'];
	$s_month=$_POST['s_month'];
	$s_day=$_POST['s_day'];
	$s_year=$_POST['s_year'];
	$e_month=$_POST['e_month'];
	$e_day=$_POST['e_day'];
	$e_year=$_POST['e_year'];
	$s_hour=$_POST['s_hour'];
	$s_minute=$_POST['s_minute'];
	$s_ch=$_POST['s_ch'];
	$e_hour=$_POST['e_hour'];
	$e_minute=$_POST['e_minute'];
	$e_ch=$_POST['e_ch'];
	$description=$_POST['description'];
	$country=$_POST['country'];
	$city=$_POST['city'];
	$street=$_POST['street'];
	$additional=$_POST['additional'];
	$deadline=$_POST['deadline'];
	$slot=$_POST['number'];
	$contact=$_POST['contact'];
	$privacy=$_POST['privacy'];
	$password=$_POST['password'];
	$status=$_POST['status'];



	mysqli_query($con,"UPDATE `event` SET `Event_Title`='$title',`Event_Description`='$description',`Event_ContactNumber`='$contact',`Event_Privacy`='$privacy',`Event_Deadline`='$deadline',`Event_Slot`='$slot',`Event_File`='$file',`Event_Country`='$country',`Event_City`='$city',`Event_Street`='$street',`Event_Additional`='$additional',`Event_Logo`='$logo',`Event_Password`='$password',`Event_StartHour`='$s_hour',`Event_StartMinute`='$s_minute',`Event_StartCH`='$s_ch',`Event_EndHour`='$e_hour',`Event_EndMinute`='$e_minute',`Event_EndCH`='$e_ch',`Event_StartDay`='$s_day',`Event_StartMonth`='$s_month',`Event_StartYear`='$s_year',`Event_EndDay`='$e_day',`Event_EndMonth`='$e_month',`Event_EndYear`='$e_year',`Event_Status`='$status' WHERE `Event_ID`='$id' AND `User_ID`='$user'");

	/*

	changes the event details on the database to the new event datils

	*/

?>
