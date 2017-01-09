<?php
require_once 'C:\OpenServer\domains\mysocset.ru\bd\bdconfig.php';
class controller{
	
	public function add_base($sql,$array)
	{
		$pdo = PDOconnect::connect();
		try{
				$result = $pdo->prepare($sql);
				$result->execute($array);

		}catch(PDOException $e){
			return $e->getMessage();
		}
		
		return true;
	}	

	public function get_base($sql)
	{
		$pdo = PDOconnect::connect();
		try{

			$result = $pdo->query($sql);

		}catch(PDOException $e)
		{
			return $e->getMessage();
		}
		return $result->fetchAll();
	}   

}
