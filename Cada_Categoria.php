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
				<div id="utilizador">
					<img src="imagens/Usuers.jpg" id="pic"/>
					<a href="Publicar.php"><button>Publicar algo&nbsp;&nbsp;<b>-></b>&nbsp;&nbsp; </button></a>
					<a href="perfil.php"><button>Ver perfil&nbsp;&nbsp;<b>-></b>&nbsp;&nbsp; </button></a>
					<a href="Configuracoes.php"><button>Configurações&nbsp;&nbsp;<b>-></b>&nbsp;&nbsp; </button></a>
					<!--<button>Terminar sessão&nbsp;&nbsp;<b>-></b>&nbsp;&nbsp; </button>-->
				</div>
				<div id="posts">
					<!--<form method="POST" id="publicar">
						<textarea placeholder="Escreve ai please!!!" name="post_text"></textarea>
						<a href="#">Anexar arquivos</a>
						<input type="submit" id="submit" value="Publicar"/>
					</form>-->
					<div id="post">
						<form method="POST" id="cadastro" class="log" >
				            <p>Área de cadastro de Categorias </p>
				            <input type="text" placeholder="Nome" name="nome" class="field" required="required"/>
				            <input type="text" placeholder="Descrição" name="descricao" class="field" required="required" />
				            <input type="submit" value="Criar Categoria" name="criar" class="btn"/>
			        	</form>
					</div>
				</div>
			</div>
			<p id="credits">&copy; Joseh - App Angel, 
            	<?php echo date("Y"); ?> - Todos os direitos reservados             
        	</p>
			<script type="text/javascript">
	            $('#cadastro').submit(function(e){
	                var formData = new FormData($(this)[0]);
	                $.ajax({
	                    url: "processos/Cada.php?cadastro",
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