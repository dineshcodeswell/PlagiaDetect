<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Plagiarise detection</title>
	<meta name="description" content="Plagiarise detection">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
</head>
	<style>
	body{
		padding-top:40px;
	}
	</style>
<body data-spy="scroll" data-target="#my-navbar"><!--Navbar-->
	<nav class ="navbar navbar-inverse navbar-fixed-top" id="my-navbar"> 
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>

				<a href="" class="navbar-brand">Plagiarise Catcher</a>
			</div><!--Navbar header-->
			<div class="collapse navbar-collapse" id="navbar-collapse">
			
				<ul class="nav navbar-nav">
					<li><a href="#faq">Time to code</a>
				</ul>
			</div>
		</div><!--Navbar contaiiner-->
	</nav><!--Navbar -->
	<div  class="jumbotron" >
		<div class="container text-center" >
			
			<h2 >Results of Plagiarism Analysis</h2>

			
		</div>
	</div>
	<div class="container text-center">
		<?php
$host="localhost"; //replace with database hostname 
$username="root"; //replace with database username 
$password=""; //replace with database password 
$db_name="dineshdeba"; //replace with database name

$con=mysqli_connect("$host", "$username", "$password","$db_name")or die("cannot connect"); 
mysqli_select_db($con,"$db_name")or die("cannot select DB");

$totextnumb=2;

if (isset($_POST["username"]))
{
  $user = $_POST["username"];
} 
else 
{
  $user = null;
  
}

if (isset($_POST["password"]))
{
  $pass = $_POST["password"];
} 
else 
{
  $pass = null;
  
}

if (isset($_POST["test"]))
{
  $totext = $_POST["test"];
} 
else 
{
  $totext = null;
  
}
$totext = str_replace('\'', '', $totext);
$totext = preg_replace('/\s+/', '', $totext);

$sql=mysqli_query($con,"select * from file where quesno='{$totextnumb}'");
if(mysqli_num_rows($sql)){
	while($row=mysqli_fetch_assoc($sql)){
		$secondtext=$row["text"];
		$seconduser=$row["username"];
		similar_text( $totext,$secondtext, $percent);
		echo "Percentage similarity of $user with $seconduser is $percent </br>";
		mysqli_query($con,"insert into xyz(quesno,user1,user2,percent) values('{$totextnumb}','{$user}','{$seconduser}','{$percent}')");
}
}
mysqli_query($con,"insert into file(quesno,username,password,text) values('{$totextnumb}','{$user}','{$pass}','{$totext}')");
mysqli_close($con);
?>






	</div>
<!--
	<div class="container">
<style type="text/css">
.bar
{
    background-color: green;
    position: relative;
    height: 16px;
    margin-top: 8px;
    margin-bottom: 8px; 
}
</style>
<div id="barcontainer" style="width:200px;">
    <div id="bar1" class="bar" style="width:43%;"></div>
    <div id="bar2" class="bar" style="width:12%;"></div>
    <div id="bar3" class="bar" style="width:76%;"></div>
    <div id="bar4" class="bar" style="width:100%;"></div>
</div>
</div>
	<!-- Footer -->

    <footer>
      <hr>
        <div class="container text-center">
        <h3>Subscribe for more free stuff</h3>
        <p>Enter your name and email</p>

        <form action="" class="form-inline">
          <div class="form-group">
            <label for="subscription">Subscribe</label>
            <input type="text" class="form-control" id="subscription" placeholder="Your name">
          </div>
          <div class="form-group">
            <label for="email">Email address</label>
            <input type="text" class="form-control" id="email" placeholder="Enter your Email">
          </div>
          <button type="submit" class="btn btn-default">Subscribe</button>
          
        </form>

        <hr>
        <ul class="list-inline">
          <li><a href="http://www.twitter.com/wiredwiki">Twitter</a></li>
          <li><a href="http://www.facebook.com/askorama">Facebook</a></li>
          <li><a href="http://www.youtube.com/wiredwiki">YouTube</a></li>
        </ul>

        <p>&copy; Copyright @ 2014</p>

      </div><!-- end Container-->
      

    </footer>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>  
</body>
</html>
