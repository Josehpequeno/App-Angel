<?php 

	include ("../db.php");

	if (isset($_GET["s"])) {
		$id_arquivo = $_GET["s"];
		$i = $_GET["i"];
		$user = $_COOKIE["user"];
		$chee = mysqli_query($conn,"SELECT id FROM usuario WHERE email = '$user'");
		$fete = mysqli_fetch_row($chee);
		$e = $fete[0];
		$arq_check = mysqli_query($conn, "SELECT * FROM salvos WHERE id_arquivo ='$id_arquivo' AND id_user = '$e' LIMIT 1 ");
		
		if (mysqli_num_rows($arq_check)>=1) {
				echo '<h3 id="erro">Este arquivo já está salvo </h3>';
		}else{
			$check = mysqli_query($conn,"INSERT INTO salvos (id_user,id_arquivo,data) VALUES ($e','$id_arquivo',now())");
			if ($check) {
				if($i == 0){
					?>
						<script type="text/javascript">
							location.href ='index.php';
						</script>
					<?php
				}else{
					?>
						<script type="text/javascript">
							location.href ='Lista_Arquivos.php';
						</script>
					<?php
				}
				echo '<h3 id="Resp">Arquivo Salvo</h3>'; 
			}else{
				echo '<h3 id="erro">Erro no registro<br> </h3>';
			}
		}
	}
	elseif (isset($_GET["d"])) {
		$id_arquivo = $_GET["d"];
		$user = $_COOKIE["user"];
		$chee = mysqli_query($conn,"SELECT id FROM usuario WHERE email = '$user'");
		$fete = mysqli_fetch_row($chee);
		$e = $fete[0];
		$arq_check = mysqli_query($conn, "SELECT * FROM salvos WHERE id_arquivo ='$id_arquivo' LIMIT 1 ");

		if (mysqli_num_rows($arq_check)<=1) {
			echo '<h3 id="erro">Este arquivo não existe </h3>';
		}else{
			$check = mysqli_query($conn,"DELETE salvos WHERE id_arquivo = '$id_arquivo' AND id_user = '$e'");
			if ($check) {
				?>
				<script type="text/javascript">
					location.href ='Lista_Arquivos_Salvos.php';
				</script>
				<?php
				echo '<h3 id="Resp">Arquivo Deletado da lista de salvos</h3>'; 
			}else{
				echo '<h3 id="erro">Erro na deletação<br> </h3>';
			}
		}
	}
?>