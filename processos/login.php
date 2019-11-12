<?php
	include ("../db.php");

	if (isset($_GET["login"])) {
		$login = $_POST['usuario'];
		$senha = md5(sha1($_POST['senha']));

		$query = mysqli_query($conn, "SELECT * FROM usuario WHERE email='$login' AND senha='$senha' LIMIT 1 ");
		$querw = mysqli_query($conn, "SELECT * FROM usuario WHERE nome='$login' AND senha='$senha' LIMIT 1 ");
		if (mysqli_num_rows($query)>=1) {
			?>
				<script type="text/javascript">
					document.cookie = "user=<?php echo $login; ?>;expires=Fri, 31 Dec 9999 23:59 GMT ";
					document.cookie = "userKey=<?php echo $senha; ?>;expires=Fri, 31 Dec 9999 23:59 GMT ";
					location.href ='index.php';
				</script>
			<?php
		}else if (mysqli_num_rows($querw)>=1) {
			$querx = mysqli_query($conn, "SELECT email FROM usuario WHERE nome='$login' LIMIT 1 ");
			$fetch = mysqli_fetch_row($querx);
			$login = $fetch[0];
			?>
				<script type="text/javascript">
					document.cookie = "user=<?php echo $login; ?>;expires=Fri, 31 Dec 9999 23:59 GMT ";
					document.cookie = "userKey=<?php echo $senha; ?>;expires=Fri, 31 Dec 9999 23:59 GMT ";
					location.href ='index.php';
				</script>
			<?php
		}else{
			echo '<h3 id="erro" >Informações incorretas </h3>';
		}
	}elseif (isset($_GET["registrar"])) {
		$email = $_POST["email"];
		$senha = md5(sha1($_POST["senha"]));
        $apelido = $_POST["apelido"];
		$confirmar_senha = md5(sha1($_POST["confirmar_senha"]));
		$nome = $_POST["nome"];
        //$data = date("Y/m/d");
        $biografia = $_POST["biografia"];
		$email_check = mysqli_query($conn, "SELECT * FROM usuario WHERE email='$email' LIMIT 1 ");
		$nome_check = mysqli_query($conn, "SELECT * FROM usuario WHERE nome='$nome' LIMIT 1 ");
		if (mysqli_num_rows($email_check)>=1) {
			echo '<h3 id="erro">Este email já está cadastrado </h3>';
		}elseif (mysqli_num_rows($nome_check)>=1) {
			echo '<h3 id="erro">Este nome já está cadastrado </h3>';
		}elseif($senha!=$confirmar_senha){
			echo '<h3 id="erro">A senha esta diferente do confirmar senha</h3>';
		}else{
			$string = "INSERT INTO usuario (nome,apelido,email,senha,data,biografia) VALUES ('$nome','$apelido','$email','$senha',now(),'$biografia')";
			$query = mysqli_query($conn, $string);
			if ($query) {
				?>
					<script type="text/javascript">
						document.cookie = "user=<?php echo $email; ?>;expires=Fri, 31 Dec 9999 23:59 GMT ";
						document.cookie = "userKey=<?php echo $senha; ?>;expires=Fri, 31 Dec 9999 23:59 GMT ";
						location.href ='index.php';
					</script>
				<?php
			}else{
				echo '<h3 id="erro" >Erro no registro<br> </h3>';
			}
		}
	}elseif (isset($_GET["alterar"])) {

		$senha = $_COOKIE["userKey"];
		$user = $_COOKIE["user"];
		$email = $_POST["email"];
		$antiga_senha = md5(sha1($_POST["antiga_senha"]));
		$nova_senha = md5(sha1($_POST["nova_senha"]));
        $apelido = $_POST["apelido"];
		$confirmar_senha = md5(sha1($_POST["confirmar_nova_senha"]));
		$nome = $_POST["nome"];
        $biografia = $_POST["biografia"];
        if($senha != $antiga_senha){
        	echo '<h3 id="erro">senha errada </h3>';
        }else{
        	$email_check = mysqli_query($conn, "SELECT * FROM usuario WHERE email='$email' LIMIT 1 ");
			if (mysqli_num_rows($email_check)>=1) {
				echo '<h3 id="erro">Este email já está cadastrado </h3>';
			}elseif (mysqli_num_rows($nome_check)>=1) {
				echo '<h3 id="erro">Este nome já está cadastrado </h3>';
			}elseif($nova_senha!=$confirmar_senha){
				echo '<h3 id="erro">A senha esta diferente do confirmar senha</h3>';
			}else{
				$string = "UPDATE usuario SET nome = '$nome',apelido = '$apelido',email = '$email',senha = '$nova_senha',biografia ='$biografia' WHERE email = '$user'";
				$query = mysqli_query($conn, $string);
				$g = "UPDATE arquivos SET user = '$email' WHERE user = '$user'";
				$s = mysqli_query($conn, $g); 
				if ($query and $s) {
					?>
						<script type="text/javascript">
							document.cookie = "user=<?php echo $email; ?>;expires=Fri, 31 Dec 9999 23:59 GMT ";
							document.cookie = "userKey=<?php echo $nova_senha; ?>;expires=Fri, 31 Dec 9999 23:59 GMT ";
							location.href ='index.php?msg=Alterado com sucesso';
						</script>
					<?php
				}else{
					echo '<h3 id="erro" >Erro na Alteração </h3>';
				}
			}
		}
	}
?>