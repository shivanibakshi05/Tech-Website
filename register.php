<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Register</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="form-validation.js"></script>
<link href="js-form-validation.css" rel="stylesheet">
</head>
<body onLoad="document.myForm.fullname.focus();">

<div class="container">
	<form class="form-horizontal" name="myForm" id="myForm" method="POST" action="register.php" onSubmit="return formValidation();">
		<div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <h2>Register New User</h2>
                <hr>
            </div>
        </div>
		<div class="row">
            <div class="col-md-3 field-label-responsive">
                <label for="name">Name </label>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                        <div class="input-group-addon" style="width: 2.6rem"><i class="fa fa-user"></i></div>
                        <input type="text" name="fullname" class="form-control" id="fullname" placeholder="Full Name" required autofocus>
                    </div>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
        <div class="row">
            <div class="col-md-3 field-label-responsive">
                <label for="email">E-Mail Address </label>
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
                <label for="univ">University Name </label>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                        <div class="input-group-addon" style="width: 2.6rem"><i class="fa fa-university"></i></div>
                        <input type="text" name="univ" class="form-control" id="univ" placeholder="University Name" required autofocus>
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
            <div class="col-md-3 field-label-responsive">
                <label for="phone">Phone Number </label>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                        <div class="input-group-addon" style="width: 2.6rem"><i class="fa fa-phone"></i></div>
                        <input type="text" name="phone" class="form-control" id="phone" placeholder="555-555-5555" required autofocus>
                    </div>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
		<div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <button type="submit" name="submit" class="btn btn-success"><i class="fa fa-user-plus"></i> Register</button>
            </div>
        </div>
	</form>
</div>
<?php 
if (isset($_POST['submit'])) {
	if(!empty($_POST['fullname']) && !empty($_POST['user']) && !empty($_POST['univ']) && !empty($_POST['pass']) && !empty($_POST['phone'])) {
	// Connect to server
		global $con;
		$con=mysqli_connect('localhost','root','','innerve') or die(mysqli_error($con));
		mysqli_select_db($con,'innerve') or die("cannot select DB");
		
		$fullname=mysqli_real_escape_string($con,$_POST['fullname']);
		$user=mysqli_real_escape_string($con,$_POST['user']);
		$univ=mysqli_real_escape_string($con,$_POST['univ']); 
		$pass=mysqli_real_escape_string($con,$_POST['pass']);
		$phone=mysqli_real_escape_string($con,$_POST['phone']);

		$query="SELECT * FROM registration WHERE Email='".$user."'";
		global $rowcount;
		if($res=mysqli_query($con,$query)) {
			$rowcount=mysqli_num_rows($res);
			// printf("Result set has %d rows.\n",$rowcount);
			// Free result set
			mysqli_free_result($res);
		}
		if($rowcount==0) {
		//md5() calculates the MD5 hash of a string
			$encrypt_password=md5($pass);
			$sql="INSERT INTO registration(Name,Email,University,Password,Phone_Number) VALUES ('$fullname','$user','$univ','$encrypt_password','$phone')";
			$result=mysqli_query($con,$sql);
			if($result!=1) {
				echo "<h6>Failed To Create Account!</h6>";
			}
			else {
				echo "<h6>Account Successfully Created!</h6>";
			}
		} 
		else {
			echo "<h6>Username already exists! Please try again with another.</h6>";
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