
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
