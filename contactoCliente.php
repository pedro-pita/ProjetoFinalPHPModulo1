<?php
if (!isset($_SESSION))
    session_start();

if (!isset($_SESSION['UserID'])) {
    session_destroy();
    header("Location: index.php");
    exit;
}
$host = $_SERVER['HTTP_HOST'];
$uri = rtrim(dirname($_SERVER['PHP_SELF']),"/\\");
$extra = "contactoCliente.php";
define('HOME_URI',"http://$host$uri/$extra");
$connection = mysqli_connect('localhost', 'root', '', 'desafio2') or trigger_error(mysql_error());
$nomeCliente;
$mensagem;
$email;

if (isset($_POST['save']) && isset($_POST['form_user_nome']) && $_POST['form_mensagem'] != '') {
    enviarMensagem($_POST['save']);
}

function enviarMensagem() {
    global $connection;
    $nomeCliente = $_POST['form_user_nome'];
    $mensagem = $_POST['form_mensagem'];
    $email = $_POST['form_user_email'];
    $sql = "INSERT INTO `contacto` (nome_cliente,email,mensagem)
            VALUES ('$nomeCliente', '$email','$mensagem')";

    if ($connection->query($sql) === TRUE) {
        echo "<p>Mensagem enviada com sucesso!</p>";
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
		<title>Contacto</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="./css/style.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
	</head>
    <body>
        <section class="section_banner">
            <h1>Zona de Contacto<br></h1> 
        </section>
		<div class="menu">
			<ul>
			  <li class="active"><a href="./indexCliente.php">Pagina Inicial</a></li>
			  <li><a href="./contactoCliente.php">Quer Ser Vendedor?</a></li>
			  <li style="float:right"><a href="./logout.php"><span class="glyphicon glyphicon-user"></span>Logout</a></li>
			</ul>
			
		</div>
        <h3>Porque razão acha que merece ser vendedor?</h3>
        <form method="post">
            <table>
                <tr>
                    <td>Nome: </td>
                    <td> <input type="text" name="form_user_nome" value="<?php
                        if (isset($_SESSION['UserNome']))
                            echo $_SESSION['UserNome'];
                        ?>" readonly /></td>
                </tr>
                <tr>
                    <td>Email: </td>
                    <td> <input type="email" name="form_user_email" value="<?php
                        if (isset($_SESSION['UserID']))
                            echo $_SESSION['UserEmail'];
                        ?>" readonly /></td>
                </tr>
                <tr>
                    <td>Mensagem:</td>
                    <td> <input type="text" name="form_mensagem" value="" required /></td>
                </tr>
                <tr>
                    <td>
                        <input type="hidden" name="save" value="<?php echo $userID; ?>">
                        <input type="submit" value="save" />
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>
