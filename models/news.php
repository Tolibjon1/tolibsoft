<?php
class News 
{
    public static function getNewsById($id)
    {
        $db = Db::getConnection();
        $result = $db->query("select title,id,Unix_timestamp(date) as date,content,author_name from news where id=$id");
        $result->setFetchMode(PDO::FETCH_ASSOC);
        return $result->fetch();
    }
    public static function getNewsList()
    {
        $db = Db::getConnection();
        $newslist = array();
        $result = $db->query("SELECT date as olddate, title,id,Unix_timestamp(date) as date,short_content, author_name from news order by date desc limit 10");
        $i = 0;
        while($row = $result->fetch())
        {
            $newslist[$i]=$row;
            //echo "<br>".$row['olddate'] ." --> ".$row['date'];
            $i++;
        }
        return $newslist;
    }
}