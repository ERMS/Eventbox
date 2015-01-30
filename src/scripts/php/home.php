<?php
error_reporting(0);
include "connectdb.php";
$con=connectdb();
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Eventbox</title>    
    <link rel="stylesheet" type="txt/css" href="../../bootstrap/css/bootstrap.min.css">   
    <link rel="stylesheet" type="txt/css" href="../../css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="../js/function.js"></script>
</head>
<body>
    
  <!-- start navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="../../index.php"><img src="../../images/eventbox-logo.png" width="175px"/></a>
            </div>
            <?php
            if(isset($_SESSION['user']))
            {
             echo "
             <div class='collapse navbar-collapse'>
                <ul class='nav navbar-nav navbar-right'>
                    <li class='img-responsive'>
                        <img style='padding:5px; margin-top:2px;' class='hidden-xs' src='http://a.deviantart.net/avatars/m/b/mb67.gif?3' width='50px' height='50px'>
                    </li>
                    <li class='dropdown'>
                      <a href='#' class='dropdown-toggle' data-toggle='dropdown'>".$_SESSION['user']['name']."<b class='caret'></b></a>
                      <ul class='dropdown-menu'>
                        <li><a href='home.php'>Home</a></li>
                        <li><a href='my_event.php'>Profile</a></li>
                        <li><a href='#'>Settings</a></li>
                        <li class='divider'></li>
                        <li><a href='my_event.php?log=out'>Log out</a></li>
                      </ul>
                    </li>
                  </ul>
            </div>"; 
            }
            else
            {
            echo "
            <div class='collapse navbar-collapse navbar-right'>
                <ul class='nav navbar-nav'>                    
                    <li class='text-center'>
                        <p class='navbar-text'><a href='login_form.php' class='navbar-link' >Sign In</a> </p>
                    </li>
                    <li align='center'> 
                        <p class='navbar-text'><a href='register_form.php' class='navbar-link'>Sign Up For Free!</a></p>
                    </li>
                </ul>
            </div>";
            }
            ?>
        </div>
    </nav>
	<!-- /navigation--> 
	
	<!-- search container-->
    <section class="container event">
        <div class="event">
            <div class="row">
                <div class="col-md-8 ">
					<!-- search form -->
                    <form class="form event" method="get" action="home.php" role="search"><!--Form search-->
                        <div class="form-group">
                            <label for="search" class="sr-only">SEARCH</label>
                            <div class="input-group"><!--input-group -->
                                <input type="text" name="search" class="form-control" placeholder="Search Events">
                                <div class="input-group-btn">
                                    
                                    <ul class="dropdown-menu pull-right" width="250px" role="menu">
                                    </ul>
                                </div><!-- /btn-group -->
                                <span class="input-group-btn">
                                    <input type="submit" class="btn btn-default" type="submit" value="Search"></input>
                                </span>                                        
                            </div><!-- /input-group -->
                        </div>
                    </form>
					<!-- end search form -->                
                </div>
                <div class="col-md-2 col-md-offset-2">
                <?php
                    if(isset($_SESSION['user']))
                    {
                        echo "<a href='create_event.php' class='event btn btn-default btn-block'> Create Event </a>";
                    }
                ?>
                </div>
            </div> 
        </div>
    </section>
	<!-- end search container -->
	
    <section class="container">
		
        <div class="row">
            <div class="col-md-5 ">
                <hr>
            </div>
            <div class="col-md-2">
                <h4 class="text-center">Recent Events</h4>  
            </div>
            <div class="col-md-5">
                <hr>
            </div>
        </div>
        
        <?php
        $srchstr="SELECT * FROM `event`";
        if(isset($_GET['search']))
        {
            $srch=$_GET['search'];
            $srchstr="SELECT * FROM `event` WHERE `Event_Title`='$srch' OR `User_ID`=(SELECT `User_ID` FROM `user` WHERE `User_FirstName`='$srch' OR `User_LastName`='$srch' OR CONCAT(`User_FirstName`,' ',`User_LastName`)='$srch')";
        }
        $search=mysqli_query ($con,$srchstr);
        if (mysqli_num_rows($search)>0)
        {
            echo "
                <div class='event table-responsive'>
                    <table class='table table-bordered table-hover text-center>
                        <thead class=''>
                            <th class='text-center'>Title</th>
                            <th class='text-center hidden-sm hidden-xs'>Organizer</th>
                            <th class='text-center hidden-sm hidden-xs'>Description</th>
                            <th class='text-center hidden-sm hidden-xs'>Venue</th>
                            <th class='text-center hidden-sm hidden-xs'>Date</th>
                            <th class='text-center hidden-sm hidden-xs'>Time</th>
                            <th class='text-center hidden-sm hidden-xs'>Participants</th>
                            <th class='text-center hidden-sm hidden-xs'>Slots</th>
                            <th class='text-center'>Status</th>
                        </thead>
                        <tbody><form>"; 
            while ($data = mysqli_fetch_array($search))
            {
                if($data['Event_Status']!='Offline')
                        echo"
                            <tr>
                                <td class='text-center hidden-sm hidden-xs'>
                                    <a href='event_details.php?id=".$data['Event_ID']."'> ".$data['Event_Title']." </a>
                                </td>"; 
                                $O_ID=$data['User_ID'];
                                $O_user= mysqli_query($con, "SELECT * FROM `user` WHERE `User_ID`='$O_ID'");
                                $ouser=mysqli_fetch_array($O_user);
                                echo "
                                <td class='text-center hidden-sm hidden-xs'> ".$ouser['User_FirstName']." ".$ouser['User_LastName']."</td>
                                <td class='text-center hidden-sm hidden-xs'> ".$data['Event_Description']." </td>
                                <td class='text-center hidden-sm hidden-xs'> ".$data['Event_Country'].", ".$data['Event_State'].", ".$data['Event_City'].", ".$data['Event_Street']." </td>
                                <td class='text-center hidden-sm hidden-xs'> ".$data['Event_StartMonth']."/".$data['Event_StartDay']."/".$data['Event_StartYear']." </td>
                                <td class='text-center hidden-sm hidden-xs'> ".$data['Event_StartHour'].":".$data['Event_StartMinute']." ".$data['Event_StartCH']." - ".$data['Event_EndHour'].":".$data['Event_EndMinute']." ".$data['Event_EndCH']." </td>
                                <td class='text-center hidden-sm hidden-xs'>".mysqli_num_rows($search)."</td>
                                <td class='text-center hidden-sm hidden-xs'> ".$data['Event_Slot']." </td>";
                                $date1 = date("Y")."-".date("m")."-".date("d");
                                $date2 = $data['Event_StartYear'].date('m', strtotime($data['Event_StartMonth']))."-".$data['Event_StartDay'];
                                $diff = abs(strtotime($date2) - strtotime($date1));
                                $years = floor($diff / (365*60*60*24));
                                $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                                $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                                echo "<td class='text-center hidden-sm hidden-xs'>".$years."years, ".$months."months, ".$days."days more to go</td>
                            </tr>
                            ";
            }
                            echo"</form>
                        </tbody>
                    </table>
                </div>";
        }
        else
        {
            echo "No Data Found!";
        }
        ?>

        <hr>
    </section>
</body>
</html>
