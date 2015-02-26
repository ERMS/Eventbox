
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
