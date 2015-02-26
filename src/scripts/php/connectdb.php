
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

function connectdb (){

	$con=mysqli_connect("localhost", "root", "", "eventregistrationdb");
	
	if (mysqli_connect_errno($con)){
		//$err=mysqli_connect_error();
		//echo "ERROR:".$err."<br>"; 
		exit ("Failed to connect!! <br>");
	}
	else {
		return $con;
	}
}

/*

this function connects to the 'eventregistrationdb' database

*/

?>
