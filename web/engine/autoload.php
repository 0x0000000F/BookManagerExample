<?php
spl_autoload_register ('autoload');
require_once(dirname(__FILE__).'/dbconfig.php'); 
$pdo = DB::getInstance(DB_USER, DB_PASSWORD, DB_NAME)->getConnection();

function autoload ($className) {
	$className = str_replace( "..", "", $className );
	$fileName = dirname(__FILE__).'/classes/'.$className .'.class.php';
	if (is_readable($fileName)) { require_once $fileName; }
}
?>