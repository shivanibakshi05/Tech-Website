<?php 
session_start();
if(isset($_SESSION['user'])) {
?>
<!doctype html>
<html>
<head>	
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Member</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<link href="js-form-validation.css" rel="stylesheet">
</head>
<body>
<br />	
<?php echo "<h6><em>Welcome, ".$_SESSION['user']."!</em></h6>";?>
<br />
<h6>Welcome to the member area!</h6>
<div class="container">
	<div class="row">
		<div class="col-md-3">
			<p><a href="logout.php">Logout</a></p>
		</div>
        <div class="col-md-6"></div>
	</div>
</div>
</body>
</html>
<?php
}
else
{
echo "<h6>Please Login First!</h6> <p><a href='login.php'>Login</a></p>";
}
?>