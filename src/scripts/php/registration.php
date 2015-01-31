<?php
include "class.php";

$user = new user;
$user->RegisterAccount();
header("location:login_form.php");

/*

stores the user data to the database 

*/

?>
