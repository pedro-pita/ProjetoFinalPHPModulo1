<?
if (!isset($_SESSION))
    session_start();

if (!isset($_SESSION['UserID'])) {
    session_destroy();
    header("Location: index.php");
    exit;
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
	</head>
    <body>
        <section class="section_banner">
            <h1>Todos os Artigos</h1> 
        </section>
		<div class="menu">
			<ul>
			  <li class="active"><a href="./indexCliente.php">Pagina Inicial</a></li>
			  <li><a href="./contactoCliente.php">Quer Ser Vendedor?</a></li>
			  <li style="float:right"><a href="./logout.php"><span class="glyphicon glyphicon-user"></span>Logout</a></li>
			</ul>
		</div>
		<?php include_once './funcaoBD.php'; ?>
        <?php 
            $lista=getArtigoLista();
        ?>
        <main class="artigos">
        	<?php foreach ($lista as $fetch_artigo_lista): ?>
            <article>
                <img src="<?php echo $fetch_artigo_lista['imgPath']; ?>" alt="<?php echo $fetch_artigo_lista['id']; ?>" title="<?php echo $fetch_artigo_lista['altImg']; ?>" />
                <h2><?php echo $fetch_artigo_lista['nome']; ?></h2>
                <p><?php echo $fetch_artigo_lista['preco']."€/kg"; ?></p>
                <a href="ver.php?id=<?php echo $fetch_artigo_lista['id']; ?>">Mais Informação</a>
            </article>
            <?php endforeach; ?>
        </main>
        <footer>
            <div class="direitos">
				<h2>Øяіgіиαℓ ® - ✪ PedroPita ✪</h3>
				<h3>al216045@gmail.com</h3>
			</div>
        </footer>
    </body>
</html>
