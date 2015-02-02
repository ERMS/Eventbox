
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
                <a href="search.php"><img src="../src/images/eventbox-logo.png"  width="210px;"/></a>
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
					<h3 style="margin-top:0;">Sending Request</h3>
					<hr>
						<p> You can also be a participant by joining an event. Go to the page of the event and click join button. You can be part of the event depending on its privacy setting. </p>
						<img src="images/send_request.jpg" width="90%" alt="">
						<p> When the event is set to public, you are able to be part of the event without sending request from the organizer. <br> If the event is set as default, it will send a request to the organizer and if set set to private, it requires a password. Both of them  will send a request to the organizer. The organizer may either approve or disregard your request. </p>
						<p> Upon sending a request, the organizer will be notified through his/her email. </p>
					<hr>
					<div class="row">
						<div class="col-md-6">
							<a href="approve_invitation_module.php" class="btn btn-default">back</a>
						</div>
						<div class="col-md-6">
							<a href="approve_request_module.php" class="btn btn-default pull-right">next</a>
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