
<!DOCTYPE html>
<html lang="en">


<?php 
session_start();
include 'functions.php';

$userstr = ' (Guest)';

if (isset($_SESSION['user']))
{
    $user     = $_SESSION['user'];
    $loggedin = TRUE;
    $userstr  = " ($user)";
}
else $loggedin = FALSE;
?>

<head>
<?php
echo "<title>$appname$userstr</title>";
?>

<script src='OSC.js'></script>
<link href="bootstrap/css/bootstrap.css" rel="stylesheet">
<style type="text/css">
  body {
	padding-top: 60px;
	padding-bottom: 40px;
	padding-left: 100px;
  }
  
</style>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
</head>

<body>
<?php #echo "<body><div class='appname'>$appname$userstr</div>"; ?>


<div class="navbar navbar-inverse navbar-fixed-top">
  <div class="navbar-inner">
	<div class="container">
	  <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	  </a>
	  <a class="brand" href="index.php">Connect You</a>
	  <div class="nav-collapse collapse">
		<ul class="nav">
<?php if ($loggedin) { ?>
		  <li class="active"><a href='members.php?view=$user'>Home</a></li>
		  <li><a href='members.php'>Members</a></li>
		  </ul>
		</div><!--/.nav-collapse -->
	</div>
	</div>
</div>
<div class="container-fluid">
      <div class="row-fluid" >
			<div class="span3">
			  <div class="well sidebar-nav">
				<ul class="nav nav-list">
				  <li class="nav-header">Favorites</li>
				  <li><a href='friends.php'>Friends</a></li>
				  <li><a href='newsfeed.php'>News Feed</a></li>
				  <li><a href='messages.php'>Messages</a></li>
				  <li class="nav-header">Manage</li>
				  <li><a href='profile.php'>Profile</a></li>
				  <li><a href='contest.php'>Game/Schdule</a></li>
				  <li><a href='logout.php'>Log out</a></li></ul><br />
				</ul>
			  </div><!--/.well -->
			</div>
			
<?php 
}
else
{ ?>

	  <li class="active"><a href="login.php">Login</a></li>
	  <li><a href="signup.php">Register</a></li>
	  
	  </ul>
		</div><!--/.nav-collapse -->
	</div>
	</div>
</div>
<?php } ?>
<div class='span8'">

