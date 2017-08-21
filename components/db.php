<?php
class Db
{
    public static function getConnection()
    {
        $host = "localhost";
        $dbname = "mvc_site";
        $user = "root";
        $password ="";
        $db = new PDO("mysql:host=$host;dbname=$dbname",$user, $password);
        return $db;
    }
}