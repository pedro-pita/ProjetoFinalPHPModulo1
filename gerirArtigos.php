<?
if (!isset($_SESSION))
    session_start();

if (!isset($_SESSION['UserID'])) {
    session_destroy();
    header("Location: index.php");
    exit;
}
$host = $_SERVER['HTTP_HOST'];
$uri = rtrim(dirname($_SERVER['PHP_SELF']),"/\\");
$extra = "gerirArtigos.php";
define('HOME_URI',"http://$host$uri/$extra");
$connection = mysqli_connect('localhost', 'root', '', 'desafio2') or trigger_error(mysql_error());
include_once './funcaoBD.php';
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8" />
		<meta name="copyright" content="Projeto final de PHP">
		<meta name="author" content="Pedro Pita" />
		<title>Area do Administrador</title>
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
			<h3>Adicionar Artigos </h3>
			<form method="post" action="">
				<table class="form-table">
					<tr>
						<td>Id do Vendedor:</td>
						<td> <input type="text" name="form_artigo_dono" value="<?php
								  echo $_SESSION['UserID'];
							?>" readonly required /></td>
					</tr>
					<tr>
						<td>Nome:</td>
						<td> <input type="text" name="form_artigo_nome" value="<?php
								if (isset($artigoNome))
									echo htmlentities($artigoNome);
							?>" required  /></td>
					</tr>
					<tr>
						<td>Descriçao:</td>
						<td> <input type="text" name="form_artigo_descricao" value="<?php
								if (isset($artigoDescricao))
									echo htmlentities($artigoDescricao);
							?>" required /></td>
					</tr>
					<tr>
						<td>Preço:</td>
						<td> <input type="number" min="0" step="0.01" name="form_artigo_preco" value="<?php
								if (isset($artigoPreco))
									echo htmlentities($artigoPreco);
							?>" required /></td>
					</tr>
					<tr>
						<td>Stock:</td>
						<td> <input type="number" min="0" name="form_artigo_stock" value="<?php
								if (isset($artigoStock))
									echo htmlentities($artigoStock);
							?>" required /></td>
					</tr>
					<tr>
						<td>Alt Img: </td>
						<td> <input type="text" name="form_artigo_alt" value="<?php
								if (isset($altImg))
									echo htmlentities($altImg);
							?>" required /></td>
					</tr>
					<tr>
						<td>Img Path:</td>
						<td> <input type="text" name="form_artigo_img" value="<?php
								if (isset($artigoImg))
									echo htmlentities($artigoImg);
							?>" required /></td>
					</tr>
					<tr>
						<td colspan="2">
							<input type="hidden" name="save" value="<?php echo $artigoID; ?>">
							<input type="submit" value="save" />
							<a href="<?php echo HOME_URI; ?>?new=<?php if (isset($artigoID)){ echo $artigoID; } ?>">Novo</a>
						</td>
					</tr>
				</table>
			</form>
			<?php 
				$lista=getArtigoLista();
			?>
		<h3>Artigos</h3>
		<table border="1">
			<thead>
				<tr>
					<th>Id</th>
					<th>Nome</th>
					<th>Descrição</th>
					<th>ImgPath</th>
					<th>AltImg</th>
					<th>Preço</th>
					<th>Stock</th>
					<th>Id dono</th>
					<th>Opções</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($lista as $fetch_artigo_data): ?>
					<tr>
						<td> <?php echo $fetch_artigo_data['id']; ?> </td>
						<td> <?php echo $fetch_artigo_data['nome']; ?> </td>
						<td> <?php echo $fetch_artigo_data['descricao'] ?> </td>
						<td> <?php echo $fetch_artigo_data['imgPath'] ?> </td>
						<td> <?php echo $fetch_artigo_data['altImg'] ?> </td>
						<td> <?php echo $fetch_artigo_data['preco']."€/Kg"?> </td>
						<td> <?php echo $fetch_artigo_data['stock']."Kg"?> </td>
						<td> <?php echo $fetch_artigo_data['dono']?> </td>
						<td> 
							<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
								<input type="hidden" name="edit" value="<?php echo $fetch_artigo_data['id']; ?>">
								<input type="submit" name="submit" value="Edit">
							</form>
							<a href="<?php echo HOME_URI; ?>?del=<?php echo $fetch_artigo_data['id']; ?>">Apagar</a>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</body>
</html>