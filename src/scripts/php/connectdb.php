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
