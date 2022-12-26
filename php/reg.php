<?php
     mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
     ini_set('error_reporting', E_ALL);
     ini_set('display_errors', 1);
     ini_set('display_startup_errors', 1);


class reg {

	public $pass;
	public $login;
	
	private function generateCode($length=6) {
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789";
		$code = "";
		$clen = strlen($chars) - 1;
		while (strlen($code) < $length) {
			 $code .= $chars[mt_rand(0,$clen)];
		}
		return $code;
	}

	public function reg($pass = NULL, $login = NULL) {
			// Функция для генерации случайной строки
			
		   	if (empty($login)) {
			  	$res = 'Введите логин.';
			  	return $res;
		   	}
			$login = trim($login);
			if (empty($pass)) {
				$res = 'Пароль отсутствует.';
				return $res;
			}
			$connection = new mysqli('127.0.0.1', 'root', 'Vq', 'bdb'); 
			$data = $connection->query('SELECT * FROM users');
			// Проверям пароль, email
//			if (!filter_var($login, FILTER_VALIDATE_EMAIL)) {
//				$res = 'Неверный формат email.';
//				return $res;
//			}
			if(strlen($pass) < 4 or strlen($pass) > 32) {
			  	$res = 'Пароль должен быть не меньше 4-х символов и не больше 30.';
			  	return $res;
			} else {
				$password = md5(md5(trim($pass)));
			}
			// Сверяем пароль и email с БД
			foreach ($data as $log) {
				if ($login == $log['email']) {
					if ($password == $log['password']) {
			   			// Генерируем случайное число и шифруем его
						$hash = md5($this->generateCode(10));
						$_SESSION['id'] = $log['id'];
						unset($log);
						$data->close();
			   			// Записываем  в БД новый хеш авторизации
						$stmt = $connection->prepare("UPDATE users SET hash = ? WHERE email = ?");
						$stmt->bind_param('ss', $hash, $login);
						$stmt->execute();
						unset($log);
						$stmt->close();

						setcookie("email", $login, time()+60*60*24*30, "/");
						setcookie("hash", $hash, time()+60*60*24*30, "/", null, null, true);
						//header('Location: https://yamal.shop/reltor.php');
						$res = 'Авторизация успешна';
						return $res;
					} else {
						$res = 'Указанный login зарегестрирован с другим паролем.';
						return $res;
					}
				}
			}
		   	// Переходим к записи в БД
			// Генерируем случайный код и шифруем его
			$hash = md5(generateCode(10));
			$stmt = $connection->prepare("INSERT INTO users (login, hash, password, date, email) VALUES (?, ?, ?, ?, ?)");
			$password_reg = md5(md5(trim($pass)));
			$date = date ("d.m.y \(H:i\)");
			$stmt->bind_param('sssss', $login, $hash, $password_reg, $date, $login);
			$stmt->execute();
			$stmt->close();
			$_SESSION['login'] = $login;
			if ($_SESSION['login'] == 'admin') $_SESSION['dostup'] = 'reltor';
			setcookie("email", $login, time()+60*60*24*30, "/");
			setcookie("hash", $hash, time()+60*60*24*30, "/", null, null, true);
			$res = 'Регистрация успешна';
			return $res;
	    	}
}

if (empty($_POST['login']) || empty($_POST['pass'])) die('Введите логин и пароль');
$a = new reg();
$b = $a->reg($_POST['pass'], $_POST['login']);
die($b);
?>