<?php
class UserController
{
    public static function actionregister()
    {
        $name="";
        $email="";
        $password="";
        if(isset($_POST["name"]))
        {    
            $name = $_POST["name"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $errors=false;
            if(!Validator::isNameValid($name))
                $errors[]= "Invalid name :(";
            
            if(!Validator::isPasswordValid($password))
               $errors[]= "Invalid password :(";
            
            if(!Validator::isEmailValid($email))
                $errors[]= "Invalid email :(";
            if(Validator::isEmailExists($email))
                $errors[]="Email $email already exists in our site!";
           
        }
        require_once("/views/register.php");
        return true;
    }
    public static function actionedit()
    {
        $db = Db::getConnection();
        $res = $db->prepare("SELECT * FROM user WHERE id = :id");
        $res->bindParam(":id",$_SESSION["userid"],PDO::PARAM_STR);
        $res->execute();
        $user = $res->fetch();
        
        if(isset($_POST["name"]))
        {    
            $name = $_POST["name"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $errors=false;
            if(!Validator::isNameValid($name))
                $errors[]= "Invalid name :(";
            
            if(!Validator::isPasswordValid($password))
               $errors[]= "Invalid password :(";
            
            if(!Validator::isEmailValid($email))
                $errors[]= "Invalid email :(";
            if(Validator::isEmailExists($email))
                $errors[]="Email $email already exists in our site!";
           
        }
        require_once("/views/edit.php");
        return true;
    }
    public static function actioncabinet()
    {
        if(isset($_SESSION["userid"]))
        {
            $db = Db::getConnection();
            $res = $db->prepare("SELECT * FROM user WHERE id = :id");
            $res->bindParam(":id",$_SESSION["userid"],PDO::PARAM_STR);
            $res->execute();
            $row = $res->fetch();
            require_once("/views/cabinet.php");
        }
        else header("Location: /user/login");
        return true;
    }
    public static function actionlogin()
    {
        
        $email="";
        $password="";
        if(isset($_POST["email"]))
        {   
            $email = $_POST["email"];
            $password = $_POST["password"];
            $errors=false;
            
            if(!Validator::isPasswordValid($password))
               $errors[]= "Invalid password :(";
            
            if(!Validator::isEmailValid($email))
                $errors[]= "Invalid email :(";
            if(!$errors)
            {
                $db = Db::getConnection();
                $sql = "SELECT * FROM user WHERE email = :email and password = :password";
                $res = $db->prepare($sql);
                $res->bindParam(":email",$email,PDO::PARAM_STR);
                $res->bindParam(":password",$password,PDO::PARAM_STR);
                $res->execute();
                if($user = $res->fetch())
                {
                    $_SESSION["userid"]=$user["id"];
                    header("Location: /user/cabinet");
                }
                else $errors[]= "User doesnt exist! :(";
            }
           
        }
        require_once("/views/login.php");
        return true;
    }
    public static function actionlogout()
    {
        unset($_SESSION["userid"]);
        header("Location: /user/login");
        return true;
    }
}