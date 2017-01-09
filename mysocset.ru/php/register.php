<?php
if(count($_POST)>0)
{
	$data = $_POST;
	$count = 0;
	foreach($data as $dt)
	{
		if(!isset($dt))
		{
			$errors = "Заполните все поля!";
		}
	}

	
		if($data['password']!=$data['repassword'])
		{
			$errors = "Пароли должны быть одинаковыми";
		}

		foreach($data as $dt)
		{
			if(is_numeric($dt))
			{
				$errors = "Ни одно поле не должно состоять только из цифр";
			}

		}
	 	if(!isset($errors))
	 	{
	 		include '..\bd\bdconfig.php';
	 		$pdo = PDOconnect::connect();
	 		$rnd = rand();
	 		while($pdo->query('SELECT * FROM users WHERE person_id=$rnd'))
	 		{
	 			$rnd = rand();
	 		}

	 		$sql = 'INSERT INTO `users`(`name`,`sername`,`age`,`email`,`city`,`person_id`)VALUES(?,?,?,?,?,?)';
	 		$array = array($data['name'],$data['sername'],$data['age'],$data['email'],$data['city'],$rnd);
	 		include 'controller.php';
	 	 	$controller = new controller();
	 	 	if($controller->add_base($sql,$array))
	 	 	{
	 	 		echo "Вы разерестрировались!";
	 	 	}
	 	 	else{
	 	 		echo "Вы не зарегестрировались!";
	 	 	}
	 		$pdo->prepare($sql);
	 	}
	 	else
	 	{
	 		echo $errors;
	 	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Регистрация</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="register">
		<form method="POST">
			<label>Логин</label><input type="text" name="login"><br>
			<label>Пароль</label><input type="text" name="password"><br>
			<label>Повтор пароля</label><input type="text" name="repassword"><br>
			<label>Имя</label><input type="text" name="name"><br>
			<label>Фамилия</label><input type="text" name="sername"><br>
			<label>Возраст</label><input type="text" name="age"><br>
			<label>Email</label><input type="text" name="email"><br>
			<label>Город</label><input type="text" name="city"><br>
			<input type="submit" name="sub" value="Регистрация">
			<div id="inf">
			</div>
		</form>
	</div>
</body>
</html>