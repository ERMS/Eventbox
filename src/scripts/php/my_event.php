
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

	$con=connectdb();

	session_start();
	if(isset($_GET['log']))
	{
		unset($_SESSION['user']);
	}
	if (!isset($_SESSION['user']))
	{
		session_destroy();

		header("location:login_form.php");
	}
	if(isset($_GET['invite']))
	{
		if($_GET['invite']=='invited')
		{
			$inv=$_GET['invite'];
			$u_id=$_SESSION['user']['id'];
			$e_id=$_SESSION['eid'];
			$part=new attend;
			$part->invite($u_id,$e_id);

			header("location:my_event.php?tab=".$inv);
		}
	}
	if(!isset($_GET['tab']))
	{
		$_GET['tab']='host';
	}

	$id=$_SESSION['user']['id'];
	
	$edit_user=mysqli_query($con,"SELECT * FROM `user` WHERE `User_ID`='$id'");
	$c_user=mysqli_fetch_array($edit_user);

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
	
	<!-- Start Navigation -->
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
	<!-- /navigation -->
	
	<!-- start container -->
    <section class="event container">
        <div class="event ">
            <div class="row">
				
                <div class="col-md-1">
                    <?php
                        if($_SESSION['user']['pic']!=NULL)
                        {
                            echo "<img style='padding:5px; margin-top:2px;' class='hidden-xs' src='data:;base64,".$_SESSION['user']['pic']."' width='100px' height='100px'>";
                        }
                        else
                        {
                            echo "<img style='padding:5px; margin-top:2px;' class='hidden-xs' src='../../images/user.png' width='100px' height='100px'>";
                        }
                    ?>
                </div>
				
                <div class="col-md-5">
					<?php 
					$query=mysqli_query($con,"SELECT * FROM `attendance` WHERE `User_ID`='$id' AND `Status`='Accepted'");
					$query2=mysqli_query($con,"SELECT * FROM `event` WHERE `User_ID`='$id'");
						echo "<div class='col-md-12'>
							<h2>".$_SESSION['user']['name']."</h2>
						</div>
						<div class='col-md-4'>
							<h5 class='pull-right'>Event Hosted: ".mysqli_num_rows($query2)."</h5>
						</div>
						<div class='col-md-6'>
							<h5>Event attended: ".mysqli_num_rows($query)."</h5>
						</div>";
						?>
                </div>
				
                <div class="col-md-2 col-md-offset-4">
                    <a href="create_event.php" class="event btn btn-default pull-right"> Create Your Own Event </a>
					<a onclick="editProfile()" href="#" class="event pull-right" data-toggle="modal" data-target=".bs-edit-profile"> Edit Profile </a>
                </div>
				
            </div>
            <hr>
			
            <div role="tabpanel">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li onclick="tabVal('hosted')" role="presentation" id="tabhost"><a href="#host" aria-controls="home" role="tab" data-toggle="tab">Hosted</a></li>
                    <li onclick="tabVal('participated')" role="presentation" id="tabpart"><a href="#participate" aria-controls="profile" role="tab" data-toggle="tab">Participated</a></li>
                    <li onclick="tabVal('invited')" role="presentation" id="tabinvi"><a href="#invite" aria-controls="invitation" role="tab" data-toggle="tab">Invitation</a></li>
                    <li role="presentation " class="pull-right">
                        <button onclick="deleteEvent()" class="btn btn-default "> 
                            <span class="glyphicon glyphicon-trash"></span>
							DELETE
                        </button>
                        <button onclick="checkedCounter()" class="btn btn-default" data-target=".bs-edit-event-modal-lg">
                            <span class="glyphicon glyphicon-edit"></span>
							EDIT
                        </button>
                    </li>            
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane" id="host">
                        <?php
                        $user=$_SESSION['user']['id'];
                        $search=mysqli_query ($con,"SELECT * FROM `event` WHERE `User_ID`='$user'");
                        if (mysqli_num_rows($search)>0)
                        {
                            echo "
                                <div class='event table-responsive'>
                                    <table class='table table-bordered table-hover text-center>
                                        <thead class=''>
                                            <th><input type='checkbox' onchange='checkAll(this,hosted)'></th>
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
                                        <tbody><form name='hosted' id='hosted'>"; 
                            while ($data = mysqli_fetch_array($search))
                            {
                                if($data['Event_Status']!='Offline')
                                        echo"
                                            <tr>
                                                <td><input type='checkbox' value='".json_encode($data)."'></td>
                                                <td class='text-center hidden-sm hidden-xs'>
                                                    <a href='event_details.php?id=".$data['Event_ID']."'> ".$data['Event_Title']." </a>
                                                </td>"; 
                                                $O_ID=$data['User_ID'];
                                                $O_user= mysqli_query($con, "SELECT * FROM `user` WHERE `User_ID`='$O_ID'");
                                                $ouser=mysqli_fetch_array($O_user);
                                                echo "
                                                <td class='text-center hidden-sm hidden-xs'> ".$ouser['User_FirstName']." ".$ouser['User_LastName']."</td>
                                                <td class='text-center hidden-sm hidden-xs'> ".$data['Event_Description']." </td>
                                                <td class='text-center hidden-sm hidden-xs'> ".$data['Event_Country'].", ".$data['Event_City'].", ".$data['Event_Street']." </td>
                                                <td class='text-center hidden-sm hidden-xs'> ".$data['Event_StartMonth']."/".$data['Event_StartDay']."/".$data['Event_StartYear']." - ".$data['Event_EndMonth']."/".$data['Event_EndDay']."/".$data['Event_EndYear']." </td>
                                                <td class='text-center hidden-sm hidden-xs'> ".$data['Event_StartHour'].":".$data['Event_StartMinute']." ".$data['Event_StartCH']." - ".$data['Event_EndHour'].":".$data['Event_EndMinute']." ".$data['Event_EndCH']." </td>";
                                          $event_id=$data['Event_ID'];
                                          $num=mysqli_query($con,"SELECT * FROM `attendance` WHERE `Event_ID`='$event_id'");
                                          echo" <td class='text-center hidden-sm hidden-xs'>".mysqli_num_rows($num)."</td>";

                                          echo "<td class='text-center hidden-sm hidden-xs'>".$data['Event_Slot']." </td>";
                                          $curD = date("Y")."-".date("m")."-".date("d");
                                        $startD = $data['Event_StartYear']."-".date('m', strtotime($data['Event_StartMonth']))."-".$data['Event_StartDay'];
                                        $endD = $data['Event_EndYear']."-".date('m', strtotime($data['Event_EndMonth']))."-".$data['Event_EndDay'];
                                        $diff = strtotime($startD) - strtotime($curD);                      
                                        $diff2 = strtotime($curD) - strtotime($endD);  
                                        $years = floor($diff / (365*60*60*24));                                           // difference in years
                                        $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));                 // difference in months
                                        $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24)); // difference in days
                                        if($diff>0)
                                        {
                                            echo "<td class='text-center event '>";
                                            if($years!=0)
                                            {
                                                echo $years."years ";
                                            }
                                            if($months!=0)
                                            {
                                                echo $months."months ";
                                            }
                                            if($days!=0)
                                            {   
                                                echo $days." days ";
                                            }
                                            if($years==0 AND $months==0 AND $days==0)
                                            {
                                                echo "Event is Going On!";
                                            }
                                            else
                                            {
                                                echo "Till the Event!";
                                            }
                                            echo "</td>";
                                        }
                                        else
                                        {
                                            if($diff2>0)
                                            {
                                                echo "<td class='text-center hidden-sm hidden-xs'>Event has Ended!</td>";
                                            }
                                            else
                                            {
                                                echo "<td class='text-center hidden-sm hidden-xs'>Event is Goin On!</td>";
                                            }
                                        }
                                                    echo "</tr>
                                                    ";
                                    }
                                            echo"</form>
                                        </tbody>
                                    </table>
                                </div>";
                        }
                        else
                        {
                            echo "<h4 class='text-center'>No event hosted!</h4>";
                        }
                        ?>
                    </div>
                     <div role="tabpanel" class="tab-pane" id="participate">
                        <div class="event table-responsive">
                        <?php                                   // displays the participated events
                        $puser=$_SESSION['user']['id'];
                        $parts=mysqli_query ($con,"SELECT * FROM `attendance` WHERE `User_ID`='$puser' AND `Status`='Accepted'");
                        if (mysqli_num_rows($parts)>0)
                        {
                            echo "
                            <table class='table table-bordered table-hover text-center'>
                                <thead>
                                    <th> <input type='checkbox' onchange='checkAll(this,participated)'> </th>
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
                                <tbody>
                                <form name='participated' id='participated'>"; 
                            while ($part = mysqli_fetch_array($parts))
                            {   
                                $a_id=$part['Attendee_ID'];
                                echo"
                                    <tr>
                                        <td class=''><input type='checkbox' class='center-block event' value='".$a_id."'></td>";
                                $ev_de=mysqli_query ($con,"SELECT * FROM `event` WHERE `Event_ID`=(SELECT `Event_ID` FROM `attendance` WHERE `Attendee_ID`='$a_id')");
                                $e_d = mysqli_fetch_array($ev_de);
                                echo "  <td><a href='event_details.php?id=".$e_d['Event_ID']."'>".$e_d['Event_Title']."</a></td>";
                                $o_id=$e_d['User_ID'];
                                $eid=$e_d['Event_ID'];
                                $or_us=mysqli_query($con,"SELECT * FROM `user` WHERE `User_ID`='$o_id'");
                                $or = mysqli_fetch_array($or_us);

                                echo "  <td class='hidden-sm hidden-xs'>".$or['User_FirstName']." ".$or['User_LastName']."</td>
                                        <td class='hidden-sm hidden-xs'>".$e_d['Event_Description']."</td>
                                        <td class='hidden-sm hidden-xs'>".$e_d['Event_Country'].", ".$e_d['Event_City'].", ".$e_d['Event_Street']."</td>
                                        <td class='hidden-sm hidden-xs'>".$e_d['Event_StartMonth']."/".$e_d['Event_StartDay']."/".$e_d['Event_StartYear']." - ".$e_d['Event_EndMonth']."/".$e_d['Event_EndDay']."/".$e_d['Event_EndYear']."</td>
                                        
                                        <td class='hidden-sm hidden-xs'>".$e_d['Event_StartHour'].":".$e_d['Event_StartMinute']." ".$e_d['Event_StartCH']." - ".$e_d['Event_EndHour'].":".$e_d['Event_EndMinute']." ".$e_d['Event_EndCH']."</td>";
                                        
                                $numparts=mysqli_query($con,"SELECT * FROM `attendance` WHERE `Event_ID`='$eid'");
                                echo "  <td class='hidden-sm hidden-xs'>".mysqli_num_rows($numparts)."</td>
                                        <td class='hidden-sm hidden-xs'>".$e_d['Event_Slot']."</td>";
                                $date1 = date("Y")."-".date("m")."-".date("d");
                                $date2 = $e_d['Event_StartYear'].date('m', strtotime($e_d['Event_StartMonth']))."-".$e_d['Event_StartDay'];
                                $diff = abs(strtotime($date2) - strtotime($date1));
                                $years = floor($diff / (365*60*60*24));
                                $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                                $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                                if($years==0)
                                {
                                    if($months==0)
                                    {
                                        if($days==0)
                                        {
                                            echo "<td class='text-center hidden-sm hidden-xs'>Event is Going On!</td>";
                                        }
                                        else
                                        {
                                            echo "<td class='text-center hidden-sm hidden-xs'>".$days."days more to go!</td>";
                                        }
                                    }
                                    else
                                    {
                                        echo "<td class='text-center hidden-sm hidden-xs'>".$months."months, ".$days."days more to go!</td>";
                                    }
                                }
                                else
                                {
                                    echo "<td class='text-center hidden-sm hidden-xs'>".$years."years, ".$months."months, ".$days."days more to go!</td>";
                                }

                                echo "  </tr>";
                            }
                            echo "
                                </form>
                                </tbody>
                            </table>";
                        }
                        else
                        {
                            echo "<h4 class='text-center'>You Need to participate!</h4>";
                        }
                        ?>                   
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="invite">
                        <div class="row">
                        <div class="event table-responsive">
                        <?php
                        $iuser=$_SESSION['user']['id'];
                        $invited =mysqli_query($con,"SELECT * FROM `attendance` WHERE `User_ID`='$iuser' AND `Attendee_Title`='Invite' AND `Status`='Pending'");
                        if (mysqli_num_rows($invited)>0)
                        {
                            echo "
                            <table class='table table-bordered table-hover text-center'>
                                <thead>
                                    <th class='text-center'>Title</th>
                                    <th class='text-center hidden-sm hidden-xs'>Organizer</th>
                                    <th class='text-center hidden-sm hidden-xs'>Description</th>
                                    <th class='text-center hidden-sm hidden-xs'>Venue</th>
                                    <th class='text-center hidden-sm hidden-xs'>Date</th>
                                    <th class='text-center hidden-sm hidden-xs'>Time</th>
                                    <th class='text-center hidden-sm hidden-xs'>Participants</th>
                                    <th class='text-center hidden-sm hidden-xs'>Slots</th>
                                    <th class='text-center'>Status</th>
                                    <th class='text-center hidden-sm hidden-xs'>Response</th>
                                </thead>
                                <tbody><form name='invited' id='invited'>";
                            while ($invi = mysqli_fetch_array($invited))
                            {  
                                $i_id=$invi['Attendee_ID'];
                                echo "
                                    <tr>";
                                $ev_d=mysqli_query ($con,"SELECT * FROM `event` WHERE `Event_ID`=(SELECT `Event_ID` FROM `attendance` WHERE `Attendee_ID`='$i_id')");
                                $e_de = mysqli_fetch_array($ev_d);
                                echo "  <td><a href='event_details.php?id=".$e_de['Event_ID']."'>".$e_de['Event_Title']."</a></td>";
                                $or_id=$e_de['User_ID'];
                                $evid=$e_de['Event_ID'];
                                $org_us=mysqli_query($con,"SELECT * FROM `user` WHERE `User_ID`='$or_id'");
                                $org = mysqli_fetch_array($org_us);

                                echo "  <td class='hidden-sm hidden-xs'>".$org['User_FirstName']." ".$org['User_LastName']."</td>
                                        <td class='hidden-sm hidden-xs'>".$e_de['Event_Description']."</td>
                                        <td class='hidden-sm hidden-xs'>".$e_de['Event_Country'].", ".$e_de['Event_City'].", ".$e_de['Event_Street']."</td>
                                        <td class='hidden-sm hidden-xs'>".$e_de['Event_StartMonth']."/".$e_de['Event_StartDay']."/".$e_de['Event_StartYear']." - ".$e_de['Event_EndMonth']."/".$e_de['Event_EndDay']."/".$e_de['Event_EndYear']."</td>
                                        <td class='hidden-sm hidden-xs'>".$e_de['Event_StartHour'].":".$e_de['Event_StartMinute']." ".$e_de['Event_StartCH']." - ".$e_de['Event_EndHour'].":".$e_de['Event_EndMinute']." ".$e_de['Event_EndCH']."</td>";      
                                $nump=mysqli_query($con,"SELECT * FROM `attendance` WHERE `Event_ID`='$evid'");
                                echo "  <td class='hidden-sm hidden-xs'>".mysqli_num_rows($nump)."</td>
                                        <td class='hidden-sm hidden-xs'>".$e_de['Event_Slot']."</td>
                                        <td>2 days more</td>";
                                        $fdata=mysqli_query($con,"SELECT * FROM `form` WHERE `Event_ID`='$evid'");
                                        $form=mysqli_fetch_array($fdata);
                                        $data=array($invi['Status'],$e_de,$form);
                                        $value=JSON_encode($data);
                                if($invi['Status']=='Pending')
                                {
                                    echo " <td id='respondStatus'><button onclick='privatePassword(this.value)' id='Accepted' form='' data-target='.bs-example-modal-lg2' value='".$value."' class='btn btn-default btn-block'>Accept</button><button class='btn btn-default btn-block' id='Rejected' onclick='updateResponse(this.id)' form='' value='".$invi['Attendee_ID']."'>Reject</button></td>    
                                    </tr>";
                                }
                                else
                                {
                                    echo " <td>".$invi['Status']."</td>    
                                    </tr>";
                                }
                            }      
                            echo "
                                </form>                   
                                </tbody>
                                </table>";
                        }
                        else
                        {
                            echo "<h4 class='text-center'>Just wait for Invitation!</h4>";
                        }
                        ?>  
                        </div>  
                   		</div>            
                </div><!-- /Tab panes -->
                <hr>
            </div>      
        </div>
    </section>
	<!-- end container -->
		
<div id="registrationForm" class="modal fade bs-example-modal-lg2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" onclick="clearform('form')">
                        <span aria-hidden="true">×</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h2 class="modal-title text-center">Registration Form</h2>
                </div>
                <div class="modal-body">
                    <div class="panel panel-default">                       
                        <div class="panel-body">
                            <form role="form" id="formDatas" action="approve_invitation.php" method="GET" name="formDatas" onsubmit="FormEventID()">
                                    <div class="panel-body" id="form">
                                    </div> 
                                    <input type="hidden" name="formid">
                                    <input type="submit">
                                </form>                      
                        </div>
                    </div>
                </div> <!-- /.modal-content -->
      </div>
    </div>
    <div id="eventPassword" class="modal fade bs-example-modal-lg2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" onclick="clearform('pass')">
                        <span aria-hidden="true">×</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h2 class="modal-title text-center">Password</h2>
                </div>
                <div class="modal-body">
                    <div class="panel panel-default">                       
                        <div class="panel-body">
                            <input type="password" id="privacypass" name="privacypass">
                            <button onclick="checkPass()">Submit</button>
                                    <div class="panel-body" id="pass">
                            </div>                            
                        </div>
                    </div>
                </div> <!-- /.modal-content -->
      </div>
    </div>
	<!-- modal for edit event details -->
   <div id="full-width" class="modal fade bs-edit-event-modal-lg" tabindex="-1" data-replace="true" style="display: none;">
	   <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">×</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h2 class="modal-title text-center">Edit Event Details</h2>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form class="editForm" name="editForm" id="editForm" role="form" method="post"> <!-- start form -->
                                <input type="hidden" name="id" id="id">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4>Event Details</h4>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row"> <!-- first row event details -->
                                            <div class="form-group">
                                                <div class="col-sm-8 col-md-6">
                                                    <label for="title" class="" >Event Title</label>
                                                    <input type="text" name="title" class="form-control" id="title" value="aaa" placeholder="Event Name" required>
                                                </div>
                                                <div class="col-sm-2 col-md-2">
                                                    <label for="logo">Event Logo</label>
                                                    <input name="logo" type="file" id="logo">
                                                </div>  
                                                <div class="col-sm-2 col-md-2">
                                                    <label for="type" class="" >Event Type</label>
                                                    <select name="type" id="type" class="form-control" onchange="specif(this.value)">
                                                        <option value="fiesta">Fiesta</option>
                                                        <option value="seminar">Seminar</option>
                                                        <option value="orientation">Orientation</option>
                                                        <option value="meeting">Meeting</option>
                                                        <option value="Others">Others</option>
                                                    </select>  
                                                </div>  
                                                <div class="col-sm-2 col-md-2">
                                                    <label for="spec" class="" id="lspec">Specify</label>                            
                                                    <input type="text" class="form-control" name="spec" id="spec"/>                                      
                                                </div>
                                            </div>
                                        </div> <!--end first row event details -->
                                        <br>
                                        <div class="row"> <!-- start event date&time row -->
                                            <div class="col-md-6"> <!-- start event date container  -->
                                                <div class="col-md-12"> <!-- start event date:From container  -->
                                                    <div class="form-group">                                                   
                                                        <div class="row">
                                                            <label for="eventdate" class="col-sm-1 col-md-1">From</label>
                                                            <div class="col-sm-5 col-md-5">                                                        
                                                                <select name="s_month" id="eventdate" class="form-control input-sm">
                                                                    <?php
                                                                        for ($i=1; $i <= 12; $i++) 
                                                                        { 
                                                                            $day=mktime(0,0,0, $i);
                                                                            echo "<option value='".date("F", $day)."'>";
                                                                            echo date("F", $day);
                                                                            echo "</option>";
                                                                        }
                                                                     ?>
                                                                </select>	
                                                            </div>
                                                            <div class="col-sm-3 col-md-3">
                                                                <select  name="s_day" class="form-control input-sm">
                                                                    <?php
                                                                        for ($i=1; $i <=31 ; $i++) 
                                                                        {
                                                                            echo "<option value='".$i."'>";
                                                                            echo $i;
                                                                            echo "</option>";
                                                                        }
                                                                    ?>
                                                                </select>	
                                                            </div>
                                                            <div class="col-sm-3 col-md-3">
                                                                <select name="s_year" id="eventdate" class="form-control year input-sm">
                                                                    <?php
                                                                        $year=date('Y')-60;
                                                                        for ($i=0; $i < 60; $i++) 
                                                                        { 
                                                                            echo "<option value='".$year++."'>";
                                                                            echo $year++;
                                                                            echo "</option>";
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
                                                                <select name="e_month" id="eventdate" class="form-control input-sm">
                                                                    <?php
                                                                        for ($i=1; $i <= 12; $i++) 
                                                                        { 
                                                                            $day=mktime(0,0,0, $i);
                                                                            echo"<option value='".date("F", $day)."'>";
                                                                            echo date("F", $day);
                                                                            echo "</option>";
                                                                        }
                                                                    ?>
                                                                </select>	
                                                            </div>
                                                            <div class="col-sm-3 col-md-3">
                                                                <select  name="e_day" class="form-control input-sm">
                                                                    <?php
                                                                        for ($i=1; $i <=31 ; $i++) 
                                                                        {
                                                                            echo "<option value='".$i."'>";
                                                                            echo $i;
                                                                            echo "</option>";
                                                                        }
                                                                    ?>
                                                                </select>	
                                                            </div>
                                                            <div class="col-sm-3 col-md-3">
                                                                <select name="e_year" id="eventdate" class="form-control year input-sm">
                                                                    <?php
                                                                        $year=date('Y')-60;
                                                                        for ($i=0; $i < 60; $i++) 
                                                                        { 
                                                                            echo "<option value='".$year++."'>";
                                                                            echo $year++;
                                                                            echo "</option>";
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
                                                                <input name="s_hour" type="number" max="12" min="01"   class="form-control input-sm" placeholder="Hour" value="01">
                                                            </div>
                                                            <div class="col-sm-3 col-md-3">
                                                                <input name="s_minute" type="number" max="60" min="00" class="form-control input-sm" placeholder="Min" value="01">
                                                            </div>
                                                            <div class="col-sm-3 col-md-3">
                                                                <select name="s_ch" class="form-control input-sm">
                                                                    <option>AM</option>
                                                                    <option>PM</option>
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
                                                                <input name="e_hour" type="number" max="12" min="01"   class="form-control input-sm" placeholder="Hour" value="01">
                                                            </div>
                                                            <div class="col-sm-3 col-md-3">
                                                                <input name="e_minute" type="number" max="60" min="00" class="form-control input-sm" placeholder="Min" value="01">
                                                            </div>
                                                            <div class="col-sm-3 col-md-3">
                                                                <select name="e_ch" class="form-control input-sm">
                                                                    <option>AM</option>
                                                                    <option>PM</option>
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
                                                    <textarea id="description" name="description" maxlength="500" class="form-control" placeholder="Description"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/ desription-->
                                        <br>
                                        <!--start venue-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="col-sm-3 col-md-3">
                                                        <label for="venue">Country</label>
                                                        <input type="text" id="venue" name="country" class="form-control" placeholder="Country" required>
                                                    </div>  
                                                    <div class="col-sm-3 col-md-3">
                                                        <label for="venue">City</label>
                                                        <input type="text" id="venue" name="city" class="form-control" placeholder="City" required>
                                                    </div>   
                                                    <div class="col-sm-3 col-md-3">
                                                        <label for="venue">Street</label>
                                                        <input type="text" id="venue" name="street" class="form-control" placeholder="Street" required>
                                                    </div>
                                                    <div class="col-sm-3 col-md-12">
                                                        <label for="venue">Venue Additional Details</label>
                                                        <input name="additional" type="text" id="venue" class="form-control" placeholder="Additional Details" required>
                                                    </div>  
                                                </div>
                                            </div>
                                        </div>
                                        <!--end venue-->
                                        <br>
                                        <!--start participant number-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                 <div class="col-md-3">
                                                    <label for="deadline"> Application Deadline</label>
                                                    <input type="number" name="deadline" id="deadline" min="1" class="form-control" placeholder="ex .4 days before" required>
                                                 </div>
                                                 <div class="col-sm-5 col-md-3">
                                                    <label for="participant">Number of Participants</label>
                                                    <select id="participant" class="form-control" onchange="numberofparticipants(this.value)">
                                                        <option>Any</option>
                                                        <option>Specific</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-2 col-md-2">
                                                    <label for="number" name="number" id="lnum" class="">number</label>
                                                        <input type="number" min="1" class="form-control" id="number" placeholder="" value="1" required>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end participant number-->
                                        <br>
                                        <!--start organizer info-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="col-md-3">
                                                    <label for="contact" class="">Contact Number</label>
                                                    <input type="text" class="form-control" id="contact" name="contact" placeholder="Contact">                         
                                                </div>
                                            </div>
                                        </div>
                                        <!--end organizer info-->
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4>Privacy</h4>
                                    </div>
                                        <br>
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
                                <div class="row">
                                    <div class="col-md-6">
                                        <button class="btn btn-default btn-lg pull-right" data-dismiss="modal">Cancel</button>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="submit" class="btn btn-success btn-lg btn-primary" name="submit" value="Done" id="submit">
                                    </div>
                                </div>
                            </form><!--end form -->  
                            <hr>
                        </div>
                    </div><!--end content row -->
               </div>
	   		</div> <!-- /.modal-content -->
		</div>
		<!-- modal for edit event details -->
		<!-- modal for edit profile -->
		<div id="static" class="modal fade bs-edit-profile" tabindex="-1" role="dialog" style="display:none;">
      	<div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" onclick="clearform('form')">
                        <span aria-hidden="true">×</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h2 class="modal-title text-center">Edit Profile</h2>
                </div>
				<div class="modal-body">
					<div class="form-wrap">
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-default">
								<div class="panel-body">
									<form class="edituser" name="edituser" id="edituser" role="form" method="post">
											<div class="row">
												<div class="col-xs-12 col-sm-6 col-md-6">
													<div class="form-group"><input type="hidden" name="uid" id="uid">
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
														<input type="text" name="country" id="country" class="form-control" placeholder="Country" tabindex="3" required>
													</div>
												</div>
												<div class="col-xs-12 col-sm-4 col-md-4">
													<div class="form-group">
														<input type="text" name="city" id="city" class="form-control" placeholder="City" tabindex="3" required>
													</div>
												</div>

											</div>
											<div class="form-group">
												<input type="email" name="email" id="email" class="form-control" placeholder="Email Address" tabindex="4" required>
											</div>                                  
											<hr>
											<div class="row" >
												<div class="col-xs-12 col-md-6 col-md-6">
													<a href="login_form.php" class="btn btn-custom btn-block">Cancel</a>
												</div>
												<div class="col-xs-12 col-md-6 col-md-6">
													<input type="submit" id="editprofile" value="Done" style="margin-bottom:10px" class="btn btn-primary btn-block" tabindex="7">
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
		</div>
		</div>
		<!-- modal for edit profile -->

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/boostrap.min.js"></script>

    <script>
		
		var selectedTab='hosted';
		var form='';
		var events='';
		
		window.onload = function() 
		{
			var inv='<?php echo $_GET['tab'];?>';
			if(inv=='invited')
			{
				selectedTab='invited';
				document.getElementById('invite').classList.add('active');
				document.getElementById('tabinvi').classList.add('active');
			}
			else
			{
				document.getElementById('host').classList.add('active');
				document.getElementById('tabhost').classList.add('active');
			}
		}
		
		var count=0;
		var user=<?php echo json_encode($c_user); ?>;
		
		function editProfile()
		{
			document.forms["edituser"]["uid"].value=user['User_ID'];
			document.forms["edituser"]["first_name"].value=user['User_FirstName'];
			document.forms["edituser"]["last_name"].value=user['User_LastName'];
			document.forms["edituser"]["email"].value=user['User_Email'];
			document.forms["edituser"]["country"].value=user['User_Country'];
			document.forms["edituser"]["city"].value=user['User_City'];
		}
		
		function generateForm(divName,formElemID,labelName)
		{
			var newdiv = document.createElement('div');
			count++;
			switch(formElemID) {
				  case 'name':
					   newdiv.innerHTML ="<div id='"+divName+count+"'><div class='form-group'><label class='col-md-2 col-md-offset-1 control-label' for='"+formElemID+count+"'>"+labelName+"</label><div class='col-md-4'><input id='"+formElemID+count+"' name='value[]' type='text' class='form-control' placeholder='First'></div><div class='col-md-4'><input id='"+formElemID+count+"' name='value[]' type='text' class='form-control' placeholder='Last'></div></div></div>";
					   break;
				  case 'date':
					   newdiv.innerHTML ="<div id='"+divName+count+"'><div class='form-group'><label class='col-md-2 col-md-offset-1 control-label' for='"+formElemID+count+"'>"+labelName+"</label><div class='col-md-4'><input type='text' id='"+formElemID+count+"' name='value[]' class='form-control' placeholder='mm'></div><div class='col-md-2'><input  id='"+formElemID+count+"' type='text' name='value[]' class='form-control' placeholder='dd'></div><div class='col-md-2'><input type='text' class='form-control' name='value[]' id='"+formElemID+count+"' placeholder='yyyy'></div></div></div>";
					   break;
				  case 'email':
					   newdiv.innerHTML = "<div id='"+divName+count+"'><div class='form-group'><label class='col-md-2 col-md-offset-1 control-label' for='"+formElemID+count+"'>"+labelName+"</label><div class='col-md-8'><input type='email' id='"+formElemID+count+"' name='value[]' class='form-control' placeholder='eventbox@eventbox.com'></div></div></div>";
					   break;
				  case 'address':
					   newdiv.innerHTML = "<div id='"+divName+count+"'><div class='form-group'><label class='col-md-2 col-md-offset-1 control-label' for='"+formElemID+count+"'>"+labelName+"</label><div class='col-md-4' ><input type='text' id='"+formElemID+count+"' name='value[]' class='form-control' placeholder='Country'><input id='"+formElemID+count+"' name='value[]' type='text' class='form-control event' placeholder='City'></div><div class='col-md-4' ><input type='text' name='value[]' id='"+formElemID+count+"' class='form-control event' placeholder='Street'></div></div></div>";
					   break;
				  case 'text':
					   newdiv.innerHTML = "<div id='"+divName+count+"'><div class='form-group'><label class='col-md-2 col-md-offset-1 control-label' for='"+formElemID+count+"'>"+labelName+"</label><div class='col-md-8'><input type='text' id='"+formElemID+count+"' name='value[]' class='form-control' placeholder='"+labelName+"'></div></div></div>";
					   break;
				  case 'textarea':
					   newdiv.innerHTML = "<div id='"+divName+count+"'><div class='form-group'><label class='col-md-2 col-md-offset-1 control-label' for='"+formElemID+count+"'>"+labelName+"</label><div class='col-md-8'> <textarea id='"+formElemID+count+"' name='value[]' class='form-control' placeholder='Type Here...'></textarea></div></div></div>";
					   break;
				  case 'link':
					   newdiv.innerHTML = "<div id='"+divName+count+"'><div class='form-group'><label class='col-md-2 col-md-offset-1 control-label' for='"+formElemID+count+"'>"+labelName+"</label><div class='col-md-8'><input type='text' class='form-control' name='value[]' id='"+formElemID+count+"' placeholder='https://'></div></div></div>";
					   break;
			}
			document.getElementById(divName).appendChild(newdiv);
		}
		
		function participateForm()
		{
			var formorder=JSON.parse(form['Form_Order']);
			for(var i=0;i<formorder.length;i++)
			{
				generateForm('form',formorder[i][2],formorder[i][0]);
			}
		}
		
		function checkPass()
		{
			if(document.getElementById("privacypass").value!=events['Event_Password'])
			{
				alert("invalid Password!");
			}
			else
			{
				$('#eventPassword').modal('hide'); 
				participateForm();
				$('#registrationForm').modal('show');
			}
		}
		
		function privatePassword(data)
		{
			var json=JSON.parse(data);
			form=json[2];
			events=json[1];
			if(json[0]!='Accepted')
			{
				if(events['Event_Privacy']!='private')
				{
					participateForm();
					$('#registrationForm').modal('show');    
				}
				else
				{
					$('#eventPassword').modal('show'); 
				}
			}
			else
			{
				alert("You already have registered!");
			}
		}
		
		function FormEventID()
		{
			var id=form['Form_ID'];
			document.forms['formDatas']['formid'].value=id;
		}
		
		function clearform(elementID)
		{
			document.getElementById(elementID).innerHTML = "";
		}
		
		function tabVal(tab)
		{
			selectedTab=tab;
			return selectedTab;
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
		
		function deleteEvent()
		{
			var form=document.getElementById(selectedTab).elements;
			var count=0;
			var deleteEvent=[];
			for(var i=0;i<form.length;i++)
			{
				if(form[i].checked)
				{
					var json=form[i].value;
					var data=JSON.parse(json);
					deleteEvent[count]=data.Event_ID;
					count++;
				}
			}
			if(count==0)
			{
				alert("No Item was selected!!");
			}
			else
			{
				if(confirm("Are your sure?"))
				{

					window.location.href = "delete_event.php?deleteEvent="+JSON.stringify(deleteEvent);
				}
				else
				{
					return false;
				}
			}
		}
		
        function updateResponse(response)
        {
            var id=document.getElementById(response).parentNode.id;
            document.getElementById(id).innerHTML="<p>"+response+"</p>";
        }

        function specif(type)
        {
            if(type!="Others")
            {
                document.getElementById("spec").style.visibility="Hidden";
                document.getElementById("lspec").style.visibility="Hidden";
                document.getElementById("spec").disabled=true;
            }
            else
            {
                document.getElementById("spec").style.visibility="Visible"; 
                document.getElementById("lspec").style.visibility="Visible";   
                document.getElementById("spec").disabled=false;
            }
        }

		function editEvent(data)
		{
			var json=data;
			var editData=JSON.parse(json);
            document.forms["editForm"]["id"].value=editData.Event_ID;
            document.forms["editForm"]["title"].value=editData.Event_Title;
            document.forms["editForm"]["s_month"].value=editData.Event_StartMonth;
            document.forms["editForm"]["s_day"].value=editData.Event_StartDay;
            document.forms["editForm"]["s_year"].value=editData.Event_StartYear;
            document.forms["editForm"]["e_month"].value=editData.Event_EndMonth;
            document.forms["editForm"]["e_day"].value=editData.Event_EndDay;
            document.forms["editForm"]["e_year"].value=editData.Event_EndYear;
            document.forms["editForm"]["s_hour"].value=editData.Event_StartHour;
            document.forms["editForm"]["s_minute"].value=editData.Event_StartMinute;
            document.forms["editForm"]["s_ch"].value=editData.Event_StartCH;
            document.forms["editForm"]["e_hour"].value=editData.Event_EndHour;
            document.forms["editForm"]["e_minute"].value=editData.Event_EndMinute;
            document.forms["editForm"]["e_ch"].value=editData.Event_EndCH;
            document.forms["editForm"]["description"].value=editData.Event_Description;
            document.forms["editForm"]["country"].value=editData.Event_Country;
            document.forms["editForm"]["city"].value=editData.Event_City;
            document.forms["editForm"]["street"].value=editData.Event_Street;
            document.forms["editForm"]["additional"].value=editData.Event_Additional;
            document.forms["editForm"]["deadline"].value=editData.Event_Deadline;
            document.forms["editForm"]["number"].value=editData.Event_Slot;
            document.forms["editForm"]["contact"].value=editData.Event_ContactNumber;
            document.forms["editForm"]["file"].value=editData.Event_File;
            document.forms["editForm"]["privacy"].value=editData.Event_Privacy;
            document.forms["editForm"]["password"].value=editData.Event_Password;
            document.forms["editForm"]["status"].value=editData.Event_Status;
            var type=document.forms["editForm"]["type"].value;
            if(type!='seminar' && type!='meeting' && type!='orientation' && type!='fiesta')
            {
                document.forms["editForm"]["spec"].value=editData.Event_Type;
                document.forms["editForm"]["type"].value='Others';
            }
            else
            {
                document.forms["editForm"]["type"].value=editData.Event_Type;
            }
            var num='a';
            if(editData.Event_Slot==0)
            {
                num='Any';
            }
            numberofparticipants(num);
            privacypassword(editData.Event_Privacy);
            specif(type);
		}
		
		function checkAll(element,form) 
		{
			var checkboxes = form.elements;
			 if (element.checked) 
			 {
				 for (var i = 0; i < checkboxes.length; i++) 
				 {
					 if (checkboxes[i].type == 'checkbox') 
					 {
						 checkboxes[i].checked = true;
					 }
				 }
			 } 
			 else 
			 {
				 for (var i = 0; i < checkboxes.length; i++) 
				 {
					 if (checkboxes[i].type == 'checkbox') 
					 {
						 checkboxes[i].checked = false;
					 }
				 }
			 }
		}
		
		function checkedCounter()
		{
			var form=document.getElementById(selectedTab).elements;
			var count=0;
			var editData;
			for(var i=0;i<form.length;i++)
			{
				if(form[i].checked)
				{
					count++;
					editData=form[i].value;
				}
			}
			if(count!=1)
			{
				alert("check 1 only!");
			}
			else
			{

				$('#full-width').modal('show');
				editEvent(editData);
			}
		}
		
		$(document).ready(function () {
			$("input#editprofile").click(function(){
				$.ajax({
					type: "POST",
					url: "edit_profile.php",
					data: $('form#edituser').serialize(),
					success: function(){
						$("#static").modal('hide');
						location.reload();
					},
					error: function(){
						//alert("Failed to Edit! Try Again Later..");
					}
				});
			});
		});
		$(document).ready(function () {
			$("input#submit").click(function(){
				$.ajax({
					type: "POST",
					url: "edit_event.php",
					data: $('form#editForm').serialize(),
					success: function(){
						$("#full-width").modal('hide');
						location.reload();
					},
					error: function(){
						alert("Failed to Edit! Try Again Later..");
					}
				});
			});
		});
	$(document).ready(function () {
		$(".btn").click(function(){
			var t=this.id;
			var v=this.value;
			$.ajax({
				type: "POST",
				url: "status_update.php",
				data: {status:v,respond:t},
				success: function(){

				},
				error: function(){
					alert("Failed to Edit! Try Again Later..");
				}
			});
		});
	});

    </script>

</div>
</body>
</html>
