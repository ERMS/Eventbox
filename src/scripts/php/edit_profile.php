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
