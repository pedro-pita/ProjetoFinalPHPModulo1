<?
$host = $_SERVER['HTTP_HOST'];
$uri = rtrim(dirname($_SERVER['PHP_SELF']),"/\\");
$extra = "gerirContas.php";
define('HOME_URI',"http://$host$uri/$extra");
$connection = mysqli_connect('localhost', 'root', '', 'desafio2') or trigger_error(mysql_error());
$userUser;
$userNome;
$userEmail;
$userID;
$userPassword;

if (isset($_POST['save']) && isset($_POST['form_user_nome']) && $_POST['form_user_nome'] != '') {
    inserirUser($_POST['save']);
}
function inserirUser() {
    global $connection;
    $user = $_POST['form_user'];
    $nome = $_POST['form_user_nome'];
    $email = $_POST['form_user_email'];
	$password = sha1($_POST['form_user_password']);
    $sql = "INSERT INTO `dono` (nome,user,email,password,nivel)
            VALUES ('$nome', '$user','$email', '$password', '3')";

    if ($connection->query($sql) === TRUE) {
        echo "Nova conta criada com sucesso!";
    } else {
        echo "Error: " . $sql . "<br>" . $connection->error;
        return;
    }
}
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8" />
		<meta name="copyright" content="Projeto final de PHP">
		<meta name="author" content="Pedro Pita" />
		<title>Pagina Inicial</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="./css/style.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
	</head>
    <body>
        <section class="section_banner">
            <h1>Todos os Artigos</h1> 
        </section>
		<div class="menu">
			<ul>
			  <li class="active"><a href="./index.php">Pagina Inicial</a></li>
			  <li><a href="./contacto.php">Contacte-nos</a></li>
			  <li style="float:right"><a href="./login.php"><span class="glyphicon glyphicon-user"></span>Login</a></li>
			</ul>
		</div>
        <main class="criarConta">
        	<h3>Criar novas contas:</h3>
			<form method="post" action="">
				<table class="form-table">
					<tr>
						<td>Nome:</td>
						<td> <input type="text" name="form_user_nome" value="<?php
							if (isset($userNome))
								echo htmlentities($userNome); ?>" required />
						</td>
					</tr>
					<tr>
						<td>Username:</td>
						<td> <input type="text" name="form_user" value="<?php
							if (isset($userUser))
								echo htmlentities($userUser);?>" required />
						</td>
					</tr>
					<tr>
						<td>Email:</td>
						<td> <input type="email" name="form_user_email" value="<?php
							if (isset($userEmail))
								echo htmlentities($userEmail);?>" required />
						</td>
					</tr>
					<tr>
						<td>Password:</td>
						<td> <input type="text" name="form_user_password" value="" required />
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<input type="hidden" name="save" value="<?php echo $userID; ?>">
							<input type="submit" value="save" />
							<a href="<?php echo HOME_URI; ?>?new=<? if (isset($userID)) echo $userID; ?>">Novo</a>
						</td>
					</tr>
				</table>
			</form>
        </main>
    </body>
</html>

