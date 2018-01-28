<?php
$host = $_SERVER['HTTP_HOST'];
$uri=rtrim(dirname($_SERVER['PHP_SELF']),"/\\");
$extra="restritoVendedor.php";

if(!'HOME_URI')
    define('HOME_URI',"http://$host$uri/$extra");

$connection=mysqli_connect('localhost','root','','desafio2') or trigger_error(mysql_error());

$altImg;
$artigoDescricao;
$artigoImg;
$artigoID;
$artigoNome;
$artigoPreco;
$artigoStock;
$artigodono;

if(isset($_GET['del'])){
    deleteArtigo($_GET['del']);
}
if(isset($_POST['edit'])){
    $artigo=validarArtigo($_POST['edit']);
    validarForm($artigo);
}
if(isset($_POST['save']) && isset($_POST['form_artigo_alt']) && $_POST['form_artigo_descricao'] != ''){
    saveArtigo($_POST['save']);
}
if(isset($_GET['idMensagem'])){
    apagarMensagem($_GET['idMensagem']);
}

function getMensagens(){
    global $connection;
    $sql="SELECT * FROM `contacto`";
    $query=mysqli_query($connection,$sql);
    if (mysqli_num_rows($query)>0) {
        $resultado = mysqli_fetch_assoc($query);
        return $query;
    }else{
        exit;
    }
}
function apagarMensagem($mensagemId){
    global $connection;
  
    if (!empty($mensagemId)) {
        $mensagem_id = (int) $mensagemId;
        $sql="DELETE FROM `contacto` WHERE `id` = $mensagem_id";
        if ($connection->query($sql) === TRUE){
            echo '<p>Mensagem eliminada com sucesso</p>';
        }else {
            echo '<p>A mensagem não foi eliminada!</p>';
        }
    }
}
/*Artigos*/
function validarArtigo($artigoID){
    global $connection;
    $sql="SELECT * FROM `artigo` WHERE `id` = '$artigoID'";
    $db_check_artigo=mysqli_query($connection, $sql) or die(mysqli_error($connection));
    if(!$db_check_artigo){
        echo '<p class="form_error">Artigo não existe!<p/>';
        return false;
    }
    $fetch_artigo=mysqli_fetch_assoc($db_check_artigo);
    return $fetch_artigo;
}

function validarForm($artigo){
    global $altImg, $artigoDescricao, $artigoID, $artigoImg;
    $fetch_artigo=$artigo;
    if(!empty($fetch_artigo['id'])){
        $artigoID=$fetch_artigo['id'];
        $altImg=$fetch_artigo['altImg'];
        $artigoDescricao=$fetch_artigo['descricao'];
        $artigoImg=$fetch_artigo['imgPath'];
    }else{
        echo "<p><b>Artigo não existe!</b></p>";
    }
}

function saveArtigo($artigoID){
    global $connection;
    $fetch_artigo = validarArtigo($artigoID);
    
    if(!$fetch_artigo){
        insertArtigo();
		return;
    }
  
    $artigo_id = $fetch_artigo['id'];
    
    if(!empty($artigoID)){
        $sql="UPDATE artigo SET 
		altImg = '".$_POST['form_artigo_alt']."'
		, nome = '".$_POST['form_artigo_nome']."'
		, descricao = '".$_POST['form_artigo_descricao']."'
		, imgPath = '".$_POST['form_artigo_img']."'
		, preco = '".$_POST['form_artigo_preco']."'
		, stock = '".$_POST['form_artigo_stock']."'
		, dono = '".$_POST['form_artigo_img']."'
		WHERE id = ".$artigo_id;
		
        $query=mysqli_query($connection, $sql);
        
        if (!$query){
            echo '<p>Falha a atualizar os dados do artigo!</p>';
            return false;
        }else{
            echo '<p>Artigo atualizado com sucesso</p>';
            return;
        }
    }
}

function deleteArtigo($artigoID){
    global $connection;

    if (!empty($artigoID)) {
        $artigo_id= (int) $artigoID;
        $sql="DELETE FROM `artigo` WHERE `id` = $artigo_id";
        if ($connection->query($sql) === TRUE){
            echo '<p>O artigo foi apagado com sucesso!</p>';
        }else {
            echo '<p>O artigo não foi apagado com sucesso!</p>';
        }
    }
}

function insertArtigo(){
    global $connection;
    
    $nome=$_POST['form_artigo_nome'];
    $preco=$_POST['form_artigo_preco'];
    $stock=$_POST['form_artigo_stock'];
    $altImg=$_POST['form_artigo_alt'];
    $descricao=$_POST['form_artigo_descricao'];
    $imgPath=$_POST['form_artigo_img'];
    $dono=$_POST['form_artigo_dono'];
    
    $sql="INSERT INTO `artigo` (altImg, descricao, imgPath, nome, preco, stock, dono) VALUES ('$altImg','$descricao','$imgPath','$nome','$preco','$stock','$dono')";
    
    if($connection->query($sql) === TRUE){
        echo "<p>Artigo Adicionado com sucesso</p>";
    }else{
        echo "Error: ".$sql."</br>".$connection->error;
        return;
    }
}

function getArtigoLista(){
    global $connection;

    $sql="SELECT * FROM `artigo` ORDER BY id DESC";
    $query=mysqli_query($connection,$sql);
    if (mysqli_num_rows($query) > 0) {
        $resultado = mysqli_fetch_assoc($query);
        return $query;
        //return $resultado;
    }else{
        exit;
    }
}

function getArtigoListaVendedor($userid){
    global $connection;
    
    $sql="SELECT * FROM `artigo` WHERE `dono` = ".$userid." ORDER BY `id` DESC";
    $query=mysqli_query($connection,$sql);
    if (mysqli_num_rows($query) > 0) {
        $resultado = mysqli_fetch_assoc($query);
        return $query;
    }else{
        exit;
    }
}

function getArtigo($artigoID){
    global $connection;
    $sql="SELECT * FROM `artigo` WHERE `id` = $artigoID";
    $query=mysqli_query($connection,$sql);
    if (mysqli_num_rows($query) > 0) {
        $resultado = mysqli_fetch_assoc($query);
        return $resultado;
        //return $query;
    }else{
        exit;
    }
}