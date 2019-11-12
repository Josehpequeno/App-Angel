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
				#topbar button.men{
					float: left;
					margin-right: 10px;
					font-size: 12pt;
					background: transparent;
					padding: 10px 15px;
					border: none;
					border-radius: 3px;
					font-weight: bold;
					color: #000;
					cursor: pointer;
				}
				#body form input#submit{
					float: right;
					margin-right: 10px;
					margin-top: -30px;
				}
				#topbar button.men:hover{
					background: #DDD;
				}
				h3{
					margin: 10px;
					color: #001a00;
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
  				#erro button.men{
					float: left;
					margin-right: 10px;
					font-size: 12pt;
					background: transparent;
					padding: 10px 15px;
					border: none;
					border-radius: 3px;
					font-weight: bold;
					color: #000;
					cursor: pointer;
				}
				#body form input#submit{
					float: right;
					margin-right: 10px;
					margin-top: -30px;
				}
				#erro button.men:hover{
					background: #DDD;
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
				<a href="Login.php"><button class="menu">Sair</button></a>
				<a href="Categorias.php"><button class="menu">Categorias</button></a>
				<a href="index.php"><button class="menu">Início</button></a>
				<a href="perfil.php"><button class="menu">Perfil</button></a>
				<form name="searchform" method="POST" action="Busca.php">
					<input type="text" name="pesquisa" placeholder="  Pesquisar"/>
				</form>
			</div>
			<div id="body">
				<div id="utilizador">
					<img src="imagens/Usuers.jpg" id="pic"/>
					<a href="Publicar.php"><button>Publicar algo&nbsp;&nbsp;<b>-></b>&nbsp;&nbsp; </button></a>
					<a href="perfil.php"><button>Ver perfil&nbsp;&nbsp;<b>-></b>&nbsp;&nbsp; </button></a>
					<a href="Configuracoes.php"><button>Configurações&nbsp;&nbsp;<b>-></b>&nbsp;&nbsp; </button></a>
				</div>
				<div id="posts">
					<!--<form method="POST" id="publicar">
						<textarea placeholder="Escreve ai please!!!" name="post_text"></textarea>
						<a href="#">Anexar arquivos</a>
						<input type="submit" id="submit" value="Publicar"/>
					</form>-->
					<div id="post">
						<!--<img src="imagens/Usuers.jpg" id="user" />
						<p id="user">Joseh esteve aqui</p>
						<span>2 dias</span>
						<p id="texto">Tudo que vai volta  <br> vem com a bunda que eu vou de ...  </p>
						<p id="texto">Rosas são vermelhas <br> violetas são azuis <br> procuro nas estrelas <br>por uma luz que me conduz <br>para um caminho feliz <br> oh! sim para longe do que eu fiz. </p>
						<img src="imagens/Gosto.jpg" id="gosto"/>-->
						<?php 
							echo "<h2> Lista de categorias </h2>";
							$check = mysqli_query($conn,"SELECT nome,descricao,id FROM categorias");
							if(mysqli_num_rows($check) == 0){
								echo "<h3> Não temos categorias no momento.</h3>";
							}else{
								?>
								<div id="topbar">
								<table>
									<tr>
										<th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nome</th>
										<th>Descrição</th>
									</tr>
										<?php  
	    									while($fetch = mysqli_fetch_row($check)){
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
							</table>
							</div>
						<form method="POST" id="cadastro" class="log" action="Cada_Categoria.php">
				            <input type="submit" id="submit" value="Criar Categoria" name="criar" class="btn"/>
				            <!--<h3>Já tem uma conta ? <a onclick="$'('#login').fadeIn(); $('#registrar').hide"href="Login.php">Entre aqui</a></h3>-->
			        	</form>
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
			</script>
			<!--<script type="text/javascript">
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
        </script>-->
		</body>
	</html>