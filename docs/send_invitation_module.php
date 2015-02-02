
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
					<h2 style="margin-top:0;">Sending Invitation</h2>
					<hr>
					<p> You can send directly an invitation to your friends throung email. </p>
					<img src="images/Sending_Invitation.jpg" alt="" width="100%">
					<p> Fill the input with email address of your friends. You can also invite more one at a time by clicking add participant button. </p>
					<img src="images/Sending_Invitation3.jpg" alt="" width="80%">
					<p> If you dont feel to invite someone, you may skip the page by clicking the skip button. </p>
					<p> After filling up the inputs, it will link to to another page that shows all the details of your event details, and list of invited participant. </p>
						<img src="images/show%20details.jpg" alt="" width="100%">
					<p>If you are already confident that everything is good to go, click done and it will send notification to the one who you invited to be part of the event.</p>
					<hr>
					<div class="row">
						<div class="col-md-6">
							<a href="create_registration_form_module.php" class="btn btn-default">back</a>
						</div>
						<div class="col-md-6">
							<a href="approve_invitation_module.php" class="btn btn-default pull-right">next</a>
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