
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
    $forms=$_SESSION['formobject'];
    $parts=$_SESSION['participantslist'];

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
    
    <!-- navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="../../../index.php"><img src="../../images/eventbox-logo.png" width="175px"/></a>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li class="img-responsive">
                        <img style="padding:5px; margin-top:2px;" class="hidden-xs" src="http://a.deviantart.net/avatars/m/b/mb67.gif?3" width="50px" height="50px">
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION['user']['name']; ?><b class="caret"></b></a>
                      <ul class="dropdown-menu">
                        <li><a href="home.php">Home</a></li>
                        <li><a href="my_event.php">Profile</a></li>
                        <li><a href="#">Settings</a></li>
                        <li class="divider"></li>
                        <li><a href="my_event.php?log=out">Log out</a></li>
                      </ul>
                    </li>
                  </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>
    <!-- end navigation-->
	
    <section class="container event">
        <div class="row">
            <div class="col-md-12">                
                <div class="row"><!--content header-->
                    <div class="col-md-8">
                        <h2>Verify Details <small>Step 4 of 4</small></h2>
                    </div>
                    <div class="col-md-4">
                        <a href="home.php" class="event btn btn-default pull-right">Cancel</a>                        
                    </div>
                </div> <!--end content header-->
                <hr>
            </div>
        
            <div class="col-md-12">
				<!-- event details content -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>Event Details</h4>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-2 text-center">
                                <img src="images/bg1.png" width="150px" height="150px">
                                <?php
                                echo "
                                    <h4> $event->E_title </h4>
                                </div>
                                <div class='col-md-7 text-justified'>
                                    <p><strong> When : </strong>  $event->E_startmonth $event->E_startday, $event->E_startyear - $event->E_endmonth $event->E_endday, $event->E_endyear@ $event->E_starthour:$event->E_startminute $event->E_startch - $event->E_endhour:$event->E_endminute $event->E_endch </p>
                                    
                                    <p><strong> Where : </strong> $event->E_country, $event->E_state, $event->E_street, $event->E_city</p>
                                    <p><strong> Decription : </strong>$event->E_description</p>
                                    <p><strong> Deadline of Registration : </strong> {how}</p>
                                </div>
                                <div class='col-md-3'>
                                    <p><strong> Contact Number : </strong> $event->E_contactnumber </p>
                                    <p>
                                        <strong> slots : </strong> $event->E_slot <br>
                                    </p>
                                    <p><strong> Privacy : </strong> $event->E_privacy </p>";
                                    $date1 = date("Y")."-".date("m")."-".date("d");
                                    $date2 = $event->E_startyear."-".date('m', strtotime($event->E_startmonth))."-".$event->E_startday;
                                    $diff = abs(strtotime($date2) - strtotime($date1));
                                    $years = floor($diff / (365*60*60*24));
                                    $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                                    $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                                    echo "
                                    <p><strong>$date2 Event Status: </strong> $years years, $months months, $days days more to go</p>
                                </div>";
                                ?>
                        </div>
                        
                    </div>
                </div>           
					
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-9">
								<!-- show registration form panel -->
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4>Event Registration Form</h4>
                                    </div>
                                    <div class="panel-body">
                                        <div class="col-md-12 text-center">
                                            <div class="panel panel-default">                                
												<form class="form-horizontal">
                                                	<div class="panel-body" id="form">
												</form>
                                                </div>
                                            </div>                            
                                        </div>
                                    </div>
								<!-- show registration form panel -->
                                </div>
                            </div>
							<!-- show invited participant panel -->
                            <div class="col-md-3">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4>Invited Participant</h4>
                                    </div>
                                    <div class="panel-body">
                                        <div class="text-center">
                                            <?php
                                           $count=1;
                                           foreach ($parts as $value) 
                                           {
                                                echo $count++." ) $value <br>";
                                           }
                                           ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
							<!-- end show invited participant panel -->
                        </div>                        
                    </div>
                </div>
				<!-- end event details content -->
            </div>
				
            <div class="row">
                <div class="col-md-6">
                    <button class="btn btn-default btn-lg pull-right">back</button>
                </div>
                <div class="col-md-6">
                    <a href="notify_participant.php" class="btn btn-success btn-lg">Done</a>
                </div>
            </div>
            <hr>
        </div>        
    </section>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/boostrap.min.js"></script>

    <script>
    
        var formorder=<?php echo $forms->F_order; ?>;
        var count=0;
        
        function generateForm(divName,formElemID,labelName){
            var newdiv = document.createElement('div');
            count++;
            switch(formElemID) {
                  case 'name':
                       newdiv.innerHTML ="<div id='"+divName+count+"'><div class='form-group'><label class='col-md-2 col-md-offset-1 control-label' for='"+formElemID+count+"'><input type='text' id='"+formElemID+count+"' name='"+formElemID+"' style='border:none;background-color:#fff' value='"+labelName+"' disabled></label><div class='col-md-4'><input id='"+formElemID+count+"' type='text' disabled class='form-control' placeholder='First'></div><div class='col-md-4'><input id='"+formElemID+count+"' type='text' disabled class='form-control' placeholder='Last'></div></div></div>";
                       break;

                  case 'date':
                       newdiv.innerHTML ="<div id='"+divName+count+"'><div class='form-group'><label class='col-md-2 col-md-offset-1 control-label' for='"+formElemID+count+"'><input type='text' id='"+formElemID+count+"' name='"+formElemID+"' style='border:none;background-color:#fff' value='"+labelName+"' disabled></label><div class='col-md-4'><input type='text' id='"+formElemID+count+"' name='"+formElemID+"' disabled class='form-control' placeholder='mm'></div><div class='col-md-2'><input  id='"+formElemID+count+"' type='text' disabled class='form-control' placeholder='dd'></div><div class='col-md-2'><input type='text' disabled class='form-control'  id='"+formElemID+count+"' placeholder='yyyy'></div></div></div>";
                       break;
                  case 'email':
                       newdiv.innerHTML = "<div id='"+divName+count+"'><div class='form-group'><label class='col-md-2 col-md-offset-1 control-label' for='"+formElemID+count+"'><input type='text' id='"+formElemID+count+"' name='"+formElemID+"' style='border:none;background-color:#fff' value='"+labelName+"' disabled></label><div class='col-md-8'><input type='email' id='"+formElemID+count+"' disabled class='form-control' placeholder='eventbox@eventbox.com'></div></div></div>";
                       break;
                  case 'address':
                       newdiv.innerHTML = "<div id='"+divName+count+"'><div class='form-group'><label class='col-md-2 col-md-offset-1 control-label' for='"+formElemID+count+"'><input type='text' id='"+formElemID+count+"' name='"+formElemID+"' style='border:none;background-color:#fff' value='"+labelName+"' disabled></label><div class='col-md-4' ><input type='text' id='"+formElemID+count+"' disabled class='form-control' placeholder='Country'><input id='"+formElemID+count+"' type='text' disabled class='form-control event' placeholder='City'></div><div class='col-md-4' ><input id='"+formElemID+count+"' type='text' disabled class='form-control' placeholder='State'><input type='text' id='"+formElemID+count+"' disabled class='form-control event' placeholder='Street'></div></div></div>";
                       break;
                  case 'text':
                       newdiv.innerHTML = "<div id='"+divName+count+"'><div class='form-group'><label class='col-md-2 col-md-offset-1 control-label' for='"+formElemID+count+"'><input type='text' id='"+formElemID+count+"' name='"+formElemID+"' style='border:none;background-color:#fff' value='"+labelName+"' disabled></label><div class='col-md-8'><input type='text' disabled id='"+formElemID+count+"' class='form-control' placeholder='"+labelName+"'></div></div></div>";
                       break;
                  case 'textarea':
                       newdiv.innerHTML = "<div id='"+divName+count+"'><div class='form-group'><label class='col-md-2 col-md-offset-1 control-label' for='"+formElemID+count+"'><input type='text' id='"+formElemID+count+"' name='"+formElemID+"' style='border:none;background-color:#fff' value='"+labelName+"' disabled></label><div class='col-md-8'> <textarea disabled id='"+formElemID+count+"' class='form-control' placeholder='Type Here...'></textarea></div></div></div>";
                       break;
                  case 'link':
                       newdiv.innerHTML = "<div id='"+divName+count+"'><div class='form-group'><label class='col-md-2 col-md-offset-1 control-label' for='"+formElemID+count+"'><input type='text' id='"+formElemID+count+"' name='"+formElemID+"' style='border:none;background-color:#fff' value='"+labelName+"' disabled></label><div class='col-md-8'><input type='text' disabled class='form-control' id='"+formElemID+count+"' placeholder='https://'></div></div></div>";
                       break;
            }
            document.getElementById(divName).appendChild(newdiv);
        }
        window.onload = function() {
            for(var i=0;i<formorder.length;i++)
            {
                generateForm('form',formorder[i][2],formorder[i][0]);

            }
        };

    </script>

</body>
</html>
