
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

    if (!isset($_SESSION['user']))
    {
        header("location:login_form.php");
    }
    
    $event=$_SESSION['eventobject'];
    $limit=$event->E_slot;

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

    <!--navigation-->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="home.php"><img src="../../images/eventbox-logo.png" width="175px"/></a>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li class="img-responsive">
                    <?php
                        if($_SESSION['user']['pic']!=NULL)
                        {
                            echo "<img style='padding:5px; margin-top:2px;' class='hidden-xs' src='data:;base64,".$_SESSION['user']['pic']."' width='50px' height='50px'>";
                        }
                        else
                        {
                            echo "<img style='padding:5px; margin-top:2px;' class='hidden-xs' src='../../images/user.png' width='50px' height='50px'>";
                        }
                    ?>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION['user']['name']; ?><b class="caret"></b></a>
                      <ul class="dropdown-menu">
                        <li><a href="home.php">Home</a></li>
                        <li><a href="my_event.php">Profile</a></li>
                        <li class="divider"></li>
                        <li><a href="my_event.php?log=out">Log out</a></li>
                      </ul>
                    </li>
                  </ul>
            </div>
        </div>
    </nav> 
    <!-- /navigation-->
	
	
    <div class="container event">
        <div class="row">
            <div class="col-md-12">                
                <div class="row"><!--content header-->
                    <div class="col-md-8">
                        <h2>Invite Participant <small>Step 3 of 4</small></h2>
                    </div>
                    <div class="col-md-4">
                        <a href="my_event.php" class="event btn btn-default pull-right">Cancel</a>                        
                    </div>
                </div> <!--end content header-->
                <hr>
            </div>        
            <div class="row">
                <div class="col-md-12">                
                <div class="col-md-9">
                    <div class="row event">                        
                        <div class="col-md-10 col-md-offset-3 text-center">
                            <div class="panel panel-default">                                
                                <div class="panel-header"><h3>Participant Email</h3></div>
                                <hr>
                                <div class="panel-body">
									<!-- add participant form -->
                                    <form name="add" id="add" role="form" method="POST" action="participant_List.php">
                                        <div class="row">
                                            <div class="col-md-10 col-md-offset-1" id="participants">
                                                <label for="participant1" class="sr-only">Email</label>
                                                <input type="text" id="participant1" name="participants[]" class="form-control" placeholder="eventbox@eventbox.com">
                                            </div>
                                        </div>
                                        <input type="button" form="" class="btn btn-default event center-block" value="Add Participant" onclick="addpart('participants')">
                                    </form>
									<!-- end add participant form -->
                                </div>
                            </div>                            
                        </div>
                    </div>
                </div>
                </div>                       
            </div>
            <hr>
			
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-4">
                        <a href="registration_form.php" class="btn btn-primary btn-lg pull-right">back</a>
                    </div>
                    <div class="col-md-1 col-md-offset-3">
                        <button form="add" type="submit" class="btn btn-success btn-lg">Next</button>
                    </div>
                    <div class="col-md-1">
                        <a href="show_details.php" class="btn btn-danger btn-lg pull-left">skip</a>
                    </div>                    
                </div>
            </div>
			
            <hr>
        </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/boostrap.min.js"></script>

    <script>
    
        var counter = 1;
        var limit = '<?php echo $limit; ?>';
        
        function addpart(divName)
        {
            if(limit!='')
            {
                if (counter == limit)  
                {
                    alert("You have reached the limit of adding " + counter + " inputs");
                    return;
                }
            }
            var newdiv = document.createElement('div');
            newdiv.innerHTML = "<br><input type='text' placeholder='eventbox@eventbox.com' class='form-control' name='participants[]'>";
            document.getElementById(divName).appendChild(newdiv);
            counter++;
        }

    </script>

</body>
</html>
