<?php

$db_host="localhost";
$db_name="contact";
$db_user="root";
$db_password="";


$pdo=new PDO("mysql:host=$db_host; dbname=$db_name;charset=utf8",$db_user,$db_password);

$pdo ->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$pdo ->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);

?>