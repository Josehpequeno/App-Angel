<?php
	
	include ("../db.php");

	$busca["pesquisa"];

	$usur_check = mysqli_query($conn, "SELECT * FROM salvos WHERE id_arquivo ='$id_arquivo' AND id_user = '$e' ");
		
		if (mysqli_num_rows($arq_check)>=1) {
				echo '<h3 id="erro">Este arquivo já está salvo </h3>';
		}else{


?>