<?php
require_once 'C:\OpenServer\domains\mysocset.ru\php\view.php';
//$view = new viewNews('view_news');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Главная</title>
</head>
<body>
	<div class='wrapper'>
		<div class='header'>
		<h1>Статичная шапка</h1>
		<a href='http://mysocset.ru/news/view_news'>Новости</a>
		<a href='http://mysocset.ru/friends/view'>Друзья</a>
		<a href='http://mysocset.ru/php/register.php'>Регистрация</a>
		</div>
		<div class='list'>
			<div class="news">
				<?php
					
						$url = $_SERVER['REQUEST_URI'];
						$url = explode('/',$url);
						$class = $url[1];
						$method = $url[2];
						$view = new $url[1]($url[2]);
				?>
			</div>
		</div>
		<div class='footer'>
		<h1>Статичный футер</h1>
		</div>
	</div>

</body>
</html>