<?php
	include("db.php");
    include("header.php");
	/*if (isset($_POST['entrar'])) {
		$email = $_POST['email'];
		$senha = $_POST['senha'];
		$verifica = mysqli_query($conn,"SELECT * FROM usuario WHERE email = '$email' AND senha = '$senha'");
		if (mysqli_num_rows($verifica)<=0) {
			echo "<h3>Email ou senha foi preenchido incorretamente</h3>";
		}else{
			setcookie("login",$email);
			header("location: ./");
		}

	}*/
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang="pt-br">
    <!--    color: #d9d9d9-->
    <head>
        <meta charset="UTF-8">
        <style type="text/css">
            body{
                background-color: #001a00; 
            }
            h1{
                color: #FFF;
                display: block;
                margin: auto;
                width: 90%;
                text-align: center;
                padding-top: 10vh;
                padding-bottom: 10vh;
            }
            h2{
                color: #FFF;
                text-align: center;
                margin-top: 20px;
            }
            h3{
                text-align: center;
                color: ##001a00;
                margin-top: 15px;
            }
            p#credits{
                color: #FFF;
            }
            h3#erro{
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
        <!--
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css" >
        <style type="text/css" >
            *{font-family: 'Montserrat', cursive;}
            img{display: block;margin: auto;margin-top: 20px;width: 200px;}
            form{text-align: center;margin-top: 20px;}
            input[type = "email"]{border: 1px solid #CCC;width: 250px;height: 25px;padding-left: 10px;border-radius:3px; }
            input[type = "password"]{border: 1px solid #CCC;width: 250px;height: 25px;padding-left: 10px;margin-top: 10px;border-radius:3px;}
        	input[type = "submit"]{border: none;width: 80px;height: 30px;margin-top: 20px;border-radius:3px;}
        	input[type = "submit"]:hover{background-color: #6600cc;color: #FFF;cursor: pointer;}
        	h2{text-align: center;margin-top: 20px; }
        	h3{text-align: center;color: #0000cc;margin-top: 15px;}
            a{text-decoration: nome; color: #333}
        </style>-->
    </head>
    <body>
        <p>
            <?php if (isset($_GET['msg']))  {
                echo "<h3 id='erro'>Mensagem do Sistema : ";
                echo $_GET['msg'].'</h3>';
            }?>
        </p>
        <h2>App Angel</h2>
        <form method="POST" id="login" class="log">
        	<img src="imagens/Angel2.jpg"><br/>
            <p>Entre na sua conta</p>
            <input type="text" placeholder="Email_ou_Nome de usuario" name="usuario" class="field" required="required" />
            <input type="password" placeholder="senha" name="senha" class="field" required="required" />
            <input type="submit" value="entrar" name="entrar" class="btn"/>
            <a onclick="$('#registrar').fadeIn(); $('#login').hide();">Se não tem conta ainda? Cadastre-se</a>
            <!--<h3>Se não tem conta ainda? <a onclick="$'('#registrar').fadeIn(); $('#login').hide" href="Registrar.php">Cadastre-se</a></h3>-->
        </form>
        <form method="POST" id="registrar" class="log">
            <img src="imagens/Angel2.jpg"/><br>
            <p>Crie sua conta</p>
            <input type="text" placeholder="Nome" name="nome" class="field" required="required"/>
            <input type="text" placeholder="Apelido" name="apelido" class="field" required="required" />
            <input type="email" placeholder="Email" name="email" class="field" required="required" />
            <input type="password" placeholder="senha" name="senha" class="field" required="required" />
            <input type="password" placeholder="confirmar senha" name="confirmar_senha" class="field" required="required" />
            <input type="text" placeholder="biografia" name="biografia" class="field" required="required" />
            <input type="submit" value="Criar conta" name="criar" class="btn"/>
            <a onclick="$('#login').fadeIn(); $('#registrar').hide();">Já tem uma conta ? Entre aqui</a>
            <!--<h3>Já tem uma conta ? <a onclick="$'('#login').fadeIn(); $('#registrar').hide"href="Login.php">Entre aqui</a></h3>-->
        </form>
        <p id="credits">&copy; Joseh - App Angel, 
            <?php echo date("Y"); ?> - Todos os direitos reservados             
        </p>
        <script type="text/javascript">
            $('#login').submit(function(e){
                var formData = new FormData($(this)[0]);
                $.ajax({
                    url: "processos/login.php?login",
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

            $('#registrar').submit(function(e){
                var formData = new FormData($(this)[0]);
                $.ajax({
                    url: "processos/login.php?registrar",
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