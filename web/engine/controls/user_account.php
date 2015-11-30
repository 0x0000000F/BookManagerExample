<?php if(!defined("IN_RULE")) die ("Oops");

$action = filter_var($_GET['p'], FILTER_VALIDATE_REGEXP,array("options"=>array("regexp"=>"/^([a-z0-9_])+$/")));

$view_name = $action;

switch($view_name)	{  
    case "newbook" 	:  	$model_name =  $view_name;			break;
    case "editbook" :  	$model_name =  $view_name;			break;

    default 		: 	$view_name = $model_name = 'index'; 	break;
}

require('engine/model/'.$model_name.'.php');
require('engine/view/boot.php');
?>