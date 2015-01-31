<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Eventbox Documentation</title>    
    <link rel="stylesheet" type="txt/css" href="../src/bootstrap/css/bootstrap.min.css">   
    <link rel="stylesheet" type="txt/css" href="../src/css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="../src/scripts/js/function.js"></script>
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
					<h3 style="margin-top:0;">Approving Request</h3>
					<hr>
						<p> You may approve or deny a request sent by participants. The request list can be found the your event details page. </p>
					<hr>
					<div class="row">
						<div class="col-md-6">
							<a href="send_request_module.php" class="btn btn-default">back</a>
						</div>
						<div class="col-md-6">
							<a href="#" class="btn btn-default pull-right">next</a>
						</div>
					</div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>