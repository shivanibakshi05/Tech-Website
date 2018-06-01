<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">	
<title>Login</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<link href="js-form-validation.css" rel="stylesheet">
</head>
<body>

<div class="container">
	<form class="form-horizontal" action="" method="POST">
		<div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <h2>Login</h2>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 field-label-responsive">
                <label for="email">Username </label>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                        <div class="input-group-addon" style="width: 2.6rem"><i class="fa fa-at"></i></div>
                        <input type="text" name="user" class="form-control" id="email" placeholder="you@example.com" required autofocus>
                    </div>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
        <div class="row">
            <div class="col-md-3 field-label-responsive">
                <label for="pass">Password </label>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                        <div class="input-group-addon" style="width: 2.6rem"><i class="fa fa-key"></i></div>
                        <input type="password" name="pass" class="form-control" id="pass" placeholder="Password" required>
                    </div>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <button type="submit" name="submit" class="btn btn-success"><i class="fa fa-user-plus"></i> Login</button>
            </div>
        </div>
    </form>
</div>
<?php 
if (isset($_POST['submit'])) {
	if(!empty($_POST['user']) && !empty($_POST['pass'])) {
		global $con;
		$con=mysqli_connect('localhost','root','','innerve') or die(mysqli_error($con));
		mysqli_select_db($con,'innerve') or die("cannot select DB");
		
		$user=mysqli_real_escape_string($con,$_POST['user']);
		$pass=mysqli_real_escape_string($con,$_POST['pass']);
		$encrypt_password=md5($pass);

		$query="SELECT * FROM registration WHERE Email='$user' AND Password='$encrypt_password'";
		global $rowcount;
		if($res=mysqli_query($con,$query)) {
			$rowcount=mysqli_num_rows($res);
			//printf("Result set has %d rows.\n",$rowcount);
			// Free result set
			mysqli_free_result($res);
		}
		if($rowcount!=0) {
			session_start();
			$_SESSION['user']=$user;    
			header("Location: member.php");
		}
		else {
			echo "<h6>Invalid username or password!</h6>";
		}
	} 
	else {
		echo "<h6>All fields are required!</h6>";
	}
}
?>
<div class="container">
	<div class="row">
		<div class="col-md-3"></div>
        <div class="col-md-6">
        	<p><a href="register.php">Register</a> | <a href="login.php">Login</a></p>
        </div>
	</div>
</div>
</body>
</html>