<?php 
$mem_start = memory_get_usage();
$start = microtime(true);
//error_reporting(0);

session_start();
define("IN_RULE", TRUE);
date_default_timezone_set('Europe/Kiev');

include_once('engine/autoload.php');

if ($pdo != 'Connection failed') { 
	$pdo->exec("SET time_zone = '+3:00'");
	if($_SESSION['email'] == NULL)	{  
		require("engine/controls/login.php"); 
	} else {
		$User = user::getInfo($_SESSION['email'], $pdo);
		require("engine/controls/user_account.php");
	}
	$pdo = NULL;
} else {require("engine/controls/exception.php");}

$time = microtime(true) - $start;
$mem = memory_get_usage() - $mem_start;
echo 'Запрос выполнялся '.$time.' сек.<br>' ;
echo 'Использовано памяти: '. $mem  .' байт';
?>