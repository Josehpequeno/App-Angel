<?php
	error_reporting(E_ALL ^ E_DEPRECATED);
	$conn = mysqli_connect('localhost','root','') or die ("Não foi possivel ligar á servidor ... ");
	$db = mysqli_select_db($conn,'angel_bd') or die("Impossível entrar na Base de Dados");

?>
<!DOCTYPE html>
	<html lang="pt-br">
		<header>
			<meta charset="UTF-8">
			<title> Angel </title>
		</header>
	</html>
