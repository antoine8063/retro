<?php
    function db_connect() {
        
        $host= "http://localhost:8888";
        $dbname = "retro";
        $user= "root";
        $password = "root";

        $db = new PDO(
                "mysql: host=$host; dbname=$dbname" ,
                $user, $password,
                array (PDO:: MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", PDO:: MYSQL_ATTR_DIRECT_QUERY=> true) ) ;
        return $db; 
    }
?>