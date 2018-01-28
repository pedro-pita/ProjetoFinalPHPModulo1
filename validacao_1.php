<?
	if(!empty($_POST) AND (empty($_POST['user']) OR empty($_POST['password']))){
		header("Location: index.php");
		exit;
	}
	$connection = mysqli_connect('localhost','root','') or trigger_error(mysqli_error());
	mysqli_select_db($connection,'desafio2') or trigger_error(mysqli_error());

	$user =mysqli_real_escape_String($connection, $_POST['user']);
	$password= mysqli_real_escape_String($connection, $_POST['password']);

	$sql="SELECT * FROM `dono` WHERE (`user` = '".$user."')"." AND (`password` = '".sha1($password)."')";
	$query = mysqli_query($connection, $sql);

	if(!mysqli_num_rows($query) == 1){
		echo "Login invalido!!!";
		//header ("refresh:5;url=index.php");
		exit;
	} else {
		$resultado = mysqli_fetch_assoc($query);
		if(!isset($_SESSION))
			session_start();
			
		$_SESSION['UserID'] = $resultado['id'];
		$_SESSION['UserNome'] = $resultado['nome'];
		$_SESSION['UserNivel'] = $nivel = $resultado['nivel'];
		$_SESSION['UserEmail'] = $resultado['email'];
		
		switch($nivel){
			case 1: header("Location: indexAdmin.php"); break;
			case 2: header("Location: indexVendedores.php"); break;
			case 3: header("Location: indexCliente.php");break;
			default: echo "Esta utilizador nao tem poder nenhum!";
		}
	}
?>