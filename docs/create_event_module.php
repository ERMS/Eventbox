
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

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Eventbox Documentation</title>   
	 
     <!-- Boostrap css -->
    <link rel="stylesheet" type="txt/css" href="../src/boostrap/css/boostrap.min.css">
    <!-- Customize css -->
    <link rel="stylesheet" type="txt/css" href="../src/css/style.css">

</head>
<body>
    
    
    <nav class="navbar navbar-inverse navbar-fixed-top" style="height:70px;" role="navigation">
     <div class="navbar-inner">
            <div class="nav-center navbar-fixed-bottom">
                <a href="index.html"><img src="../src/images/eventbox-logo.png"  width="210px;"/></a>
            </div>
        </div>
    </nav>
    
    <section class="event container" style="padding-top:20px">
        <div class="center-block">
            <div class="row">
                <div class="col-md-3">
                    <a href="index.html" class="btn btn-primary btn-block center-block">Home</a>
					<h2 class="text-center">Modules</h2>
                    <a href="create_event_module.php" class="btn btn-default btn-block center-block">Create Event</a>
                    <a href="create_registration_form_module.php" class="btn btn-default btn-block center-block">Create Registration Form</a>
                    <a href="send_invitation_module.php" class="btn btn-default btn-block center-block">Send Invitation</a>
                    <a href="approve_invitation_module.php" class="btn btn-default btn-block center-block">Approve Invitation</a>
					<a href="send_request_module.php" class="btn btn-default btn-block center-block">Send Request</a>
                    <a href="approve_request_module.php" class="btn btn-default btn-block center-block">Approve Request</a>
					<hr>
					<a class="btn btn-default btn-block center-block">Add your new module! </a>
                </div>
				<div class="col-md-9">
					<h2 style="margin-top:0;">Managing Event</h2>
					<hr style="">
					<p> Managing Event is a module where organizer is able to <em>create</em>, <em>delete</em>, and <em>edit </em>  event information and its participant list </p>
					<div class="row">						
						<div class="col-md-12">
							<h3> Creating Event </h3>
							<p> After signing in eventBox, you will be link directly to your profile. Click the Create New Event button found at the right side of your profile and you will be linked to create event page.</p>
							<img src="images/create_Event.jpg" class="image-responsive" alt="" width="100%">
							<p> The image above is the page where you will fill the necessesary information of your event. Note that <strong> ALL FIELD is REQUIRED to BE FILLED</strong>. </p>
							<p> Let us understand the details of every field in the form.</p>
							<h4><strong>Event Details</strong></h4>
							<ul>
								<li><strong>Event Title </strong> - The title of the event</li>
								<li><strong>Event Logo </strong> - the logo of the event. The size of the image must be 100px x 100px</li>
								<li>
									<strong>Date </strong>
									<ul>
										<li> From - date when the event start</li>
										<li> Until - date when the event will end  </li>
									</ul>
								</li>
								<li>
									<strong>Time</strong>
									<ul>
										<li> Start - time when the event will start </li>
										<li> End - time when the event will start</li>
									</ul>
								</li>
								<li><strong>Event Decription</strong> - the description of the event. </li>
								<li>
									<strong>Event Venue</strong>
									<ul>
										<li> Country - country of the venue of the event</li>
										<li> State - state of the venue of the event </li>
										<li> City - city of the venue of the event </li>
										<li> Street - street of the venue of the event </li>
									</ul>
								</li>
							</ul>
							<img src="images/create_Event_2.jpg" class="image-responsive" alt="" width="100%">
							<ul>
								<li><strong>Application Deadline</strong> - deadline of registration</li>
								<li>
									<strong>Number of Participant</strong>
									<ul>
										<li> Any - there is no limited slot</li>
										<li> Specific - there is limited slot </li>
									</ul>
								</li>
								<li><strong>Contact Number</strong> - contact number of the organizer</li>
								<li><strong>Attached File</strong> - file attached by the organizer.</li>
							</ul>
							<h4><strong>Privacy Setting</strong></h4>
							<ul>
							<li>
								<strong>Event Privacy</strong>
								<ul>
									<li> public - the event is open to all participants</li>
									<li> default - the event requires approval form the organizer </li>
									<li> private - the event requires password and approval from the organizer</li>
								</ul>
								<li>
									<strong>Event Status</strong>
									<ul>
										<li> Offline - the event is not yet publish to the public </li>
										<li> Online - the event is publish to the public and participant are able to register </li>
									</ul>
								</li>
							</li>
							</ul>
						<p> After filling up the required fields, you can now proceed to create your own registration form.  </p>
						</div>
					</div>
					<div class="row">
						<h3>Edit Event Details</h3>
						<p> Edit your event details by clicking edit button found top right of the table. A modal will appear and you may start editing the details of your event. Make sure you have only selected 1 event. </p>
						<img src="" alt="" widht="100%">
					</div>
					<div class="row">						
						<h3>Deleting Event</h3>	
						<p> Delete your event event details by clicking delete button found top right of the table. A confirmation message will appear after clinking the button. You may able to select all event or choose event to delete. </p>
						<img src="" alt="" widht="100%">
					</div>	
					<div class="row">
						<h3>Deleting Participant </h3>
						<p>You may able to delete a participant that joined in your event. Go to your event page, click the participant tab and select a participant. You may select all participants in your list or choose participant to delete.</p>
						<img src="" alt="" widht="100%">
					</div>	
					<hr>
					<div class="row">
						<div class="col-md-6">
							<a href="index.html" class="btn btn-default">Back</a>
						</div>
						<div class="col-md-6">
							<a href="create_registration_form_module.php" class="btn btn-default pull-right">next</a>
						</div>
					</div>
                </div>
            </div>
        </div>
    </section>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../src/scripts/js/boostrap.min.js"></script>

</body>
</html>