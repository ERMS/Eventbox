
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

	session_start();

	$con=connectdb();

	$id=$_POST['uid'];
	$fname=$_POST['first_name'];
	$lname=$_POST['last_name'];
	$email=$_POST['email'];
	$country=$_POST['country'];
	$city=$_POST['city'];

	mysqli_query($con,"UPDATE `user` SET `User_Email`='$email',`User_FirstName`='$fname',`User_LastName`='$lname',`User_Country`='$country',`User_City`='$city' WHERE `User_ID`='$id'");
	
	$query=mysqli_query ($con, "SELECT * FROM `user` WHERE `User_ID`='$id'");
	$user=mysqli_fetch_array($query);

	$_SESSION['user']=array('id'=>$user['User_ID'],'name'=>$user['User_FirstName']." ".$user['User_LastName']);

	/*

	changes the user data on the database to the new user data

	*/

?>
