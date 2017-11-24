<!DOCTYPE html PUBLIC>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Registration</title>
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="css/bootstrap-theme.min.css" rel="stylesheet" media="screen"> 
<script type="text/javascript" src="js/jquery-1.11.3-jquery.min.js"></script>

<script type="text/javascript" src="js/validation.min.js"></script>
<link href="css/signup.css" rel="stylesheet" type="text/css" media="screen">

<script type="text/javascript" src="register.js"></script>

</head>

<body>

<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button
        </div>
      
</nav>
    
<div class="signin-form">

	<div class="container">
     
        
       <form class="form-signin" method="post" id="register-form">
      
        <h2 class="form-signin-heading">Sign Up</h2><hr />
        
        <div id="error">
        <!-- error will be showen here ! -->
        </div>
        
        <div class="form-group">
        <input type="text" class="form-control" placeholder="Username" name="user_name" id="user_name" />
        </div>
        
        <div class="form-group">
        <input type="email" class="form-control" placeholder="Email address" name="user_email" id="user_email" />
        <span id="check-e"></span>
        </div>
        
        <div class="form-group">
        <input type="password" class="form-control" placeholder="Password" name="password" id="password" />
        </div>
        
        <div class="form-group">
        <input type="password" class="form-control" placeholder="Retype Password" name="cpassword" id="cpassword" />
        </div>
     	<hr />
        
        <div class="form-group">
            <button type="submit" class="btn btn-default" name="btn-save" id="btn-submit">
    		<span class="glyphicon glyphicon-log-in"></span> &nbsp; Create Account
			</button> 
        </div>  
      
        <div class="form-group">
            <a class="btn btn-primary" href="login.php" role="button">Login</a>
        </div>
      </form>

    </div>
    
</div>
    
<script src="js/bootstrap.min.js"></script>

</body>
</html>