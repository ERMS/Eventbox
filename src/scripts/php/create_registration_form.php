
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

	$form=new form;
	$_SESSION['formobject']=$form;
	
	header("location:add_participant.php");

    /*

    holds the object form object in a session to be able to access this object on other pages

    */

?>
