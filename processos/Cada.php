<?php
	include ("../db.php");

	if (isset($_GET["cadastro"])) {
		$nome = $_POST["nome"];
		$descricao = $_POST["descricao"];
		
		$check = mysqli_query($conn, "SELECT * FROM categorias WHERE nome='$nome' LIMIT 1 ");
		if (mysqli_num_rows($check)>=1) {
			echo '<h3 id="erro" >Já existe uma categoria com esse nome. </h3>';
		}else{
			$string = "INSERT INTO categorias (nome,descricao,data) VALUES ('$nome','$descricao',now())";
			$query = mysqli_query($conn, $string);
			if ($query) {
				echo '<h3 id="Resp">Cadastro efetuado com sucesso</h3>';
			}else{
				echo '<h3 id="erro" >Erro no cadastro</h3>';
			}
		}
	}
?>