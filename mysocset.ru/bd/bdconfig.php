<?php

$config = array(
	'host' => '127.0.0.1:3306',
	'dbname' => 'test',
	'user' => 'root',
	'password' => ''
	);
$host = $config['host'];
$dbname = $config['dbname'];
$user = $config['user'];
$password = $config['password'];
class PDOconnect{
		
		public static $pdo;
		
		public static function connect()
		{
			try{
				self::$pdo = new PDO("mysql:host=$host;dbname=AE_BASE",'root',$password);
				
			}catch(PDOException $e)
			{
				echo $e->getMessage();
			}
			return self::$pdo;
		}

		function __destruct(){

			unset(self::$pdo);
		}

}
