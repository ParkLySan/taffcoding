<?php

// include_once(php_inscription.php);

// fonction ajout d'utilisateur, qui prend login et password, si login et password ne sont pas des strings, ca affiche nom incorrect.
function add_user($login, $password)
{
	if(!is_string($login))
  {
		echo "Nom d'utilisateur incorrect";
	}

	if(!is_string($password))
  {
		echo "Mot de passe incorrect";
	}
}

//par defaut valid nom et mdp sont faux, et tant que c'est faux on se connecte pas.
$valid_name = false;
$valid_password = false;

//Si name existe et qu'il est entre 3 et 10 caractères alors il passe en valide.
if(isset($_POST["name"]))
{
	if (strlen($_POST["name"]) >= 3 && strlen($_POST["name"]) <= 10)
  {
		$valid_name = true;
	}
}

// pareil pour password sauf que je compare la string de password et de confiramtion, et password n'est valide que si les deux strings sont similaires.
//Il faudra rajouter une fonction de verification de nom dans la bdd, si l'username est deja pris.
if(isset($_POST["password"]) && isset($_POST["password_confirmation"]))
{
	if (strlen($_POST["password"]) >= 3 && strlen($_POST["password"] <= 10) && $_POST["password"] == $_POST["password_confirmation"])
  {
		$valid_password = true;
	}
}

//si tout est bon alors on hash le pswd (je dois ajouter le salt) et affiche utilisateur créé.
if($valid_name && $valid_password)
{
	$hashed_pwd = password_hash($_POST["password"],PASSWORD_DEFAULT);
	echo "Utilisateur créé.<br>";
}

//On affiche le formulaire donc :
echo '<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css.css">
	<title>inscriptions</title>
</head>
<body>
<p>Inscriptions</p>';


if(isset($_POST["name"]) || isset($_POST["password"]))
{
	if(!$valid_name)
  {
		echo "pseudo invalide, votre pseudo doit contenir entre 3 et 10 carractères, et ne doit contenir que des lettres. <br>";
	}

	if(!$valid_password)
  {
		echo "Mot de passe ou confirmation de mot de passe incorrect. Le mot de passe doit contenir enntre 3 et 10 carractères et la confirmation doit être identique au mot de passe. <br>";
	}
}
/*  if($valid_name && $valid_password)
  {
    redirect index.php
  }
}
*/

echo '<form method="post">
	<p><label for="Name">Name : </label>
	<input type="text" placeholder=';
	echo ($valid_name) ? $_POST["name"] : "name";
	echo ' name="name" id="Name"/></p>
	<p><label for="password">Password : </label>
	<input type="password" name="password" id="password"/></p>
	<p><label for="pass_conf">Password_confirmation : </label>
	<input type="password" name="password_confirmation" id="pass_conf"/></p>
	<p><input type="submit" value="Submit"></p>
</form>
</body>
</html>';
