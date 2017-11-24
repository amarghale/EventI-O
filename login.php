<?php
session_start();

if(isset($_SESSION['user_session']) != "")
{
	header("Location: admin-panel.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login</title>
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="css/bootstrap-theme.min.css" rel="stylesheet" media="screen"> 
<script type="text/javascript" src="js/jquery-1.11.3-jquery.min.js"></script>
<script type="text/javascript" src="js/validation.min.js"></script>
<link href="css/signup.css" rel="stylesheet" type="text/css" media="screen">
<script type="text/javascript" src="js/login-script.js"></script>

</head>

<body>
    
<div class="signin-form">

	<div class="container">
     
        
       <form class="form-signin" method="post" id="login-form">
      
        <h2 class="form-signin-heading">Log In to WebApp.</h2><hr />
        
        <div id="error">
        <!-- error will be shown here ! -->
        </div>
        
        <div class="form-group">
        <input type="email" class="form-control" placeholder="Email address" name="user_email" id="user_email" />
        <span id="check-e"></span>
        </div>
        
        <div class="form-group">
        <input type="password" class="form-control" placeholder="Password" name="password" id="password" />
        </div>
       
     	<hr />
        
        <div class="form-group">
            <button type="submit" class="btn btn-default" name="btn-login" id="btn-login">
    		<span class="glyphicon glyphicon-log-in"></span> &nbsp; Sign In
			</button> 
		
        </div>  
      
        <div class="form-group">
          <a class="btn btn-primary" href="signup.php" role="button">Signup</a>
        </div>
      </form>

    </div>
    
</div>
    
<script src="js/bootstrap.min.js"></script>

</body>
</html>