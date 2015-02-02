
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

	$query=mysqli_query($con,"SELECT `User_Email` FROM `user`");
	$v=0;

	while($data=mysqli_fetch_array($query))                           // stores all the currently registered emails
	{
		$values[$v]=$data['User_Email'];
		$v++;
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Eventbox</title>

    <!-- Boostrap css -->
    <link rel="stylesheet" type="txt/css" href="../../boostrap/css/boostrap.min.css"> 
    <!-- Customize css -->
    <link rel="stylesheet" type="txt/css" href="../../css/style.css">
	
</head>

<body>   
    
    <nav class="navbar navbar-inverse navbar-fixed-top" style="height:100px;" role="navigation">
     <div class="navbar-inner">
            <div class="nav-center navbar-fixed-bottom">
                <a href="search.php"><img src="../../images/eventbox-logo.png"  width="210px;"/></a>
            </div>
        </div>
    </nav>
    

    <section id="login">
        <div class="container">
            <div class="form-wrap">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <h1>Sign Up</h1>
			                    <hr>
                                    <form name="register" role="form" action="registration.php" method="post" onsubmit="return confirmpassword()">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <input type="text" name="first_name" id="first_name" class="form-control" placeholder="First Name" tabindex="1" required>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Last Name" tabindex="2" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-8 col-md-8">
                                                <div class="form-group">
                                                    <input type="text" name="country" id="address" class="form-control" placeholder="Country" tabindex="3" required>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-4 col-md-4">
                                                <div class="form-group">
                                                    <input type="text" name="Address" id="address" class="form-control" placeholder="City" tabindex="3" required>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <input type="email" name="email" id="email" class="form-control" placeholder="Email Address" tabindex="4" required>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <input type="password" name="password" id="password" class="form-control" placeholder="Password" tabindex="5" required>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirm Password" tabindex="6" required>
                                                </div>
                                            </div>
                                        </div>

                                        <hr>
                                        <div class="row" >
                                            <div class="col-xs-12 col-md-6 col-md-6">
                                                <input type="submit" value="Register" style="margin-bottom:10px" class="btn btn-primary btn-block" tabindex="7">
                                            </div>
                                            <div class="col-xs-12 col-md-6 col-md-6">
                                                <a href="login_form.php" class="btn btn-custom btn-block">Sign In</a>
                                            </div>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- /.container -->
<<<<<<< HEAD
	</section>

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="src/scripts/js/boostrap.min.js"></script>

	<script>
		
		var email='<?php echo json_encode($values); ?>';
		
		function checkmail(mail)                                        //  checks whether the email is already in use 
		{
			json=JSON.parse(email);
			for(var i=0;i<json.length;i++)
			{
				if(mail==json[i])
				{
					alert("This E-mail is already Registered!!");
					return false;
				}
			}
		}
		
		function confirmpassword()                                     //  assurance of the password inputed 
		{   
			var mail = document.forms["register"]["email"].value;
			var password = document.forms["register"]["password"].value;
			var password2 = document.forms["register"]["password_confirmation"].value;
			if(checkmail(mail)==false)
			{
				return false;
			}
			if(password != password2)
			{
				alert("Password Does not match!");
				return false;
			}
		}
		
	</script>
        
</body>
