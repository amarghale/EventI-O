<?php
session_start();
require_once('class.user.php');
$user = new USER();

if ($user->is_loggedin() != "") {
    $user->redirect('home.php');
}

if (isset($_POST['btn-signup'])) {
    $uname = strip_tags($_POST['txt_uname']);
    $umail = strip_tags($_POST['txt_umail']);
    $upass = strip_tags($_POST['txt_upass']);

    if ($uname == "") {
        $error[] = "provide username !";
    } else if ($umail == "") {
        $error[] = "provide email id !";
    } else if (!filter_var($umail, FILTER_VALIDATE_EMAIL)) {
        $error[] = 'Please enter a valid email address !';
    } else if ($upass == "") {
        $error[] = "provide password !";
    } else if (strlen($upass) < 6) {
        $error[] = "Password must be atleast 6 characters";
    } else {
        try {
            $activation = md5(uniqid(rand(), true));
            $stmt = $user->runQuery("SELECT user_name, user_email FROM users WHERE user_name=:uname OR user_email=:umail");
            $stmt->execute(array(':uname' => $uname, ':umail' => $umail));
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row['user_name'] == $uname) {
                $error[] = "sorry username already taken !";
            } else if ($row['user_email'] == $umail) {
                $error[] = "sorry email id already registered!";
            } else {
                if ($user->register($uname, $umail, $upass, $activation)) {
                    $id = $user->lastID();
                    $token = $activation;
                    $to = $umail;
                    $subject = "Regestration Confirmation";
                    $body = "<html><p>Thank you for registering at eventi/o site.</p>
<p>To activate your account, please click on this link: <a href= 'https://rhetorical-location.000webhostapp.com/activate.php?id=$id&token=$token'>Click here to activate</a></p>
<p>Regards Site Admin</html></p>";
                    $headers ="NINE-Version: 1.0\r\n";
                    $headers .="Content-type: text/html; charset=utf-8";
                    
                    $send = mail($to, $subject, $body, $headers);
                    $user->redirect('sign-up.php?action=joined');
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
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

            <div class="container">

                <form method="post" class="form-signin">
                    <h2 class="form-signin-heading">Sign up.</h2><hr />
                    <?php
                    if (isset($error)) {
                        foreach ($error as $error) {
                            ?>
                            <div class="alert alert-danger">
                                <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?>
                            </div>
                            <?php
                        }
                    } else if (isset($_GET['joined'])) {
                        ?>
                        <div class="alert alert-info">
                            <i class="glyphicon glyphicon-log-in"></i> &nbsp; Successfully registered <a href='index.php'>login</a> here
                        </div>
                        <?php
                    }
                    ?>
                    <div class="form-group">
                        <input type="text" class="form-control" name="txt_uname" placeholder="Enter Username" value="<?php
                    if (isset($error)) {
                        echo $uname;
                    }
                    ?>" />
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="txt_umail" placeholder="Enter E-Mail ID" value="<?php
                               if (isset($error)) {
                                   echo $umail;
                               }
                               ?>" />
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="txt_upass" placeholder="Enter Password" />
                    </div>
                    <div class="clearfix"></div><hr />
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" name="btn-signup">
                            <i class="glyphicon glyphicon-open-file"></i>&nbsp;SIGN UP
                        </button>
                    </div>
                    <br />
                    <label>have an account ! <a href="index.php">Sign In</a></label>
                </form>
            </div>
        </div>

    </div>

</body>
</html>