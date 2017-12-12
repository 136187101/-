<?php
require_once("sql_config.php");
require_once("db_mysql.php");
require_once("js.class.php");
$db = new DB($dbhost, $dbuser, $dbpw, $dbname, $pconnect);
$js	= new JS();


?>