<?php
/////////////////////////////////////////////////////////////////////ENGINE 0.0//////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////By Artem Efremov////////////////////////////////////////
/////////////////////////////////////////////////////////////////////16.01.2017//////////////////////////////////////////////
class bd{
	static private $pdo;
	
	public static function connect($user,$password,$host,$dbname)
	{
		try{
			self::$pdo = new PDO("mysql:host=$host;dbname=$dbname",$user,$password);
		}catch(PDOException $e)
		{
			return false;
		}
		return true;
	}
	
	public static function add_base($sql,$array)
	{
		$result = self::$pdo->prepare($sql);
		if($result->query($array))
			return true;
		else 
			return false;
	}
	
	public static function read_base($sql)
	{
		$result = self::$pdo->query($sql);
		if($result) return $result->fetchAll();
		else return false;
	}
}
/////////////////////////////////////////////////////////////////////////////////////////////////////
class bd_config{
	private $bd_conf = array{
		'host' = '127.0.0.1:3306',
		'dbname' = 'forum_base',
		'user' = 'root',
		'password' = ''
	};
	
}
/////////////////////////////////////////////////////////////////////////////////////////////////////
class forum extends bd_config{
	
	private $article;
	private $id;
	private $category;
	private $str1 ="<h1>Technical work...(<h1>";
	private $str2 ="<h1>404</h1>";
	public function __construct($arcticle,$category)
	{
		$this->article = $article;
		$this->category = $category;
	}
	
	public function search($str)
	{
		if(!empty($str))
		{
			if(bd::connect($this->bd_conf['host',$this->['dbname'],$this->['user'],$this->['password']))
			{
				if(is_numeric($str))
				{
					$sql = "SELEC * FROM users WHERE id = $str";
					if(bd::read_base($sql))
					{
						$user = new users();
						$users->user($str);
					}
					else{
						echo 'Nothing found!';
					}
				}
				else
				{
					$sql = "SELECT * FROM articles WHERE category = $str";
					if(bd::read_base($sql))
					{
						$this->article = $str;
						$this->article();
					}
					else{
						echo 'Nothing found!';
					}
				}
			}
			else
				echo 'Nothing found!';
			
		}
	}
	
	public function add_article($title,$author,$text)
	{
		if(bd::connect($this->bd_conf['host',$this->['dbname'],$this->['user'],$this->['password']))
		{
			$sql = "INSERT INTO articles(title,author,text)VALUES(?,?,?)";
			$array = array($title,$author,$text);
			bd::add_base($sql,$array);
		}else{
			echo $this->str1;
		}	
	}
	
	public function article()
	{
		if(bd::connect($this->bd_conf['host',$this->['dbname'],$this->['user'],$this->['password']))
		{
			$sql("SELECT * FROM articles WHERE arcticle = $this->article AND category = $this->category");
			$article = bd::read_base($sql);
			$this->article($article);
		}else{
			echo $this->str1;
		}
	}
	
	public function view_article($article)
	{
		foreach($article as $res)
		{
			echo $res['title']."<hr><br>";
			echo $res['author']."<hr><br>";
			echo $res['text']."<hr><br>";
			echo $res['data']."<hr><br>";
		}
		$this->comments($this->id);
	}
	//рср рср рср рср рср рср
	public function add_comment($comment)
	{
		if(bd::connect($this->bd_conf['host',$this->['dbname'],$this->['user'],$this->['password'])))
		{
			$sql = "INSERT INTO comments";
			bd::add_base($sql,$array);
		}
		else
		{
			echo 'Comment will not be added!';
		}
	}
	
	public function comments($category)
	{
		bd::connect($this->bd_conf['host',$this->['dbname'],$this->['user'],$this->['password']));
		$sql = "SELECT * FROM comments WHERE category = $category";
		$comments = bd::read_base($sql);
		if($comments)
			view_comments($result);
		else 
			echo $this->str1;
	}
	
	public function view_comments($comments)
	{
		if($comments)
		{
			foreach($comments as $comment)
			{
				echo $comment['author'];
				echo $comment['text'];
				echo $comment['data'];
			}
		}
		else
			return $this->str1;
	}
}
/////////////////////////////////////////////////////////////////////////////////////////////////////
class users extends bd_config{
	
	private $str = '<h1>Technical work...(<h1>';
	private $str2 = '<h1>404</h1>';
	public function user($id)
	{
	 	if(bd::connect($this->bd_conf['host',$this->['dbname'],$this->['user'],$this->['password']))
		{
			$sql = "SELECT * FROM id = $id";
			$result = bd::read_base($sql);
		}
		else{
			echo $this->str;
		}
		if($result)
			$this->view_user($result);
		else 
			return false;
	}
	
	public function view_user($user)
	{
		if($result)
		{
			foreach($result as $res)
			{
				echo $res['name'].'<br>';
				echo $res['old'].'<br>';
				echo $res['sex'];
				echo $res['data_reg'].'<br>';
				echo $res['posts'].'<br>';
				
			}
				return true;
		}
		else
			return $this->str2;
		return $this->srt1;
	}
	
	public function add_user($data_user)
	{
		if($data_user)
		{
			if(bd::connect($this->bd_conf['host',$this->['dbname'],$this->['user'],$this->['password'])))
			{
				$sql = "INSERT INTO users(password,login,email,name,old,sex)VALUES(?,?,?,?,?,?)";
				$array = array($data_user['password'],$data_user['login'],$data_user['email'],$data_user['name'],$data_user['old'],$data_user['sex']);
				if(bd::add_base($sql,$array))
					echo 'You are registered';
				else
					echo 'You are not registered';
			}
			else
			{
				echo 'The user is not registered';
			}
		}
		else{
			echo 'The user is not registered';
		}
	}
	
	public function chek_user($data_user)
	{
		if($data_user)
		{
			if(bd::connect($this->bd_conf['host',$this->['dbname'],$this->['user'],$this->['password'])))
			{
				$sql = "SELECT * FROM users WHERE login = $data_user['login'] AND password = $data_user['password']";
				if(bd::read_base($sql))
					return true;
				else
					echo 'You are not registered';
			}
			else
			{
				echo $this->str1;
			}
		}
		else{
			echo $this->str2;
		}
	}
	
}
?>