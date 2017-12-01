<?php
try
{
  $pdo = new PDO('mysql:host=localhost;dbname=myyaara','tarun','sample123');
}
catch(PDOException $e)
{
  exit('****   Database error   ****');
}

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'tarun');
define('DB_PASSWORD', 'sample123');
define('DB_DATABASE', 'myyaara');
$connection = @mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

?>