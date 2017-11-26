<?php
require_once('bdd.php');
ob_start();

//collect values from the url
$memberID = trim($_GET['id']);
$token = trim($_GET['token']);

//if id is number and the active token is not empty carry on
if(is_numeric($memberID) && !empty($token)){

    //update users record set the active column to 1 where the user_id and token value match the ones provided in the array
    $stmt = $bdd->prepare("UPDATE users SET activation_status = 1 WHERE user_id = :memberID AND token = :token");
    $stmt->execute(array(
        ':memberID' => $memberID,
        ':token' => $token
    ));
    
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Sign Up</title>
        <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="ss/bootstrap-theme.min.css" rel="stylesheet" media="screen">
        <link rel="stylesheet" href="css/signup.css" type="text/css"  />
    </head>
    <body>

        <div class="signin-form">
<form method="post" class="form-signin">
    <?php 
     if($stmt->rowCount() == 1){
         echo '  <h2 class="form-signin-heading">Your account has been acttivated!.</h2><hr />';
         echo '<label>Sign in here! <a href="index.php">Sign In</a></label>';

    } else {
        echo '<h2 class="form-signin-heading">Your Account couldnt be acttivated!.</h2><hr />'; 
    }
    ?>
                    </form>
            <div class="container">
            </div>
        </div>

    </div>

</body>
</html>