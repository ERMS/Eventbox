<!--  PHP session  -->
<?php
include "connectdb.php";
$con = connectdb();
session_start();
if(isset($_GET['data']))
{
    $_SESSION['mail']=$_GET['data'];
    $_SESSION['id']=$_GET['id'];
    $mail=$_SESSION['mail'];
    $check=mysqli_query($con,"SELECT `User_ID` FROM `user` WHERE `User_Email`='$mail'");
    if(mysqli_num_rows($check)<=0)
    {
        header("location:register_form.php");
    }
}
if (isset($_SESSION['user']))
{
    $id=$_SESSION['id'];
    $mail=$_SESSION['mail'];
    $query=mysqli_query($con,"SELECT `User_ID` FROM `user` WHERE `User_Email`='$mail'");
    $data=mysqli_fetch_array($query);
    if(isset($_SESSION['id']))
    {
        if($_SESSION['user']['id']==$data['User_ID'])
        {
            header("location:my_event.php?invite=invited");
        }
        else
        {
            unset($_SESSION['mail']);
            unset($_SESSION['id']);
            header("location:my_event.php");
        }
    }
    else
    {
        header("location:my_event.php");
    }
}
?>
<!--  PHP session End  -->
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Eventbox</title>
    <meta charset="utf-8"> 
    <link rel="stylesheet" type="txt/css" href="../../bootstrap/css/bootstrap.min.css">   
    <link rel="stylesheet" type="txt/css" href="../../css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="../js/function.js"></script>
</head>
<body>
    
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" style="height:100px;" role="navigation">
     <div class="navbar-inner">
            <div class="nav-center navbar-fixed-bottom">
                <a href="../../index.php"><img src="../../images/eventbox-logo.png"  width="210px;"/></a>
            </div>
        </div>
    </nav>
	<!-- end Navigation -->
	
	<!-- Login Content -->
    <section id="login">
        <div class="container"> <!-- Start Session -->
            <div class="form-wrap">
                <div class="row">
                    <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <h1>Log in</h1>
                                <!--  PHP login  -->
                                <?php
                                if(isset($_POST['email'])&&isset($_POST['key']))
                                {
                                    $email=$_POST['email'];
                                    $password=$_POST['key'];
                                    $query=mysqli_query ($con, "SELECT * FROM user WHERE User_Email='$email' AND User_Password='$password'");
                                    $id=mysqli_fetch_array($query);
                                    if (mysqli_num_rows($query)>0)
                                    {
                                        $_SESSION['user']=array('id'=>$id['User_ID'],'name'=>$id['User_FirstName']." ".$id['User_LastName']);
                                        header("location:login_form.php");
                                    }
                                    else
                                    {
                                        echo "<div class='alert alert-danger' role='alert'>
                                              <span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span>
                                              <span class='sr-only'>Error:</span>
                                              Invalid Username or Password
                                              </div>";
                                    }
                                }
                                ?>
                                <!--  PHP login End  -->
                                <hr>
								
								<!-- Start Login Form -->
                                <form role="form" action="login_form.php" method="post" id="login-form"  autocomplete="off">
                                    <div class="form-group">
                                        <label for="email" class="sr-only">Email</label>
                                        <input type="email" name="email" id="email" class="form-control " placeholder="somebody@example.com">
                                    </div>
                                     <div class="row" style="display:block">
                                        <div class="col-xs-12">
                                     <a href="" class="forget pull-right" data-toggle="modal" data-target=".forget-modal">Forgot your password?</a>
                                         </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="key" class="sr-only">Password</label>
                                        <input type="password" name="key" id="key" class="form-control " placeholder="Password">
                                    </div>
                                    <div class="row">                                   
                                        <div class="col-xs-12">
                                            <input type="submit" id="btn-login" class="btn btn-custom btn-block" value="Sign In">
                                        </div>
                                         <div class="col-xs-12">
                                            <a href="register_form.php" id="btn-login" class="btn-block" value="" style=" text-align:center;">Sign Up For Free!</a>
                                        </div>
                                    </div>
                                </form>
								<!-- Start Login Form -->
								
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end container -->
	</section>
	<!-- Login Content -->
	
</body>
</html>
