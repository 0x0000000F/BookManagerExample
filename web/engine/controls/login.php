<?php if(!defined("IN_RULE")) die ("Oops");

if ($_SERVER['REQUEST_METHOD'] == 'POST') { $showForm = "1"; require('engine/model/wxod.php');}

$view_name = 'wxod';
 
require('engine/view/boot_entree.php');
?>