<?php
    include("db.php");
    include ("header.php");
    if (isset($_POST['criar'])) {
        $nome = $_POST['nome'];
        $apelido = $_POST['apelido'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $data = date("Y/m/d");
        $biografia = $_POST['biografia'];
        $email_check = mysqli_query($conn,"SELECT email FROM usuario WHERE email = '$email'");
        $do_email_check = mysqli_num_rows($email_check);
        if ($do_email_check >= 1) {
            echo "<h3>Este email já foi cadastrado</h3>";
        }else if ($nome == '' or strlen($nome) < 3) {
            echo "<h3>Escreve seu nome corretamente!</h3>";
        }elseif ($email == '' or strlen($email) < 3) {
            echo "<h3>Escreve seu email corretamente!</h3>";
        }elseif ($senha == '' or strlen($senha) < 5) {
            echo "<h3>Escreve sua senha corretamente e com mais de 5 caracteres ! </h3>";
        }else{
            $query = "INSERT INTO usuario (nome,apelido,email,senha,data,biografia)
            VALUES ('$nome','$apelido','$email','$senha','$data','$biografia')";
            $dt = mysqli_query($conn,$query) or die(myqli_error());
            if($dt)
            {
                setcookie("login",$email);
                header("location: ./");
            }else{
                echo "<h3>Desculpe ocorreu um erro no registro</h3>";
            }
        }
        
    }
    
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <!--
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css" >
        <style type="text/css">
            *{font-family: 'Montserrat', cursive;}
            img{display: block;margin: auto;margin-top: 20px;width: 200px;}
            form{text-align: center;margin-top: 10px}
            input[type = "text"]{border: 1px solid #CCC;width: 250px;height: 25px;padding-left: 10px;border-radius:3px;margin-top: 10px; }
            input[type = "email"]{border: 1px solid #CCC;width: 250px;height: 25px;padding-left: 10px;border-radius:3px;margin-top: 10px; }
            input[type = "password"]{border: 1px solid #CCC;width: 250px;height: 25px;padding-left: 10px;margin-top: 10px;border-radius:3px;}
        	input[type = "submit"]{border: none;width: 80px;height: 30px;margin-top: 20px;border-radius:3px;}
        	input[type = "submit"]:hover{background-color: #6600cc;color: #FFF;cursor: pointer;}//#666699
        	h2{text-align: center;margin-top: 20px; }
        	h3{text-align: center;color: #0000cc;margin-top: 15px;}
            a{text-decoration: nome; color: #333}
        </style>-->
        <style type="text/css">
            body{
                background-color: #001a00; 
            }
            h1{
                color: #2ECC40;
                display: block;
                margin: auto;
                width: 90%;
                text-align: center;
                padding-top: 10vh;
                padding-bottom: 10vh;
            }
            h2{
                text-align: center;
                margin-top: 20px;
            }
            h3{
                text-align: center;
                color: #0000cc;
                margin-top: 15px;
            }
        </style>
    </head>
    <body>
        <form method="POST" id="registro" class="log">
        	<img src="imagens/Angel2.jpg"><br/>
        	<h2>Crie sua conta</h2>
            <input type="text" placeholder="Nome" class="field" name="nome"/><br/>
            <input type="text" placeholder="Apelido" name="apelido" class="field" /><br/>
            <input type="email" placeholder="Email" name="email" class="field"/><br/>
            <input type="password" placeholder="senha" name="senha" class="field"/><br/>
            <input type="text" placeholder="biografia" name="biografia" class="field" /><br/>
            <input type="submit" value="Criar conta" name="criar" class="btn"/>
            <h3>Já tem uma conta ? <a onclick="$'('#login').fadeIn(); $('#registrar').hide"href="Login.php">Entre aqui</a></h3>
        </form>
        <p id="credits">&copy; Joseh - App Angel, 
            <?php echo date("Y"); ?> - Todos os direitos reservados             
        </p>
        <p>
            <?php if (isset($_GET['msg']))  {
                echo "Mensagem do Sistema : ";
                echo $_GET['msg'];
             }?>
        </p>
    </body>
</html>