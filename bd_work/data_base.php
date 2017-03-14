<?

class data_base {

	public $pdo;

	public function __construct()
	{
		$login =	'login';
		$password = 'password';
		$host =		'localhost';
		$dbname = 	'dbname';
		try{
			$this->pdo = new PDO("mysql:host=$host;dbname=$dbname",$login,$password);
		}catch(PDOException $e)
		{
			$e->getMessage();
		}

		if($this->pdo == NULL)
		{
			return false;
		}
	}

	public function add_base($sql,$array)
	{
		if($this->pdo == NULL)
		{
			return false;
		}

		$result = $this->pdo->prepare($sql);
		$result->execute($array);
		if($result)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function read_base($sql,$array = NULL)
	{
		if($this->pdo == NULL)
		{
			return false;
		}

		if($array == NULL)
		{
			$result = $this->pdo->query($sql);
			if($result)
			{
				return $result;
			}
			else
			{
				return false;
			}
		}
		else
		{
			$result = $this->pdo->prepare($sql);
			$result->execute($array);
			if($result)
			{
				return $result;
			}
			else
			{
				return false;
			}
		}
	}
};

?>