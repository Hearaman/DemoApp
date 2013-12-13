<?php

class App
{

    public $db;
    public $name;
    private static $dbInstance;

    function __construct()
    {
        $this->DBConnect();
    }

    protected function DBConnect()
    {
        $dsn = 'mysql:host=localhost:3306;dbname=hearaman;connect_timeout=15';
        $user = 'root';
        $password = '';
        try
        {
            $this->db = new PDO($dsn, $user, $password);
        } catch (PDOException $e)
        {
            echo "Database Error: " . $e->getMessage();
        }
    }

    public static function getDBInstance()
    {
        if (!isset(self::$dbInstance))
        {
            $object = __CLASS__;
            self::$dbInstance = new $object;
        }
        return self::$dbInstance;
    }

    function login($email, $psw)
    {
        $sql = "SELECT id,email,name FROM tbl_user WHERE email=:email AND password=:psw";
        $stmt = App::getDBInstance()->db->prepare($sql);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":psw", $psw);
        if ($stmt->execute())
        {
            $count = $stmt->rowCount();
            if ($count == 1)
            {
                $row = $stmt->fetch(PDO::FETCH_OBJ);
                $_SESSION['userSes'] = $row;
                return true;
            } else
            {
                return false;
            }
        }
    }

    function logout()
    {
        unset($_SESSION['userSes']);
    }
    
    function createPost($uid,$name, $desc,$dateTime)
    {
        //echo $uid.$name.$desc.$dateTime;
        $sql = "INSERT INTO tbl_post (user_id,name,description,date) VALUES (:user_id,:name, :desc, :date)";
        $stmt = App::getDBInstance()->db->prepare($sql);
        $stmt->bindParam(":user_id", $uid);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":desc", $desc);
        $stmt->bindParam(":date", $dateTime);
        if ($stmt->execute())
        {            
            return true;
        }
    }

    function getAllPostByUserId($uid)
    {
        $sql = "SELECT * FROM tbl_post where user_id=:id";
        $stmt = App::getDBInstance()->db->prepare($sql);
        $stmt->bindParam(":id", $uid);
        if ($stmt->execute())
        {
            $row = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $row;
        }
    }
    
    function getAllPosts($limit='')
    {
        if($limit!='') $limit="LIMIT ".$limit;
        $sql = "SELECT tbl_post.id,tbl_post.name AS post,tbl_post.description,tbl_post.date ,tbl_user.name as user FROM tbl_post JOIN tbl_user ON user_id=tbl_user.id ".$limit;
        $stmt = App::getDBInstance()->db->prepare($sql);
        if ($stmt->execute())
        {
            $row = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $row;
        }
    }
    
    function getUsers()
    {
        $sql = "SELECT id,name,email FROM tbl_user";
        $stmt = App::getDBInstance()->db->prepare($sql);
        if ($stmt->execute())
        {
            $row = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $row;
        }
    }

}

?>