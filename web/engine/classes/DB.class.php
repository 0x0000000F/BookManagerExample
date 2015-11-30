<?php if(!defined("IN_RULE")) die ("Oops");
Class DB {
	private $connection;
	private static 	$instance;
	private $options = array(	PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
		    			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
		    			PDO::ATTR_PERSISTENT => true	);

	public function getConnection() {
		return $this->connection;
	} 
	public static function getInstance($dbuser, $dbpassword, $dbname) {
		$dsn 	= "mysql:host=localhost;dbname=".$dbname.";";
		$user 	= $dbuser;
		$pass 	= $dbpassword;
	    if (self::$instance === null) {
	        self::$instance = new self($dsn, $user, $pass);
	    }
	    return self::$instance;
	} 

	private function __construct($dsn, $user, $pass) {
		try {
			$this->connection = new PDO($dsn, $user, $pass, $this->options);
		}
		catch(PDOException $e)	{
			$this->connection = 'Connection failed';
		}	
	}

	private function __clone() { }


	private function __desctruct() {
		$this->connection = NULL;
		self::$instance = NULL;
	}
}

?>
