<?php
	include("db.php");
	include("header.php");
	if(!isset($_COOKIE["user"])){
?>
		<script type="text/javascript">
			document.cookie = "user=;expires=Thu, 01 Jan 1970 00:00:01 GMT";
			document.cookie = "userKey=;expires=Thu, 01 Jan 1970 00:00:01 GMT";
			location.href ='Login.php?msg=Você não fez o login';
		</script>
		<?php
	}
?>

<!DOCTYPE html>
	<html lang="pt-br">
		<head>
			<meta charset="UTF-8">
			<style type="text/css">
				body{
					background-color: #001a00;
				}
				h2{
					text-align: center;
	            	color: #001a00;
	            }
				h3{
					margin: 10px;
					color: #001a00;
	            }
	 			#body button.men{
					float: left;
					margin-left: : 10px;
					font-size: 12pt;
					background: transparent;
					padding: 10px 15px;
					border: none;
					border-radius: 3px;
					font-weight: bold;
					background-color: #ccffcc;
					color: #001a00;
					cursor: pointer;
				}
				#body form input#submit{
					float: right;
					margin-right: 10px;
					margin-top: -30px;
				}
				#body button.men:hover{
					background: #DDD;
				}
	            #Resp{
	            	color: #ffffff;
	            }
				#erro{
	                display: block;
	                margin: auto;
	                width: 80%;
	                max-width: 200px;
	                background: #FFF;
	                color: red;
	                padding: 10px;
	                margin-top: 20px;
	                margin-bottom: 20px;
	                text-align: center;
	                border-radius: 5px;
	                box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);
            	}
			</style>
		</head>
		<body>
        <p>
            <?php if (isset($_GET['msg']))  {
                echo "<h3 id='erro'>Mensagem do Sistema : ";
                echo $_GET['msg'].'</h3>';
             }?>
        </p>
			<div id="topbar">
				<!--<a onclick="$('#sair')"></a>  onClick=""windows.location("Login.php");-->
				<a href="Logout.php"><button class="menu" ">Sair</button></a>
				<a href="Categorias.php"><button class="menu">Categorias</button></a>
				<a href="index.php"><button class="menu">Início</button></a>
				<a href="perfil.php"><button class="menu">Perfil</button></a>
				<form name="searchform" method="POST" action="Busca.php">
					<input type="text" name="pesquisa" placeholder="  Pesquisar"/>
				</form>
			</div>
			<div id="body">
				<div id="utilizador">
					<?php echo "<h2>".$_COOKIE["user"]."</h2>"; ?>
					<img src="imagens/Usuers.jpg" id="pic"/>
					<a href="Publicar.php"><button>Publicar algo&nbsp;&nbsp;<b>-></b>&nbsp;&nbsp; </button></a>
					<a href="perfil.php"><button>Ver perfil&nbsp;&nbsp;<b>-></b>&nbsp;&nbsp; </button></a>
					<a href="Configuracoes.php"><button>Configurações&nbsp;&nbsp;<b>-></b>&nbsp;&nbsp; </button></a>
				</div>
				<div id="posts">
					<div id="post">
						<?php

						$busca = $_POST["pesquisa"];

						$user_check = mysqli_query($conn, "SELECT nome,email FROM usuario WHERE nome ='$busca' OR email = '$busca' ");
						$fet = mysqli_fetch_row($user_check);
						$email = $fet[1];
						$arq_check = mysqli_query($conn, "SELECT user,texto,imagem,data,cod_arquivos,id FROM arquivos WHERE user ='$email' OR texto = '$busca'");
						$cat_check = mysqli_query($conn, "SELECT nome,descricao,id FROM categorias WHERE nome ='$busca' OR descricao = '$busca' ");
						$user_check = mysqli_query($conn, "SELECT nome,email FROM usuario WHERE nome ='$busca' OR email = '$busca' ");
						if (mysqli_num_rows($user_check)>=1) {
							echo "<h3>Usuarios</h3>";
							while($feth = mysqli_fetch_row($user_check))
							{
								?>
						<form method="POST" id="salvar">
							<table width="380px">
	    						<tr><td><?php echo $feth[0]; ?></tr></td>
							</table>
						</form>
						<?php	}
						}if (mysqli_num_rows($arq_check)>=1) {
							echo "<h3>Arquivos</h3>";
							while($fetch = mysqli_fetch_row($arq_check))
							{
	    						?>
						<form method="POST" id="salvar" action=<?php echo "processos/trata_salvar.php?s=".$fetch[5]."&i=0";?>>
							<table width="380px">
	    							<tr><td>
	    								<img src="imagens/Usuers.jpg" id="user" />
	    								<p id="user"><?php echo $fetch[0];?></p>
	    								<span><?php echo $fetch[3];?></span>			
										<p id="texto"><?php echo $fetch[1]; ?></p><br><br>
										<input type="submit" id="submit" value="Salvar" name="salvo" />
									</td></tr>
								</table><br>
    					</form>
						<?php	}
						}if (mysqli_num_rows($cat_check) >= 1) {
								?>
								<div id="topbar">
								<table>
									<tr>
										<th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nome</th>
										<th>Descrição</th>
									</tr>
										<?php  
	    									while($fetch = mysqli_fetch_row($cat_check)){
	    								?>
									<tr>
										<td><a href=<?php echo "Lista_Arquivos.php?d=$fetch[2]"; ?>><button class="men"><?php echo $fetch[0]; ?></button></a></td>
										<td><?php echo $fetch[1]; ?></td>
									</tr>
										<?php
    										} 
    									?>
    								<?php
						}
						?>
					</div>
				</div>
			</div>
			<p id="credits">&copy; Joseh - App Angel, 
           		<?php echo date("Y"); ?> - Todos os direitos reservados             
        	</p>
			<script type="text/javascript">
				$.ajax({
                    	url: "processos/check.php",
                       	async: true,
                    	cache : false,
                    	contentType: false,
                    	processData: false,
                    	success: function(msg){
                        	$('#nada').html(msg);
                      	}
                });
	            $('#publicar').submit(function(e){
	                var formData = new FormData($(this)[0]);
	                $.ajax({
	                    url: "processos/post.php",
	                    type: "POST",
	                    data: formData,
	                    async: true,
	                    cache : false,
	                    contentType: false,
	                    processData: false,
	                    beforeSend: function(){
	                        $('#loading').show();
	                    },
	                    beforeSend: function(){
	                        $('#loading').show();  
	                    },
	                    success: function(msg){
	                        $('#nada').html(msg);
	                        $('#loading').hide();
	                    }
	                });
	                e.preventDefault();
	            });
        </script>
		</body>
	</html>