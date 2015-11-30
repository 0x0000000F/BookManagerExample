<?php
if(!defined("IN_RULE")) die ("Oops");



if (isset($_POST['email'])) 			{ $message = ProcessLogin($_POST['email'], $pdo);  }
if (isset($_SESSION['email'])) 			{ header("location: index.php"); exit; }



function ProcessLogin($user, $dblink) {
	$login = filter::filter_email($user);

	if ($login != FALSE) {

		if ($stm = $dblink->prepare("SELECT email, pass FROM users WHERE email=?")) {
			$stm->execute(array($login)); $row = $stm->fetch(); $stm = NULL; 
			$uname 		= $row['email'];
			$hash 		= $row['pass'];
		}
		if ($uname == $login) {	
			if (password_verify($_POST['password'], $hash)) {
				$_SESSION['email'] = $login;
				//login::log_enter($dblink);
			} else { $mesg =  "Wrong password";	}
		} else { $mesg =  "Wrong login"; }

	} else $mesg =  "Login is not valid";
	return $mesg;
}

function ProcessReminder($login, $dblink) {

}

function ProcessRegister($dblink) {
 //
}




?>