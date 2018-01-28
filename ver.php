<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8" />
		<meta name="copyright" content="Projeto final de PHP">
		<meta name="author" content="Pedro Pita" />
    <title>Home</title>
    <link rel="stylesheet" href="./css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
</head>
<body>
    <section class="section_banner">
        <h1>Detalhes do produto</h1>
    </section>
	<div class="menu">
		<ul>
			<li class="active"><a href="./index.php">Pagina Inicial</a></li>
			<li><a href="./contacto.php">Contacte-nos</a></li>
			<li style="float:right"><a href="./login.php"><span class="glyphicon glyphicon-user"></span>Login</a></li>
		</ul>
	</div>
    <?php include_once './funcaoBD.php'; ?>
    <?php 
        if(empty($_GET['id'])){
            header("Location: index.php");
            exit;
        }
    ?>
    <?php
        $listaArtigo = getArtigo($_GET['id']);
    ?>
    <main class="artigos">
        <article class="detalhes">
            <img class="detalhes_img" src="<?php echo $listaArtigo['imgPath']; ?>" title="<?php echo $listaArtigo['altImg']; ?>" alt="<?php echo $listaArtigo['id']; ?>"  />
            <h2><?php echo $listaArtigo['nome']; ?></h2>
			<h4>Descrição</h4>
            <p><?php echo $listaArtigo['descricao']; ?></p>
            <h4>Preço</h4>
            <p><?php echo $listaArtigo['preco']."€/Kg"; ?></p>
			<h4>Stock</h4>
            <p><?php echo $listaArtigo['stock']."Kg"; ?></p>
        </article>
    </main>
    <footer>
		<div class="direitos">
			<h2>Øяіgіиαℓ ® - ✪ PedroPita ✪</h2>
			<h3>al216045@gmail.com</h3>
		</div>
    </footer>
</body>
</html>