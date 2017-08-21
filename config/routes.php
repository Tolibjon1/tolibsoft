<?php
return array
(
    
    "/news/([a-z]+)/([0-9]+)"=>"news/view/$1/$2",
    "/news" => "news/index", //actionIndex? NewsController
    "/products" => "products/list", //
    "/user/register" =>"user/register",
    "/user/cabinet"=>"user/cabinet",
    "/user/login"=>"user/login",
    "/user/logout"=>"user/logout",
     "/user/edit"=>"user/edit",
    "/" =>"site/index"
);