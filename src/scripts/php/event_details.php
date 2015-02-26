
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
	error_reporting(0);
	include "connectdb.php";

	$con=connectdb();

	session_start();
	if (!isset($_SESSION['user']))
	{
	    header("location:login_form.php");
	}

	$user=$_SESSION['user'];
	$id=$_GET['id'];

	$data=mysqli_query($con,"SELECT * FROM `event` WHERE `Event_ID`='$id'");
	$event=mysqli_fetch_array($data);
	
	$formdata=mysqli_query($con,"SELECT * FROM `form` WHERE `Event_ID`='$id'");
	$form=mysqli_fetch_array($formdata);

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
    
	<!-- Navigation -->
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
	
    <section class="event container">        
        <div class="event">
            <div class="row">
				
                <div class="col-md-1">
                <?php
                    if($event['Event_Logo']!=NULL)
                    {
                    	echo "<img src='data:;base64,".$event['Event_Logo']."' width='100px' height='100px'>";    // displays the logo
                    }
                    else
                    {
                    	echo "<img src='../../images/box.jpg' width='100px' height='100px'>";    // displays the logo
                    }
                ?>
                </div>
				
				<!-- event name -->
                <div class="col-md-5">
                    <div class=" col-md-12">
                        <?php
                            $uid=$event['User_ID'];
                            $organizer=mysqli_query($con,"SELECT * FROM `user` WHERE `User_ID`='$uid'");
                            $host=mysqli_fetch_array($organizer);
                            echo "<h2> ".$event['Event_Title']."<br> <small> by  ".$host['User_FirstName']." ".$host['User_LastName']."</small></h2>";
                        ?>
                    </div>
                </div>
				<!-- user name -->
				<?php
				echo "<div class='col-md-2 col-md-offset-4'>";
					$current = date("Y")."-".date("m")."-".date("d");
	                $eventstart = $event['Event_StartYear']."-".date('m', strtotime($event['Event_StartMonth']))."-".$event['Event_StartDay'];
	                $diff = strtotime($eventstart) - strtotime($current);							  // gets the # of seconds till the event
	                $years = floor($diff / (365*60*60*24));											  // difference in years
	                $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));				  // difference in months
	                $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24)); // difference in days
					$cu=$_SESSION['user']['id'];
	                $u=mysqli_query($con,"SELECT `User_ID` FROM `event` WHERE `Event_ID`='$id'");
	                $h=mysqli_fetch_array($u);
	                $hu=$h['User_ID'];
	                $deadline=date('Y-m-d',strtotime($eventstart.'-'.$event['Event_Deadline'].' days'));
	                $diff2 = strtotime($eventstart) - strtotime($deadline);	   // gets the # of seconds till the registration
	                $d=$diff-$diff2;										   // compute the difference till the deadline of registration
	                if($diff>=0)
	                {
	                	echo "<p class='text-center  text-uppercase'> <strong>";
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
		                	echo "More to go";
		                }
		                echo "</strong> </p>";
	                    if($d>=0)
	                    {
		                    if($hu==$cu)
		                    {
		                        echo "<button data-toggle='modal' class='btn btn-default btn-lg pull-right' data-target='.bs-example-modal-lg3'>Invite Friends</button>";
		                    }
		                    else
		                    {
		                        $s=mysqli_query($con,"SELECT * FROM `attendance` WHERE `User_ID`='$cu' AND `Event_ID`='$id'");
		                        $us=mysqli_fetch_array($s);
		                        if($us['Status']!='Approved')
		                        {
		                        echo "<button onclick='privatePassword(this.value)' href='#' class='btn btn-default btn-lg pull-right' data-target='.bs-example-modal-lg' value='".$us['Status']."'> Join NOW</button>";
		                        }
		                        else
		                        {
		                        echo "<button data-toggle='modal' class='btn btn-default btn-lg pull-right' data-target='.bs-example-modal-lg3'>Invite Friends</button>";
		                        }
		                    }
		                    echo "<p class='text-center'><small>Registration is Open <br> Until: ".$deadline."</small></p>";
		                }
		                else
		                {
		                	echo "<p class='text-center event text-uppercase'><small>Registration is already Closed!</small></p>";
		                }
		            }
		            else
                    {
                        if($diff2>0)
                        {
                            echo "<td class=''><h4 class='pull-right'>Event has Ended!</h4></td>";
                        }
                        else
                        {
                            echo "<td class='text-center hidden-sm hidden-xs'>Event is Goin On!</td>";
                    	}
                    }
                    ?>
                    <!----change "Join NOW" into Invite if user is the one hosting the event and if official participant-->
                </div>
            </div>
            <hr>
			
            <div role="tabpanel">
            <!-- Nav tabs -->
				<ul class="nav nav-tabs" role="tablist">
					<li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab" onclick="hideButton('trash','edit')">Details</a></li>
					<li role="presentation"><a href="#profile" aria-controls="profile" onclick="hideButton('edit','trash')" role="tab" data-toggle="tab">Participants</a></li>
					<li role="presentation " class="pull-right">
					<?php
					if($host['User_ID']==$user['id'])
					{
						$table='printable';
						$name='W3CExampleTable';
					echo "
						<button onclick='deleteParticipants()' class='btn btn-default' id='trash'>
							<span class='glyphicon glyphicon-trash'></span>
						</button>
						<button onclick='editEvent()' class='btn btn-default' id='edit' data-toggle='modal' data-target='.bs-edit-event-modal-lg'>
							<span class='glyphicon glyphicon-edit'></span>
						</button>
						<button class='btn btn-default' onclick='print()'>
							<span class='glyphicon glyphicon-print'></span>
							PRINT
						</button>
						<input type='button' class='btn btn-default' onclick=tableToExcel('$table','$name') value='Export to Excel'>
						";
					}
					?>
					</li>
				</ul>
            <!-- Nav tabs -->
            <!-- Tab panes -->
				<div class="tab-content">
					<div role="tabpanel" class="tab-pane active" id="home">
						<div class="row">
							<div class="col-md-12">
								<div class="event panel panel-default">
									<div class="panel-heading"> 
										<h4>Event Details </h4>
									</div> 
									<?php                           
									echo "
									<div class='panel-body'>
										<p><strong> When : </strong> ".$event['Event_StartMonth']." ".$event['Event_StartDay'].", ".$event['Event_StartYear']." - ".$event['Event_EndMonth']." ".$event['Event_EndDay'].", ".$event['Event_EndYear']." @ ".$event['Event_StartHour'].":".$event['Event_StartMinute']." ".$event['Event_StartCH']." - ".$event['Event_EndHour'].":".$event['Event_EndMinute']." ".$event['Event_EndCH']."</p>
										<p><strong> Where : </strong> ".$event['Event_Country'].", ".$event['Event_Street'].", ".$event['Event_City']." </p>
										<p><strong> Decription : </strong> ".$event['Event_Description']."</p>
										<p><strong> Deadline of Registration : </strong> ".$event['Event_Deadline']." day before the Event </p>
										<p>"; 
										$event_id=$event['Event_ID'];
                                        $num=mysqli_query($con,"SELECT * FROM `attendance` WHERE `Event_ID`='$event_id'");
										echo "
											<strong> Number of participants : ".mysqli_num_rows($num)."</strong>  <br>
											<strong> Slot left : </strong> ".$event['Event_Slot']."
										</p>";
										$userid=$event['User_ID'];
										$users=mysqli_query($con,"SELECT `User_Email` FROM `User` WHERE `User_ID`='$userid'");
										$email=mysqli_fetch_array($users);
										echo "
										<p><strong> Email Address : </strong> ".$email['User_Email']." </p>
										<p><strong> Contact Number : </strong> ".$event['Event_ContactNumber']." </p>
									</div>";
									?>
								</div>
							</div>
						</div>
					</div>
					<div role="tabpanel" class="tab-pane" id="profile">
						<div class="event table-responsive">
						<?php
						if($_SESSION['user']['id']==$event['User_ID'])
						{
							$string="SELECT * FROM `attendance` WHERE `Event_ID`='$id'";
						}
						else
						{
							$string="SELECT * FROM `attendance` WHERE `Event_ID`='$id' AND `Status`='Approved'";
						}
						$data1=mysqli_query($con,$string);
						if(mysqli_num_rows($data1)>0)
						{

						echo "
								<table class='table table-bordered table-hover text-center'>
									<thead>";
									if($host['User_ID']==$user['id'])
									{
									echo "
										<th><input type='checkbox' onchange='checkAll(this,attendee)'></th>";
									}
									if($hu==$cu)
									{
									echo "
										<th class='text-center hidden-sm hidden-xs'>Registration Form</th>";
									}
									echo "
										<th class='text-center hidden-sm hidden-xs'>Name</th>
										<th class='text-center hidden-sm hidden-xs'>Address</th>
										<th class='text-center hidden-sm hidden-xs'>Email</th>";
									if($hu==$cu)
									{
									echo"
										<th class='text-center'>Status</th>";
									}
									echo"
									</thead>
									<tbody>
									<form name='attendee' id='attendee'>";
						while($userdata=mysqli_fetch_array($data1))
						{
							$u_id=$userdata['User_ID'];
							$list=mysqli_query($con,"SELECT * FROM `user` WHERE `User_ID`='$u_id'");
							if (mysqli_num_rows($list)>0)
							{        
								while($attendee=mysqli_fetch_array($list))
								{
									$a_rform=mysqli_query($con,"SELECT * FROM `registration` WHERE `Form_ID`=(SELECT `Form_ID` FROM `form` WHERE `Event_ID`='$id') AND `User_ID`='$u_id'");
									$a_rdata=mysqli_fetch_array($a_rform);
									echo "<tr>";
									if($host['User_ID']==$user['id'])
									{
										echo "<td class=''>"; 
										echo "<input type='checkbox' class='center-block event' value='".$userdata['Attendee_ID']."'></td>";
									}
									if($hu==$cu)
									{
										if($a_rdata['Form_Value']!='')
										{
											echo "<td><button data-toggle='modal' class='btn btn-default btn-block'  data-target='.bs-example-modal-lg2' onclick='viewData(this)' form='' value='".$a_rdata['Form_Value']."'>View</button></td>";
										}
										else
										{
											echo "<td><button disabled>View</button></td>";
										}
									}
									echo "<td class='hidden-sm hidden-xs'>".$attendee['User_FirstName']." ".$attendee['User_LastName']."</td>
										  <td class='hidden-sm hidden-xs'>".$attendee['User_Country'].", ".$attendee['User_City']."</td>
										  <td class='hidden-sm hidden-xs'>".$attendee['User_Email']."</td>";
									if($userdata['Status']=='Approved')
									{
										if($hu==$cu)
										{
											echo "<td>".$userdata['Status']."</td>";
										}
									}
									else
									{
										if($hu==$cu)
										{
											if($userdata['Attendee_Title']=='Request')
											{
												if($userdata['Status']=='Pending')
												{
													echo "<td id='respondStatus'><button form='' onclick='updateResponse(this.id)' class='btn btn-default btn-default' id='Approve' value='".$userdata['Attendee_ID']."'>Accept</button><button onclick='updateResponse(this.id)' form='' class='btn btn-default btn-default' id='Decline' value='".$userdata['Attendee_ID']."'>Reject</button></td>";
												}
												else
												{
													echo "<td>".$userdata['Status']."</td>";
												}
											}
											else
											{
												echo "<td>".$userdata['Status']."</td>";
											}
										}
									}
									   echo "</tr>";
								}         
							}
						}
						echo "
								</form>
								</tbody>
								</table>";
								}
						else
						{
							echo "<h4 class='text-center'>No Participants Yet!</h4>";
						}
						?>              
						</div>
					</div>
				</div>
            <!-- /tab panes-->
        </div>
    </section>
		
	<!--add participant modal-->	
	<div id="addparticipants" class="modal fade bs-example-modal-lg3" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		  <div class="modal-dialog modal-md">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" onclick="clearform('form')">
							<span aria-hidden="true">×</span>
							<span class="sr-only">Close</span>
						</button>
						<h2 class="modal-title text-center">Add Participants</h2>
					</div>
					<div class="modal-body">
						<div class="panel panel-default">                       
							<div class="panel-body">
								<form role="form" id="add" action="notification.php" method="POST" name="add">
										<div class="panel-body" id="addd">
										<label for="parts" class="sr-only">Email</label>
										<input type="text" id="parts" name="participants[]" class="form-control" placeholder="eventbox@eventbox.com">
										</div> 
										<button class="btn btn-default" form='' onclick="addparticipants()">Add Participant</button>
										<input type="hidden" name="e_id" value="<?php echo $id; ?>">
										<input class="btn btn-default" type="submit">
								</form>                      
							</div>
						</div>
					</div> <!-- /.modal-content -->
		  </div>
		</div>
	</div>
	<!-- end add participant modal-->
		
	<!-- registration form modal-->
    <div id="registrationForm" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
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
                            <form role="form" id="formDatas" action="participate_event.php" method="GET" name="formDatas" onsubmit="formEventID()">
                                    <div class="panel-body" id="form">
                                    </div> 
                                    <input type="hidden" name="formid">
                                    <input class="btn btn-success center-block" type="submit">
                                </form>                      
                        </div>
                    </div>
                </div> <!-- /.modal-content -->
      		</div>
    	</div>
	</div>
	<!--end registration form modal-->
	
	<!-- event password modal -->
    <div id="eventPassword" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" onclick="clearform('form')">
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
                                    <div class="panel-body" id="form">
                            </div>                            
                        </div>
                    </div>
                </div> <!-- /.modal-content -->
      		</div>
		</div>
	</div>
	<!-- end event password modal -->
	
	<!-- participant details modal -->
    <div id="formData" class="modal fade bs-example-modal-lg2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      	<div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" onclick="clearform('data')">
                        <span aria-hidden="true">×</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h2 class="modal-title text-center">Form Data</h2>
                </div>
                <div class="modal-body">
                    <div class="panel panel-default">                       
                        <div class="panel-body">
                            <form class="form-horizontal">
                            <div class="panel-body" id="data">
                            </div>                        
                            </form>    
                        </div>
                    </div>
                </div> <!-- /.modal-content -->
			</div>
    	</div>
	</div>
	<!-- end participant details modal -->
	
	<!-- start edit event details -->
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
							<!-- start event details form -->
                            <form class="editForm" name="editForm" id="editForm" role="form" method="post" action="edit_event.php" enctype="multipart/form-data"> 
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
                                                    <input type="text" name="title" class="form-control" id="title" placeholder="Event Name" required>
                                                </div>
                                                <div class="col-sm-2 col-md-2">
                                                    <img id="image" hidden="" src="#">
                                                    <input type="file" name="logo" id="logo">
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
                                        <!--start attached file-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="col-sm-2 col-md-2">
                                                    <label for="file">attached details</label>
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
                                                    <input type="password" class="form-control" id="vpassword" placeholder="password" required>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end privacy settings-->
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
                            </form>
							<!-- start event details form -->
                            <hr>
                        </div>
                    </div><!--end content row -->
				</div>
		   </div> <!-- /.modal-content -->
	   </div>
	</div>
	<div id="print" style="display:none"><!-- printable Div -->
	<!-- Boostrap css -->
    <link rel="stylesheet" type="txt/css" href="../../boostrap/css/boostrap.min.css"> 
    <section for="header" class="container">
		<div class="paragraphs">
			<div class="row">
				<div class="span4">
				<?php
				$info=mysqli_query($con,"SELECT * FROM `event` WHERE `Event_ID`='$id'");
				$print=mysqli_fetch_array($info);
				$host=$print['User_ID'];
				$eventhost=mysqli_query($con,"SELECT * FROM `user` WHERE `User_ID`='$host'");
				$hprint=mysqli_fetch_array($eventhost);
			  echo "<img style='float:left; padding-right:10px;'' src='data:;base64,".$print['Event_Logo']."' width='125px;'/>
			  <div class='content-heading'><h2 style='margin:0;'> ".$print['Event_Title']." </h2></div>
				<h4>by ".$hprint['User_FirstName']." ".$hprint['User_LastName']."</h4>
			  <p style=''>".$print['Event_StartMonth']." ".$print['Event_StartDay'].", ".$print['Event_StartYear']." - ".$print['Event_EndMonth']." ".$print['Event_EndDay'].", ".$print['Event_EndYear']." @ ".$print['Event_StartHour'].":".$print['Event_StartMinute']." ".$print['Event_StartCH']." - ".$print['Event_EndHour'].":".$print['Event_EndMinute']." ".$print['Event_EndCH']."</p>
				</div>";
				?>
				<div style="clear:both"></div>
			</div>
		</div>
	</section>
	<br><br>
	<section class="container event">
		<div class="row">
		<div class="col-md-12">
		<table class="table table-bordered text-center" id="printable" border="1" summary="List of Participants">
			<?php
			$attendees=mysqli_query($con, "SELECT * FROM `attendance` WHERE `Event_ID`='$id' AND `Status`='Approved'");
			echo "
			<thead>
				<th class='text-center'> Participant ID </th>
				<th class='text-center'> First Name </th>
				<th class='text-center'> Last Name </th>
				<th class='text-center'> Address </th>
				<th class='text-center'> Email address </th>
			</thead>
			<tbody>";
			while($printA=mysqli_fetch_array($attendees))
			{
			echo "
				<tr> 
					<td> ".$printA['Attendee_ID']."</td>";
					$u_d=$printA['User_ID'];
					$au=mysqli_query($con, "SELECT * FROM `user` WHERE `User_ID`='$u_d'");
					$au_d=mysqli_fetch_array($au);
			echo "  <td> ".$au_d['User_FirstName']." </td>
					<td> ".$au_d['User_LastName']." </td>
					<td> ".$au_d['User_Country'].", ".$au_d['User_City']."</td>
					<td> ".$au_d['User_Email']." </td>
				</tr>";
			}
			echo "</tbody>";
			?>
		</table>
		</div>
		</div>
	</section>
	<section class="container">
		<div class="row">
			<p class="pull-left">Total Participant: <?php echo mysqli_num_rows($attendees) ?></p>
			<p class="text-uppercase pull-right">Produced by <strong>Eventbox</strong></p>
		</div>
	</section>
	</div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/boostrap.min.js"></script>
    <!-- md5 function for javascript -->
    <script src = "http://www.myersdaily.org/joseph/javascript/md5.js"></script>
    <script>

		var count=0;
		var counter=0;
		var json='<?php echo json_encode($event); ?>';
		var editData=JSON.parse(json);
		
		function readURL(input) 
	    {
	    	if (input.files && input.files[0]) 
	    	{
	        	var reader = new FileReader();
	            reader.onload = function (e) 
	            {
	            	$('#image').attr('src', e.target.result);
	            }
	            reader.readAsDataURL(input.files[0]);
	        }
	    }
	    $("#logo").change(function(){
	    	readURL(this);
	    });

		function generateForm(divName,formElemID,labelName){
			var newdiv = document.createElement('div');
			count++;
			switch(formElemID) {
				  case 'name':
					   newdiv.innerHTML ="<div id='"+divName+count+"'><div class='form-group'><label class='col-md-2 col-md-offset-1 control-label' for='"+formElemID+count+"'>"+labelName+"</label><br><br><div class='col-md-5 col-md-offset-1'><input required id='"+formElemID+count+"' name='value[]' type='text' class='form-control' placeholder='First'></div><div class='col-md-5'><input required id='"+formElemID+count+"' name='value[]' type='text' class='form-control' placeholder='Last'></div></div></div><br><br>";
					   break;
				  case 'date':
					   newdiv.innerHTML ="<div id='"+divName+count+"'><div class='form-group'><label class='col-md-2 col-md-offset-1 control-label' for='"+formElemID+count+"'>"+labelName+"</label><br><br><div class='col-md-4 col-md-offset-1'><input class='form-control' id='"+formElemID+count+"' type='date' name='value[]'></div></div></div><br><br>";
					   break;
				  case 'email':
					   newdiv.innerHTML = "<div id='"+divName+count+"'><div class='form-group'><label class='col-md-2 col-md-offset-1 control-label' for='"+formElemID+count+"'>"+labelName+"</label><br><br><div class='col-md-10 col-md-offset-1'><input type='email' required id='"+formElemID+count+"' name='value[]' class='form-control' placeholder='eventbox@eventbox.com'></div></div></div><br><br>";
					   break;
				  case 'address':
					   newdiv.innerHTML = "<div id='"+divName+count+"'><div class='form-group'><label class='col-md-2 col-md-offset-1 control-label' for='"+formElemID+count+"'>"+labelName+"</label><br><br><div class='col-md-5 col-md-offset-1' ><input type='text' required id='"+formElemID+count+"' name='value[]' class='form-control' placeholder='Country'> <input id='"+formElemID+count+"' required name='value[]' type='text' class='form-control event' placeholder='City'></div><div class='col-md-5' ><input required type='text' name='value[]' id='"+formElemID+count+"' class='form-control event' placeholder='Street'></div></div></div><br><br><br><br>";
					   break;
				  case 'text':
					   newdiv.innerHTML = "<div id='"+divName+count+"'><div class='form-group'><label class='col-md-2 col-md-offset-1 control-label' for='"+formElemID+count+"'>"+labelName+"</label><br><br><div class='col-md-10 col-md-offset-1'><input type='text' id='"+formElemID+count+"' name='value[]' class='form-control' placeholder='"+labelName+"'></div></div></div><br><br>";
					   break;
				  case 'textarea':
					   newdiv.innerHTML = "<div id='"+divName+count+"'><div class='form-group'><label class='col-md-2 col-md-offset-1 control-label' for='"+formElemID+count+"'>"+labelName+"</label><br><br><div class='col-md-10 col-md-offset-1'> <textarea id='"+formElemID+count+"' name='value[]' class='form-control' placeholder='Type Here...'></textarea></div></div></div><br><br>";
					   break;
				  case 'link':
					   newdiv.innerHTML = "<div id='"+divName+count+"'><div class='form-group'><label class='col-md-2 col-md-offset-1 control-label' for='"+formElemID+count+"'>"+labelName+"</label><div class='col-md-8'><input type='url' class='form-control' name='value[]' id='"+formElemID+count+"' value='https://'></div></div></div><br><br>";
					   break;
			}
			document.getElementById(divName).appendChild(newdiv);
		}

		function print()
	    {
	    	location.reload();
	        Popup($('#print').html());
	    }

	    var tableToExcel = (function() {
		  var uri = 'data:application/vnd.ms-excel;base64,'
		    , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
		    , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
		    , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
		  return function(table, name) {
		    if (!table.nodeType) table = document.getElementById(table)
		    var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
		    window.location.href = uri + base64(format(template, ctx))
		  }
		})()

	    function Popup(data) 
	    {
	    	var mywindow = window.open('', 'printing');								// opens the printable version on another page
	        mywindow.document.write('<html><head><title>Print</title>');			// title of that page
	        mywindow.document.write('</head><body >');								
	        mywindow.document.write(data);											// the data that is to be printed
	        mywindow.document.write('</body></html>');								
	        mywindow.document.close(); 												// necessary for IE >= 10
	        mywindow.focus(); 														// necessary for IE >= 10
	        mywindow.print();														// prints the data
	        mywindow.close();														// closes the page after print or if canceled
	        return true;
	    }

		function participateForm()
		{
			var form=<?php echo json_encode($form['Form_Order']); ?>;
			var formorder=JSON.parse(form);
			for(var i=0;i<formorder.length;i++)
			{
				generateForm('form',formorder[i][2],formorder[i][1]);
			}
		}
		
		function hideButton(buttonID1,buttonID2)
		{
			document.getElementById(buttonID1).disabled=true;
			document.getElementById(buttonID2).disabled=false;
		}

		window.onload = function() {
			hideButton('trash','edit');
		};
		
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
			}
			else
			{
				document.getElementById("password").style.visibility="Hidden";
				document.getElementById("lpassword").style.visibility="Hidden";
				document.getElementById("vpassword").style.visibility="Hidden";
				document.getElementById("lvpassword").style.visibility="Hidden"; 
				document.getElementById("password").disabled=true;
			}
		}
		
		function formEventID()
		{
			var id=<?php echo $form['Form_ID']; ?>;
			document.forms['formDatas']['formid'].value=id;
		}
		
		function clearform(elementID)
		{
			document.getElementById(elementID).innerHTML = "";
		}
		
		function editEvent()
		{
			document.getElementById("image").src="data:;base64,"+editData.Event_Logo;
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
			var num='a';
			if(editData.Event_Slot==0)
			{
				num='Any';
			}
			numberofparticipants(num);
			privacypassword(editData.Event_Privacy);
		}
		
		function deleteParticipants()
		{
			var form=document.getElementById('attendee').elements;
			var eid=<?php echo $id; ?>;
			var count=0;
			var deleteP=[];
			for(var i=0;i<form.length;i++)
			{
				if(form[i].checked)
				{
					var json=form[i].value;
					var data=JSON.parse(json);
					deleteP[count]=data;
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
					window.location.href = "delete_participants.php?deleteP="+JSON.stringify(deleteP)+"&id="+eid;
				}
				else
				{
					return false;
				}    
			}
		}
		
		function viewData(data)
		{
			var value=JSON.parse(data.value);
			var string="";
			var form=<?php echo json_encode($form['Form_Order']); ?>;
			var formorder=JSON.parse(form);
			var count=0;
			var a=0;
			for(var i=0;i<formorder.length;i++)
			{

				if(formorder[i][1]=='Name')
				{
					count=count+2;
				}
				else
				{
					if(formorder[i][1]=='Address')
					{
						count=count+3;
					}
					else
					{
						count=count+1;
					}
				}
				string=string+"<h4><strong>"+formorder[i][1]+":</strong></h4>";
				while(a<count)
				{
					string=string+value[a]+" ";
					a++;
				} 
				string=string+"";
				a=count;
			}
			var newdiv = document.createElement('div');
			newdiv.innerHTML =""+string;
			document.getElementById('data').appendChild(newdiv);
		}
		
		function updateResponse(response)
		{
			var id=document.getElementById(response).parentNode.id;
			document.getElementById(id).innerHTML="<p>"+response+"</p>";
		}
		function registrationCheck()
		{
			<?php 
				$uid=$user['id'];
				$check=mysqli_query($con,"SELECT * FROM `attendance` WHERE `Event_ID`='$id' AND `User_ID`='$uid'");
			?>
			var chk='<?php echo mysqli_num_rows($check); ?>';
			if(chk==0)
			{
				return true;
			}
			else
			{
				alert("Your Have Already Registered. Please wait for the organizer's Response...");
				return false;
			}
		}
		function conflict()
		{
			<?php
			 	$cU=$_SESSION['user']['id'];
				$conflict=mysqli_query ($con,"SELECT * FROM `attendance` LEFT JOIN `event` ON `attendance`.`Event_ID`=`event`.`Event_ID` WHERE `attendance`.`User_ID`='$cU'");
				$i=0;
				while($data=mysqli_fetch_array($conflict))
				{
					$conf[$i]=$data;
					$i++;
				}
			?>
			var conflict='<?php echo json_encode($conf); ?>';
			var date=JSON.parse(conflict);
			var sCH=editData.Event_StartHour;
			var eCH=editData.Event_EndHour;
			if(editData.Event_StartCH=='PM')
			{
				sCH=+12;
			}
			if(editData.Event_EndCH=='PM')
			{
				eCH=+12;
			}
			if(date!=null)
			{
				var esdate=new Date(Date.parse(editData.Event_StartMonth+" "+editData.Event_StartDay+", "+editData.Event_StartYear+" "+sCH+":"+editData.Event_StartMinute));
				var eedate=new Date(Date.parse(editData.Event_EndMonth+" "+editData.Event_EndDay+", "+editData.Event_EndYear+" "+eCH+":"+editData.Event_EndMinute));
				for(var i=0;i<date.length;i++)
				{
					var cesdate=new Date(Date.parse(date[i].Event_StartMonth+" "+date[i].Event_StartDay+", "+date[i].Event_StartYear));
					var ceedate=new Date(Date.parse(date[i].Event_EndMonth+" "+date[i].Event_EndDay+", "+date[i].Event_EndYear));
					if(cesdate.getTime()<esdate.getTime() || eedate.getTime()<cesdate.getTime() && ceedate.getTime()<esdate.getTime() || eedate.getTime()<ceedate.getTime())
					{
					}
					else
					{
						alert("There seems to be a conflcit with your schedule!");
						return false;
					}
				}
			}
		}
		function privatePassword(status)
		{
			if(conflict()==false)
			{
				return false;
			}
			if(registrationCheck()==false)
			{
				return false;
			}
			if(status!='Approved')
			{
				if(editData.Event_Privacy!='private')
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
				alert("You are already a Participant for this Event!");
				return false;
			}
		}
		
		function checkPass()
		{
			var pass=document.getElementById("privacypass").value;

			if(md5(pass)!=editData.Event_Password)
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
		
		function addparticipants()
		{
			var decode=JSON.parse(json);
			if(decode.Event_Slot!=0)
			{
				if (counter == decode.Event_Slot)  
				{
					alert("You have reached the limit of adding " + counter + " inputs");
					return;
				}
			}
			var newdiv = document.createElement('div');
			newdiv.innerHTML = "<br><input type='text' placeholder='eventbox@eventbox.com' class='form-control' name='participants[]'>";
			document.getElementById('addd').appendChild(newdiv);
			counter++;
		}
		
		$(document).ready(function () {
			$(".button").click(function(){
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

		$(document).ready(function () {
			$("input#submit").click(function(){
				$.ajax({
					type: "POST",
					url: "edit_event.php",
					data: $('form.editForm').serialize(),
					success: function(){
						$("#full-width").modal('hide');
						location.reload();
					},
					error: function(){
						alert("Failed to Edit! Try Again Later..");
						return;
					}
				});
			});
		});
	
	</script>


</body>
</html>
