<?php
	include("check.php");
	//include("../db.php");

	$text = preg_replace("/(\\r)?\\n/i", "<br/>", $_POST["post_text"]);

	if ($text!="" AND strlen($text) <= 1000) {
		//$string = "INSERT INTO `arquivos` (`user`, `texto`,`data`) VALUES ('$user', '$texto', now())";
		//$string = "INSERT INTO `arquivos` (`id`, `user`, `texto`, `imagem`, `data`) VALUES (NULL, \'usuario@gmail.com\', \'vai que eu tbm vou\\r\\npara relaxar\', \'\', now())";
		if(strlen($_POST["nome_categoria"]) > 0){
			$t = $_POST["nome_categoria"];
			$check = mysqli_query($conn,"SELECT id FROM categorias WHERE nome='$t' LIMIT 1");
			if(mysqli_num_rows($check) == 0){
				echo '<h3 id="erro" >Não existe essa categoria </h3>';
				echo '<div id="body"><a  href="Cada_Categoria.php"><button class="men">Essa categoria não existe quer cadastra-la</button></a></div>';
			}
			$k = mysqli_fetch_row($check)[0];
		}else{
			$k = 1;
		}
		$string = "INSERT INTO arquivos (user,texto,data,imagem,cod_arquivos) VALUES ('$user','$text',now(),'','$k')";
		$insert = mysqli_query($conn, $string);
		if ($insert) {
			echo '<h3 id="Resp" >Publicado</h3>';
		}else{
			echo '<h3 id="erro">Erro </h3>';
		}
	}else{
		echo "<h3>Escreve alguma coisa o limite de caracteres atualmente é 1000</h3>";
	}
?>