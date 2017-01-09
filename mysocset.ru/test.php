<?php
$method = 'action_news';

class view{
	
	public function __construct($method)
	{
		$methods = get_class_methods($this);
		try{
				for($i=0;$i<count($methods);$i++)
				{
					if($methods[$i] == $method)
					{
						echo 'Метод <'.$method.'> существует<br>';
						return true;
					}
				}
				throw new Exception('Несуществует такого метода!');
			
		}catch(Exception $e){
			
			echo $e->getMessage();
			
			return false;
		}
		
			return 'Функция отработала...странно!';
	}
	
	public function action_news()
	{
		return __FUNCTION__;
	}
	
}
$view = new view($method);
$test = new view('unknown_method');