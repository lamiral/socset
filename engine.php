<?php
/////////////////////////////////////////////////////////////////////ENGINE 0.0//////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////By Artem Efremov////////////////////////////////////////
/////////////////////////////////////////////////////////////////////16.01.2017//////////////////////////////////////////////
class bd{
	static private $pdo;
	
	public static function connect($bd_conf)
	{
		$host = $bd_conf['host'];
		$dbname = $bd_conf['dbname'];
		$user = $bd_conf['user'];
		$password = $bd_conf['password'];
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
		if($result->exec($array))
			return true;
		else 
			return false;
	}
	
	public static function read_base($sql,$array = NULL)
	{
		$result = self::$pdo->prepare($sql);
		$result->execute($array);
		if($result) return $result->fetchAll();
		else return false;
	}
}
/////////////////////////////////////////////////////////////////////////////////////////////////////
class bd_config{
	public $bd_conf = array(
		'host' => '127.0.0.1:3306',
		'dbname' => 'forum_base',
		'user' => 'root',
		'password' => ''
	);
}
/////////////////////////////////////////////////////////////////////////////////////////////////////
class forum extends bd_config{
	
	private $article;
	private $id;
	private $category;
	private $str1 ="<h1>Technical work...(<h1>";
	private $str2 ="<h1>404</h1>";
	
	public function __construct($category)
	{
		$this->_header();
		$this->article = $article;
		$this->category = $category;
		$this->articles();
		$this->footer();
	}
	
	public function _header()
	{
			echo '<h1>Шапка сайта </h1>';
	}
	
	public function footer()
	{
		echo '<h1>Футер сайта</h1>';
	}
	//connect in bd
	public function connect_db()
	{
		if(bd::connect($this->bd_conf))
			return true;
		else
			return false;
		

	}
	public function articles()
	{
		if($this->connect_db())
		{
			$category = $this->category;
			$sql = "SELECT * FROM articles WHERE category=?";
			$array = array($category);
			$articles = bd::read_base($sql,$array);
			if($articles)
				$this->view_articles($articles);
				else 
					echo $this->str1;
		}
		else
			echo $this->str1;
	}
	
	public function view_articles($articles)
	{
		if($articles)
		{
			foreach($articles as $article)
			{
				echo '<a href="http://testsitart.com/$this->category/$article">'.$article['title']."<br><a>";
				echo $article['data'].'<hr><br>';
				echo $article['text'];
			}
		}
			else 
				echo $this->str1;
	}
	
	public function search($str)
	{
		if(!empty($str))
		{
			if($this->connect_bd())
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
	
	public function add_article($article)
	{
		if($this->connect_db())
		{
			$sql = "INSERT INTO articles(title,author,text)VALUES(?,?,?)";
			$array = array($article['title'],$article['author'],$article['text']);
			bd::add_base($sql,$array);
		}else{
			echo $this->str1;
		}	
	}
	
	public function article($article)
	{
		if($this->connect_db())
		{
			$sql("SELECT * FROM articles WHERE arcticle = $this->article AND category = $this->category");
			$article = bd::read_base($sql);
			$this->view_article($article);
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
	
	public function add_comment($comment)
	{
		if($this->connect_db())
		{
			$sql = "INSERT INTO comments(title,text,author,article)VALUES(?,?,?,?)";
			$array($comment[title],$comment['text'],$comment['author'],$comment['article']);
			bd::add_base($sql,$array);
		}
		else
		{
			echo 'Comment will not be added!';
		}
	}
	
	public function comments($article)
	{
		if($this->connect_db())
		{
		$sql = "SELECT * FROM comments WHERE category = $article";
		$comments = bd::read_base($sql);
		if($comments)
			view_comments($result);
		else 
			echo $this->str1;
		}
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
	/*
	public function user($id)
	{
	 	if(bd::connect($this->bd_conf['host'],$this->bd_conf['dbname'],$this->bd_conf['user'],$this->bd_conf['password']))
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
	*/
	
	//session 
	public function add_session($user_data)
	{
		$_SESSION['login'] = $user_data['login'];
		$_SESSION['password'] = $user_data['password'];
	}
	//chek_session
	public function chek_session()
	{
		if(!$_SESSION['login'] && !$_SESSION['password'])
			return false;
		else
			return true;
	}
	//user
	
	//user_profile
	public function user_profile($id)
	{
	 	if($this->connect_db())
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
	
	public function chek_user($data_user)
	{
		if(chek_session())
		{
			return true;
		}
			if($data_user)
			{
				if($this->connect_db)
				{
					$login = $data_user['login'];
					$password = $data_user['password'];
					$sql = "SELECT * FROM users WHERE login=$login AND password=$password";
					if(bd::read_base($sql))
					{
						add_session($data_user);
						return true;
					}
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
			if($this->connect_db())
			{
				$sql = "INSERT INTO users(password,login,email,name,old,sex)VALUES(?,?,?,?,?,?)";
				$array = array($data_user['password'],$data_user['login'],$data_user['email'],md5($data_user['name']),$data_user['old'],$data_user['sex']);
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
}
////////////////////////////////////////////////////////////////////////////////////

?>