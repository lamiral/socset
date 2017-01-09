<?php
require_once 'C:\OpenServer\domains\mysocset.ru\php\controller.php';
class view{

	   public function __construct($method)
		{
			$methods = get_class_methods($this);
			try{
					for($i=0;$i<count($methods);$i++)
					{
						if($methods[$i] == $method)
						{
							echo $method[$i];
							echo $method;
							$this->$method();
							return true;
						}
					}
					throw new Exception('Несуществует такого метода!');
				
			}catch(Exception $e){
				
				echo $e->getMessage();
				return false;
			}

		}
}

class news extends view{

	public function view_news()
	{
		$controller = new controller();
		$sql = 'SELECT * FROM `news`';
		$result = $controller->get_base($sql);
		foreach($result as $res)
		{
			echo $res['author']."<br>";
			echo $res['data']."<br>";
			echo $res['text']."<br>";
		}
	}

	public function add_news($sql,$array)
	{
		$controller = new controller();
		$controller->add_base($sql,$array);
	}

	public function delete_news($sql)
	{
		$controller = new controller();
		$controller->get_base($sql);
	}

}

class friends extends view{


	public function view_friends()
	{
		$controller = new controller();
		$sql = 'SELECT * FROM `friends`';
		$result = $controller->get_base($sql);
		foreach($result as $res)
		{
			echo $res['text'];
		}
	}

}


