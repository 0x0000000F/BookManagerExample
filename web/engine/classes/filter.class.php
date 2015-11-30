<?php 
Class filter {

	public function filter_email($param) {
		return filter_var($param, FILTER_VALIDATE_EMAIL);	
	}

	public function date($param) {
		$date = DateTime::createFromFormat('Y-m-d', $param);
		if ($date) { return $date->format('Y-m-d'); } else return FALSE;
	}

	public function allowedURL($param, $OKDomains) {
		$preview = filter_var($param, FILTER_VALIDATE_URL);
		if ($preview) $url = parse_url($preview);
		if (in_array($url['host'], $OKDomains)) { return $preview; } else return FALSE;
	}
}
?>