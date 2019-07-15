<?php

class My_PDO extends PDO  {
		const ERROR_LOG_FILE = "error.log";
}

function connect_db($db = FALSE, $host = "localhost", $username = "lisa", $password = "DwwsGDif", $port = FALSE) {
	try {
		if(!$port && $db) {
			$pdo = new My_PDO("mysql:host=".$host.";dbname=".$db, $username, $password);
		}
		elseif($db) {
			$pdo = new My_PDO("mysql:host=".$host."::".$port.";dbname=".$db, $username, $password);
		}
		else {
			return;
		}
		return($pdo);
	}
	catch(Exception $e) {
		file_put_contents(My_PDO::ERROR_LOG_FILE, $e->getMessage()."\n",FILE_APPEND);
		exit();
	}
}

function add_user($login, $password, $email, $is_admin) {
	if(!is_string($login)) {
		echo "Invalid login";
	}
	if(!is_string($password)) {
		echo "Invalid Password";
	}
	if(!is_string($email)) {
		echo "Invalid email";
	}
}

$valid_name = false;
$valid_email = false;
$valid_password = false;

if(isset($_POST["name"])) {
	if (strlen($_POST["name"]) >= 3 && strlen($_POST["name"]) <= 10) {
		$valid_name = TRUE;
	}
}

if(isset($_POST["email"]))  {
  $email = $_POST["email"];
	if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$valid_email = true;
	}
  else {
    $valid_email = false;
  }
}

if(isset($_POST["password"]) && isset($_POST["password_confirmation"])) {
	if (strlen($_POST["password"]) >= 3 && strlen($_POST["password"] <= 10) && $_POST["password"] == $_POST["password_confirmation"])	{
		$valid_password = true;
	}
}

if($valid_name && $valid_email && $valid_password)  {
	$hashed_pwd = password_hash($_POST["password"],PASSWORD_DEFAULT);
	add_user($_POST["name"],$hashed_pwd,$_POST["email"],"CURRDATE()", FALSE);
	echo "User created<br>";
}

echo '<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css.css">
	<title>Ex_01 - inscriptions</title>
</head>
<body>
<p>Inscriptions</p>';

if(isset($_POST["name"]) || isset($_POST["email"]) || isset($_POST["password"])) {
	if(!$valid_name)	{
		echo "Invalid name<br>";
	}
	if(!$valid_email) {
		echo "Invalid email<br>";
	}
	if(!$valid_password) {
		echo "Invalid password or password confirmation<br>";
	}
}

echo '<form method="post">
	<p><label for="Name">Name : </label>
	<input type="text" placeholder=';
	echo ($valid_name) ? $_POST["name"] : "name";
	echo ' name="name" id="Name"/></p>
	<p><label for="email">E-mail : </label>
	<input type="text" placeholder=';
	echo ($valid_email) ? $_POST["email"] : "email";
	echo ' name="email" id="email"/></p>
	<p><label for="password">Password : </label>
	<input type="password" name="password" id="password"/></p>
	<p><label for="pass_conf">Password_confirmation : </label>
	<input type="password" name="password_confirmation" id="pass_conf"/></p>
	<p><input type="submit" value="Submit"></p>
</form>
</body>
</html>';
?>
