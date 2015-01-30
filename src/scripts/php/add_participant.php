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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Eventbox</title>    
    <link rel="stylesheet" type="txt/css" href="../../bootstrap/css/bootstrap.min.css">   
    <link rel="stylesheet" type="txt/css" href="../../css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="../js/function.js"></script>
</head>
	
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
                <a class="navbar-brand" href="../../../src/index.php"><img src="../../images/eventbox-logo.png" width="175px"/></a>
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
	
	
    <div class="container event">
        <div class="row">
            <div class="col-md-12">                
                <div class="row"><!--content header-->
                    <div class="col-md-8">
                        <h2>Invite Participant <small>Step 3 of 4</small></h2>
                    </div>
                    <div class="col-md-4">
                        <a href="home.php" class="event btn btn-default pull-right">Cancel</a>                        
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

</body>
</html>
