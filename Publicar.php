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
				#body form textarea{
					height: 600px;
				}
				#body form textarea#input{
					margin-top: 10px;
					height: 25px;
				}
				#body form input#submit{
					float: right;
					margin-right: 10px;
					margin-top: -27px;
				}
				h2{
					text-align: center;
	            	color: #001a00;
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
				<a href="Login.php"><button class="menu" ">Sair</button></a>
				<a href="Categorias.php"><button class="menu">Categorias</button></a>
				<a href="index.php"><button class="menu">Início</button></a>
				<a href="perfil.php"><button class="menu">Perfil</button></a>
				<form name="searchform" method="POST" action="Busca.php">
					<input type="text" name="pesquisa" placeholder="  Pesquisar"/>
				</form>
			</div>
			<div id="body">
				<div id="costs">
					<form method="POST" id="publicar">
						<textarea placeholder="se a criatividade surgir
escreva aqui" name="post_text"
							 rows="30" cols="40" maxlength="4000"></textarea>
						<a href="#">Anexar arquivos</a>
						<textarea id = "input" placeholder="categoria em que você quer publicar" name="nome_categoria"></textarea>
						<input type="submit" id="submit" value="Publicar"/>
					</form>
					<!--<div id="post">
						<form method="POST" id="cadastro" class="log" >
				            <p>Área de cadastro de Categorias </p>
				            <input type="text" placeholder="Nome" name="nome" class="field" required="required"/>
				            <input type="text" placeholder="Descrição" name="descricao" class="field" required="required" />
				            <input type="submit" value="Criar Categoria" name="criar" class="btn"/>
				            <h3>Já tem uma conta ? <a onclick="$'('#login').fadeIn(); $('#registrar').hide"href="Login.php">Entre aqui</a></h3>
			        	</form>-->
							<!--<img src="imagens/Usuers.jpg" id="user" />
						<p id="user">Joseh esteve aqui</p>
						<span>2 dias</span>
						<p id="texto">Tudo que vai volta  <br> vem com a bunda que eu vou de ...  </p>
						<p id="texto">Rosas são vermelhas <br> violetas são azuis <br> procuro nas estrelas <br>por uma luz que me conduz <br>para um caminho feliz <br> oh! sim para longe do que eu fiz. </p>
						<img src="imagens/Gosto.jpg" id="gosto"/>-->
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