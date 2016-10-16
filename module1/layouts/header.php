<!doctype html>
<html>
	<head>
		<title>
			Chimpkiller
		</title>
		<link rel="stylesheet" href="public/css/bootstrap.min.css"/>

		  <style>
    /* Remove the navbar's default margin-bottom and rounded borders */
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }

    .navbar-inverse .navbar-nav>li>a:focus, .navbar-inverse .navbar-nav>li>a:hover,.navbar-inverse .navbar-brand:focus, .navbar-inverse .navbar-brand:hover{
      color: black;
    }

    
    main{
    	padding:50px;
    }

    .navbar-menu{
    	margin:0 auto;
    }

    .nav>li>a:focus, .nav>li>a:hover{
    	background:none;
    	color: black;
    }

    .navbar-menu > li{
    	float:left;
    	padding: 10px 0px;
    }

    .navbar-menu > li >a{
    	padding:5px 40px;
    	color:white;
    }

   	.navbar-inverse{
   		background: none;
   		border: none;
   	}

    .nav-c{
    	background-color: grey;
    }

    .nav-c .nav{
    	position: relative;
    	display: inline-block;
    	    left: 50%;
    transform: translateX(-50%);
    }

    .navbar-menu > li:not(:first-child) >a{
    	border-left:1px solid black;
    }

    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    .row.content {height: 450px}
    
    /* Set gray background color and 100% height */
    .sidenav {
      padding-top: 20px;
      background-color: #f1f1f1;
      height: 100%;
    }
    
    /* Set black background color, white text and some padding */
    footer {
      background-color: #555;
      color: white;
      padding: 15px;
    }
    
    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height:auto;}
    }
  </style>
	</head>
	<body>
	<div class="container">

	<nav class="navbar navbar-inverse">
	  <div class="container-fluid">
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      <a class="navbar-brand" href="index.php">CHIMP KILLER</a>
	    </div>
	    <div class="collapse navbar-collapse" id="myNavbar">
	      <ul class="nav navbar-nav">

	      </ul>
	      <ul class="nav navbar-nav navbar-right">
	      	<?php if(isset($_SESSION['user_id'])){?>
	        	<li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
	        <?php } else { ?>
	        	<li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
	        	<li><a href="register.php"><span class="glyphicon glyphicon-log-in"></span> Register</a></li>
	        <?php } ?>
	      </ul>
	    </div>
	  </div>
	</nav>
		    <?php if(isset($_SESSION['user_id'])){?>
		    <div class="nav-c">
			    <ul class="nav navbar-menu">
			      <li><a href="profile.php">Profile</a></li>
			      <li><a href="send.php">Send email</a></li>
			      <li><a href="contacts.php">Contacts</a></li>
			      <li><a href="messages.php">History</a></li>
			    </ul>
			</div>
		    <?php }?>
    <main>