<?php
require_once('DBConnection.php');

class USER
{
    private $database = "mysql:host = localhost; dbname=id3675237_full_calendar";
    private $username = "id3675237_all41n12";
    private $password = "A35cobar";
    private $conn;

    public function __construct()
    {
        $this->conn = new PDO($this->database, $this->username , $this->password);
    }

    public function runQuery($sql)
    {
        $stmt = $this->conn->prepare($sql);
        return $stmt;
    }

    public function register($fname, $uname, $umail, $upass)
    {
        try
        {
            $new_password1 = password_hash($upass, PASSWORD_DEFAULT);

            $stmt = $this->conn->prepare("INSERT INTO admins_students(Name, email, user_name, Password) 
		                                               VALUES(:fname, :umail, :uname, :upass)");
            $stmt->bindparam(":fname", $fname);
            $stmt->bindparam(":umail", $umail);
            $stmt->bindparam(":uname", $uname);
            $stmt->bindparam(":upass", $new_password1);

            $stmt->execute();

            return $stmt;
        }
        catch (PDOException $e)
        {
            echo $e->getMessage();
        }
    }

    public function add_like($blog_id, $uid)
    {
        try
        {
            $stmt1 = $this->conn->prepare("SELECT likes FROM likes WHERE blog_id = :blog_id AND user_id = :uid");
            $stmt1->bindparam(":blog_id", $blog_id);
            $stmt1->bindparam(":uid", $uid);
            $stmt1->execute();
            $like = $stmt1->fetch();
            if ($like < 1)
            {
                $first_like = 1;
                $stmt = $this->conn->prepare("INSERT INTO likes(blog_id, user_id, likes) VALUES(:blog_id, :user_id, :likes)");
                $stmt->bindparam(":blog_id", $blog_id);
                $stmt->bindparam(":user_id", $uid);
                $stmt->bindparam(":likes", $first_like);
                $stmt->execute();
            }
            else
            {
                $stmt = $this->conn->prepare("Update likes SET likes = likes+1 WHERE blog_id = :blog_id AND user_id = :uid");
                $stmt->bindparam(":blog_id", $blog_id);
                $stmt->bindparam(":uid", $uid);
                $stmt->execute();
            }
            return $stmt;
        }
        catch (Exception $ex)
        {
            echo $e->getMessage();
        }
    }

    public function doLogin($uname, $umail, $upass)
    {
        try
        {
            $stmt = $this->conn->prepare("SELECT * FROM admins_students WHERE user_name=:uname OR email=:umail ");
            $stmt->execute(array(':uname' => $uname, ':umail' => $umail));
            $userRow = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($stmt->rowCount() == 1)
            {
                if (password_verify($upass, $userRow['Password']))
                {
                    $_SESSION['user_session'] = $userRow['UserId'];
                    $_SESSION['user_id'] = $userRow['UserId'];
                    $_SESSION['loggedin_time'] = time();
                    $_SESSION['user_name'] = $uname;
                    
                    return true;
                }
                else
                {
                    return false;
                }
            }
        }
        catch (PDOException $e)
        {
            echo $e->getMessage();
        }
    }

    public function is_loggedin()
    {
        if (isset($_SESSION['user_session']))
        {
            return true;
        }
    }

    function isLoginSessionExpired()
    {
        $login_session_duration = 1800;
        $current_time = time();
        if (isset($_SESSION['user_session']) and isset($_SESSION["loggedin_time"]))
        {
            if ((($current_time - $_SESSION['loggedin_time']) > $login_session_duration))
            {
                return true;
            }
        }
        return false;
    }

    public function redirect($url)
    {
        header("Location: $url");
    }

    public function doLogout()
    {
        session_destroy();
        unset($_SESSION['user_session']);
        return true;
    }
}