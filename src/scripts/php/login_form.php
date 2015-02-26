
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

<!--  PHP session  -->
<?php
    include "class.php";

    $con = connectdb();

    session_start();

    if(isset($_GET['verify']))
    {
        if(isset($_SESSION['verified']))
        {   
            $ver=$_SESSION['verified'];
            if($_GET['verify']==$ver->U_email)
            {
                $dup=mysqli_query($con,"SELECT * FROM `user` WHERE `User_Email`='$ver->U_email'");
                if(mysqli_num_rows($dup)==0)
                {
                    $ver->RegisterAccount();
                }
            }
        }
    }

    if(isset($_GET['data']))
    {
        $_SESSION['mail']=$_GET['data'];
        $_SESSION['eid']=$_GET['id'];
        $mail=$_SESSION['mail'];
        
        $check=mysqli_query($con,"SELECT `User_ID` FROM `user` WHERE `User_Email`='$mail'");
        if(mysqli_num_rows($check)<=0)
        {
            unset($_SESSION['user']);
            header("location:register_form.php");
        }
    }

    if (isset($_SESSION['user']))
    {
        $mail=$_SESSION['mail'];
        $query=mysqli_query($con,"SELECT `User_ID` FROM `user` WHERE `User_Email`='$mail'");
        $data=mysqli_fetch_array($query);

        if(isset($_SESSION['eid']))
        {
            if(mysqli_num_rows($query)<=0)
            {
                unset($_SESSION['user']);
                header("location:register_form.php");
            }
            if($_SESSION['user']['id']==$data['User_ID'])
            {
                header("location:my_event.php?invite=invited");
            }
            else
            {
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
        <div class="container">
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
                                    $password=md5($_POST['key']);
                                    $query=mysqli_query ($con, "SELECT * FROM user WHERE User_Email='$email' AND User_Password='$password'");
                                    $id=mysqli_fetch_array($query);
                                    if (mysqli_num_rows($query)>0)
                                    {
                                        $_SESSION['user']=array('id'=>$id['User_ID'],'name'=>$id['User_FirstName']." ".$id['User_LastName'],'pic'=>$id['User_ProfilePicture']);
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

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="scripts/js/boostrap.min.js"></script>

</body>
</html>
