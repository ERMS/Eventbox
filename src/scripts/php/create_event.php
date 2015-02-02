
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

	session_start();

	date_default_timezone_set('Asia/Manila');

	if (!isset($_SESSION['user']))
	{
		header("location:login_form.php");
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

    <!-- start navigation -->
      <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation"><!-- /navigation -->
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
            </div>
        </div>
    </nav>
    <!-- /navigation-->  
  
	<section id="create">
    <div class="container">
        <div class="row"><!--content header-->
            <div class="col-md-4">
                <h2>Create Event <small>Step 1 of 4</small></h2>
            </div>
            <div class="col-md-1 col-md-offset-7">
                <a href="home.php"class="event btn btn-default btn-block">Cancel</a>
            </div>
        </div> <!--end content header-->
        <hr>
        <!-- content body row -->
        <div class="row">
            <div class="col-md-12">
				<!-- start create event form -->
                <form role="form" action="store_event.php" method="post" onsubmit="return verify()"> 
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4>Event Details</h4>
                        </div>
                        <div class="panel-body">
                            <div class="row"> 
                                <!-- first row event details -->
                                <div class="form-group">
                                    <div class="col-sm-8 col-md-6">
                                        <label for="title" class="" >Event Title</label>
                                        <input type="text" class="form-control" id="title" name="title" placeholder="Event Name" required>
                                    </div>
                                    <div class="col-sm-2 col-md-2">
                                        <label for="logo">Event Logo</label>
                                        <input type="file" id="logo" name="logo">
                                    </div>  
                                </div>
                            </div> <!--end first row event details -->
                            <div class="row"> <!-- start event date&time row -->
                                <div class="col-md-6"> <!-- start event date container  -->
                                    <div class="col-md-12"> <!-- start event date:From container  -->
                                        <div class="form-group">                                                   
                                            <div class="row">
                                                <label for="eventdate" class="col-sm-1 col-md-1">From</label>
                                                <div class="col-sm-5 col-md-5">                                                        
                                                    <select name="startmonth" id="eventdate" class="form-control input-sm">
                                                        <?php
                                                            for ($i=1; $i <= 12; $i++) 
                                                            { 
                                                                $month=mktime(0,0,0,$i,1,0);
                                                                if(date("F")==date("F", $month))
                                                                {
                                                                    echo "<option value='".date("F", $month)."' selected>".date("F", $month)."</option>";
                                                                }
                                                                else
                                                                {
                                                                    echo "<option value='".date("F", $month)."'>".date("F", $month)."</option>";
                                                                }    
                                                            }
                                                         ?>
                                                    </select>   
                                                </div>
                                                <div class="col-sm-3 col-md-3">
                                                    <select  name="startday" class="form-control input-sm">
                                                        <?php
                                                            for ($i=1; $i <=date("t") ; $i++) 
                                                            {
                                                                $day=mktime(0,0,0,0,$i,0);
                                                                if(date("d")==date("d", $day))
                                                                {
                                                                    echo "<option value='".date("d",$day)."' selected>".date("d", $day)."</option>";
                                                                }
                                                                else
                                                                {
                                                                    echo "<option value='".date("d",$day)."'>".date("d", $day)."</option>";
                                                                }
                                                            }
                                                        ?>
                                                    </select>   
                                                </div>
                                                <div class="col-sm-3 col-md-3">
                                                    <select name="startyear" id="eventdate" class="form-control year input-sm">
                                                        <?php
                                                            for ($i=date("Y"); $i <(date("Y")+10); $i++) 
                                                            { 
                                                                $year=mktime(0,0,0,0,0,$i);
                                                                if(date("Y")==date("Y",$year))
                                                                {
                                                                    echo "<option value='".date("Y",$year)."' selected>".date("Y",$year)."</option>";
                                                                }
                                                                else
                                                                {
                                                                    echo "<option value='".date("Y",$year)."'>".date("Y",$year)."</option>";   
                                                                }
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">   
                                            <div class="row">
                                                <label for="eventdate" align="center" class="col-sm-1 col-md-1">Until</label>
                                                <div class="col-sm-5 col-md-5">                                                        
                                                    <select name="endmonth" id="eventdate" class="form-control input-sm">
                                                        <?php
                                                            for ($i=1; $i <= 12; $i++) 
                                                            { 
                                                                $month=mktime(0,0,0, $i);
                                                                if(date("F")==date("F", $month))
                                                                {
                                                                    echo "<option value='".date("F", $month)."' selected>".date("F", $month)."</option>";
                                                                }
                                                                else
                                                                {
                                                                    echo "<option value='".date("F", $month)."'>".date("F", $month)."</option>";
                                                                }    
                                                            }
                                                         ?>
                                                    </select>   
                                                </div>
                                                <div class="col-sm-3 col-md-3">
                                                    <select  name="endday" class="form-control input-sm">
                                                        <?php
                                                            for ($i=1; $i <=date("t") ; $i++) 
                                                            {
                                                                $day=mktime(0,0,0,0,$i);
                                                                if(date("d")==date("d", $day))
                                                                {
                                                                    echo "<option value='".date("d",$day)."' selected>".date("d", $day)."</option>";
                                                                }
                                                                else
                                                                {
                                                                    echo "<option value='".date("d",$day)."'>".date("d", $day)."</option>";
                                                                }
                                                            }
                                                        ?>
                                                    </select>   
                                                </div>
                                                <div class="col-sm-3 col-md-3">
                                                    <select name="endyear" id="eventdate" class="form-control year input-sm">
                                                        <?php
                                                            for ($i=date("Y"); $i <(date("Y")+10); $i++) 
                                                            { 
                                                                $year=mktime(0,0,0,0,0,$i);
                                                                if(date("Y")==date("Y",$year))
                                                                {
                                                                    echo "<option value='".date("Y",$year)."' selected>".date("Y",$year)."</option>";
                                                                }
                                                                else
                                                                {
                                                                    echo "<option value='".date("Y",$year)."'>".date("Y",$year)."</option>";   
                                                                }
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--time time container-->
                                <div class="col-md-6">
                                    <div class="col-md-12">
                                        <!--start: time input-->
                                        <div class="form-group">
                                            <div class="row">
                                                <label for="eventdate" class="col-sm-1 col-md-1">Start</label>
                                                <div class="col-sm-3 col-md-3">
                                                    <input type="number" max="12" min="01" name="starthour" class="form-control input-sm" placeholder="Hour" value='<?php echo date('h'); ?>'>
                                                </div>
                                                <div class="col-sm-3 col-md-3">
                                                    <input type="number" max="60" min="00" name="startminute" class="form-control input-sm" placeholder="Min" value='<?php echo date('i'); ?>'>
                                                </div>
                                                <div class="col-sm-3 col-md-3">
                                                    <select name="startch" class="form-control input-sm">
                                                        <?php
                                                        if(date("A")==AM)
                                                        {
                                                            echo "<option selected>AM</option>
                                                            <option>PM</option>";
                                                        }
                                                        else
                                                        {
                                                            echo "<option>AM</option>
                                                            <option selected>PM</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end : start time-->
                                        <!--start: end time input-->
                                        <div class="form-group">        
                                            <div class="row">
                                                <label for="eventdate" class="col-sm-1 col-md-1">End</label>
                                                <div class="col-sm-3 col-md-3">

                                                    <input type="number" max="12" min="01" name="endhour" class="form-control input-sm" placeholder="Hour" value='<?php echo date('h'); ?>'>
                                                </div>
                                                <div class="col-sm-3 col-md-3">
                                                    <input type="number" max="60" min="00" name="endminute" class="form-control input-sm" placeholder="Min" value='<?php echo date('i'); ?>'>
                                                </div>
                                                <div class="col-sm-3 col-md-3">
                                                    <select name="endch" class="form-control input-sm">
                                                        <?php
                                                        if(date("A")==AM)
                                                        {
                                                            echo "<option selected>AM</option>
                                                            <option>PM</option>";
                                                        }
                                                        else
                                                        {
                                                            echo "<option>AM</option>
                                                            <option selected>PM</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>                                        
                                        </div>
                                        <!--end: end time input-->
                                    </div>
                                </div>
                            </div>
                            <!--/ time container-->
                            <!--start desription-->
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label for="description">Event Description</label>
                                        <textarea name="description" id="description" maxlength="500" class="form-control" placeholder="Description"></textarea>
                                    </div>
                                </div>
                            </div>
                            <!--/ desription-->
                            <!--start venue-->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="col-sm-3 col-md-3">
                                            <label for="venue">Country</label>
                                            <input name="country" type="text" id="venue" class="form-control" placeholder="Country" required>
                                        </div>
                                        <div class="col-sm-3 col-md-3">
                                            <label for="venue">State</label>
                                            <input name="state" type="text" id="venue" class="form-control" placeholder="State" required>
                                        </div>   
                                        <div class="col-sm-3 col-md-3">
                                            <label for="venue">City</label>
                                            <input name="city" type="text" id="venue" class="form-control" placeholder="City" required>
                                        </div>   
                                        <div class="col-sm-3 col-md-3">
                                            <label for="venue">Street</label>
                                            <input name="street" type="text" id="venue" class="form-control" placeholder="Street" required>
                                        </div>
                                        <div class="col-sm-3 col-md-12">
                                            <label for="venue">Venue Additional Details</label>
                                            <input name="addition" type="text" id="venue" class="form-control" placeholder="Additional Details" required>
                                        </div>   
                                    </div>
                                </div>
                            </div>
                            <!--end venue-->
                            <!--start participant number-->
                            <div class="row">
                                <div class="col-md-12">
                                     <div class="col-md-3">
                                        <label for="deadline"> Application Deadline</label>
                                        <input name="deadline" type="number" id="deadline" min="1" class="form-control" placeholder="ex .4 days before" required>
                                     </div>
                                     <div class="col-sm-5 col-md-3">
                                        <label for="participant">Number of Participants</label>
                                        <select id="participant" class="form-control" onchange="numberofparticipants(this.value)">
                                            <option>Any</option>
                                            <option>Specific</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-2 col-md-2">
                                        <label for="number" class="" id="lnum">number</label>
                                            <input name="slot" type="number" min="1" class="form-control" id="number" placeholder="" value="1" required>
                                    </div>
                                </div>
                            </div>
                            <!--end participant number-->
                            <!--start organizer info-->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-3">
                                        <label for="contact" class="">Contact Number</label>
                                        <input name="contact" type="text" class="form-control" id="contact" placeholder="Contact">                         
                                    </div>
                                </div>
                            </div>
                            <!--end organizer info-->
                            <!--start attached file-->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-sm-2 col-md-2">
                                        <label for="file">Attached File</label>
                                        <input type="file" id="file" name="file">
                                    </div>  
                                </div>
                            </div>
                            <!--end attach file-->
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4>Privacy</h4>
                        </div>
                        <div class="panel-body">
                        <!--start privacy settings-->
                            <div class="row">
                                <div class="col-md-12">                                    
                                    <div class="col-md-3">
                                        <label for="privacy">Event Privacy</label>
                                        <select name="privacy" class="form-control" onchange="privacypassword(this.value)">
                                            <option>default</option>
                                            <option>public</option>
                                            <option>private</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label id="lpassword" for="password">Event Password</label>
                                        <input name="password" type="password" class="form-control" id="password" placeholder="password" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label id="lvpassword" for="verification">Verify Password</label>
                                        <input name="verifypassword" type="password" class="form-control" id="vpassword" placeholder="password" required>
                                    </div>
                                </div>
                            </div>
                            <!--end privacy settings-->
                            <!--start event status-->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="status" class="col-md-2">Event Status</label>
                                        <label class="radio-inline">
                                            <input type="radio" name="status" id="inlineRadio1" value="online" checked> Online
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="status" id="inlineRadio2" value="offline"> Offline
                                        </label>            
                                    </div>                                            
                                </div>
                            </div>
                            <!--end event status-->
                        </div>
                    </div>
                    <hr>
                    <input type="submit" class="btn btn-success btn-lg center-block" value="next">
                </form>
				<!-- endcreate event form -->
                <hr>
            </div>
        </div><!--end content row -->                  
    </div>
    </section>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/boostrap.min.js"></script>
         
    <script>
    
        function verify()
        {
            var pass = document.getElementById("password").value;
            var vpass = document.getElementById("vpassword").value;
            if(pass!=vpass)
            {
                alert("password does not match!");
                return false;
            }
        }
        
        function numberofparticipants(num)
        {
            if(num=="Any")
            {
                document.getElementById("number").style.visibility="Hidden";
                document.getElementById("lnum").style.visibility="Hidden";
                document.getElementById("number").disabled=true;
            }
            else
            {
                document.getElementById("number").style.visibility="Visible"; 
                document.getElementById("lnum").style.visibility="Visible";   
                document.getElementById("number").disabled=false;
            }
        }
        
        function privacypassword(privacy)
        {
            if(privacy=="private")
            {
                document.getElementById("password").style.visibility="Visible";
                document.getElementById("lpassword").style.visibility="Visible";
                document.getElementById("vpassword").style.visibility="Visible";
                document.getElementById("lvpassword").style.visibility="Visible";
                document.getElementById("password").disabled=false;
                document.getElementById("vpassword").disabled=false;
            }
            else
            {
                document.getElementById("password").style.visibility="Hidden";
                document.getElementById("lpassword").style.visibility="Hidden";
                document.getElementById("vpassword").style.visibility="Hidden";
                document.getElementById("lvpassword").style.visibility="Hidden"; 
                document.getElementById("password").disabled=true;
                document.getElementById("vpassword").disabled=true;
            }
        }
        window.onload = function() {
          numberofparticipants('Any');
          privacypassword('default');
        };

    </script>
    
</body>
</html>
