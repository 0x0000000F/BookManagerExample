<?php 
Class User {

	public function getInfo($user, $dblink) {
		if(!isset($user)) {header("location: index.php"); exit;}
	
		$uiname = filter::filter_email($user);
	
		if ($stm = $dblink->prepare("SELECT * FROM  users WHERE email = ?")) {
			$stm->execute(array($uiname)); $out = $stm->fetch(); $stm = NULL;
		}

		if ($out['id'] == '') {session_destroy(); header("location: index.php");exit;}
		return $out;
	}

	public function cuteDate($date)  {
	    $today = date('d.m.Y', time());
	    $yesterday = date('d.m.Y', time() - 86400);
	    $daybeforeyesterday = date('d.m.Y', time() - 172800);	    
	    $dbDate = date('d.m.Y', strtotime($date));
	    $dbTime = date('H:i', strtotime($date));

	    switch ($dbDate)   {
	      case $today 					: $output = 'Сегодня в '. $dbTime; break;
	      case $yesterday 				: $output = 'Вчера в '. $dbTime; break;
	      case $daybeforeyesterday 		: $output = 'Позавчера в '. $dbTime; break;	      
	      default : $output = $dbDate;
	    }
	    return $output;
	}	


}
?>
