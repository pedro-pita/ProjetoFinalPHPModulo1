<?
if (!isset($_SESSION))
    session_start();

if (!isset($_SESSION['UserID'])) {
    session_destroy();
    header("Location: index.php");
    exit;
}
$host = $_SERVER['HTTP_HOST'];
$uri=rtrim(dirname($_SERVER['PHP_SELF']),"/\\");
$extra="gerirMensagens.php";
define('HOME_URI',"http://$host$uri/$extra");
$connection=mysqli_connect('localhost','root','','desafio2') or trigger_error(mysql_error());
include_once './funcaoBD.php';
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8" />
		<meta name="copyright" content="Projeto final de PHP">
		<meta name="author" content="Pedro Pita" />
		<title>Mensagens</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="./css/style.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
	</head>
    <body>
        <section class="section_banner">
            <h1>Area do Administrador</h1> 
        </section>
		<div class="menu">
			<ul>
			  <li class="active"><a href="./indexAdmin.php">Pagina Inicial</a></li>
			  <li><a href="./gerirContas.php">Gerir Contas</a></li>
			  <li><a href="./gerirArtigos.php">Gerir Artigos</a></li>
			  <li><a href="./gerirMensagens.php">Gerir Mensagens</a></li>
			  <li style="float:right"><a href="./logout.php"><span class="glyphicon glyphicon-user"></span>Logout</a></li>
			</ul>
		</div>
		<h3>Comentarios</h3>
        <?php
            $listaMensagens=getMensagens();
        ?>
        <table border="1">
            <thead>
                <tr>
                    <th>Id da mensagem</th>
                    <th>Nome do remetente</th>
                    <th>Email do remetente</th>
                    <th>Mensagem do remetente</th>
					<th>Opções</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($listaMensagens as $fetch_mensagens): ?>
                    <tr>
                        <td> <?php echo $fetch_mensagens['id']; ?> </td>
                        <td> <?php echo $fetch_mensagens['nome_cliente']; ?> </td>
                        <td> <?php echo $fetch_mensagens['email']; ?> </td>
                        <td> <?php echo $fetch_mensagens['mensagem']; ?> </td>
                        <td>
                            <a href="<?php echo HOME_URI; ?>?idMensagem=<?php echo $fetch_mensagens['id']; ?>">Apagar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
	</body>
</html>