<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8" />
		<meta name="copyright" content="Projeto final de PHP">
		<meta name="author" content="Pedro Pita" />
		<title>Login</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="./css/style.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
	</head>
    <body>
        <section class="section_banner">
            <h1>Login</h1> 
        </section>
		<div class="menu">
			<ul>
			  <li class="active"><a href="./index.php">Pagina Inicial</a></li>
			  <li style="float:right"><a href="./login.php"><span class="glyphicon glyphicon-user"></span>Login</a></li>
			</ul>
		</div>
        <form action = "validacao_1.php" method = "post">
            <fieldset>
                <legend>Dados de Login</legend>
                <label for = "txUser">User</label>
                <input type = "text" name = "user" id = "txUser" maxlength = "25" required />
                <label for = "txPassword">Password</label>
                <input type = "password" name = "password" id = "txPassword" required />
                <input type = "submit" value = "Entrar" />
            </fieldset>
        </form>
		<p><a href="criarConta.php" >Criar Conta</a></p>
    </body>
</html>
