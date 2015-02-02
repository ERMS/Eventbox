
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
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Eventbox</title>

    <!-- Boostrap css -->
    <link rel="stylesheet" type="txt/css" href="boostrap/css/boostrap.min.css"> 
    <!-- Customize css -->
    <link rel="stylesheet" type="txt/css" href="css/style.css">

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
                <a class="navbar-brand" href="index.php"><img src="images/eventbox-logo.png" width="150px"/></a>
            </div>
            <div class="collapse navbar-collapse navbar-right">
                <ul class="nav navbar-nav">                    
                    <li class="text-center">
                        <p class="navbar-text"><a href="scripts/php/login_form.php" class="navbar-link" >Sign In</a> </p>
                    </li>
                    <li align="center"> 
                        <p class="navbar-text"><a href="scripts/php/register_form.php" class="navbar-link">Sign Up For Free!</a></p>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Navigation -->
    
    <section role="content">
        <div class="carousel fade-carousel slide" data-ride="carousel" data-interval="4000" id="bs-carousel">
          <!-- Overlay -->
            <div class="overlay"></div>

          <!-- Indicators   -->
            <ol class="carousel-indicators">
                <li data-target="#bs-carousel" data-slide-to="0" class="active"></li>
                <li data-target="#bs-carousel" data-slide-to="1"></li>
                <li data-target="#bs-carousel" data-slide-to="2"></li>
            </ol>
        
          <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="hero">
                    <h3>Welcome to EventBox</h3>
                    <hgroup>
                        <h1>Fuel up your passion</h1>        
                        <h4> & let it burn within </h4>
                    </hgroup>
                    <a href="scripts/php/home.php" class="btn btn-hero btn-lg" role="button">Search Events!</a>
                </div>

                <!-- slide images -->
                <div class="item slides active">
                    <div class="slide-1">

                    </div>
                </div>
                <div class="item slides">
                    <div class="slide-2">

                    </div>
                </div>
                <div class="item slides">
                    <div class="slide-3">

                    </div>
                </div>
           </div> 
        </div>
    </section>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="scripts/js/boostrap.min.js"></script>

</body>
</html>