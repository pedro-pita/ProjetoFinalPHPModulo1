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
$extra = "gerirContas.php";
define('HOME_URI',"http://$host$uri/$extra");
$connection = mysqli_connect('localhost', 'root', '', 'desafio2') or trigger_error(mysql_error());
$userUser;
$userNome;
$userEmail;
$userID;
$userPassword;

if (isset($_GET['del'])) {
    deleteUser($_GET['del']);
}
if (isset($_POST['edit'])) {
    $user = validarUser($_POST['edit']);
    validateForm($user);
}
if (isset($_POST['save']) && isset($_POST['form_user_nome']) && $_POST['form_user_nome'] != '') {
    saveUser($_POST['save']);
}

function validarUser($userID) {
    global $connection;
    $sql = "SELECT * FROM `dono` WHERE `id` ='$userID'";
    $db_check_user = mysqli_query($connection, $sql) or die(mysqli_error($connection));
    if (!$db_check_user) {
        echo '<p class="form_error">Internal error: User not exist</p>';
        return false;
    }
    $fetch_user = mysqli_fetch_assoc($db_check_user);
    return $fetch_user;
}

function validateForm($user) {
    global $userNome, $userUser, $userEmail, $userID, $userPassword;
    $fetch_user = $user;
    if (!empty($fetch_user['id'])) {
        $userID = $fetch_user['id']; 
        $userNome = $fetch_user['nome']; 
        $userUser = $fetch_user['user']; 
        $userEmail = $fetch_user['email']; 
		$userPassword = $fetch_user['password']; 
		echo $fetch_user['email'];
    } else {
        echo "User not defined";
    }
}
function saveUser($userID) { 
    global $connection;
    $fetch_user = validarUser($userID);
    if (!$fetch_user) {
        inserirUser();
    }
	$user_id = $fetch_user['id'];
	$password = $_POST['form_user_password'];
    if (!empty($user_id)) {
		if(empty($password)){
			$sql = "UPDATE dono SET 
				nome='" . $_POST['form_user_nome'] . "'
				, email = '" .$_POST['form_user_email'] . "'
				, user = '" . $_POST['form_user'] . "'
				, nivel = '" .$_POST['form_user_nivel'] . "'
				WHERE id = " . $user_id;
		}else{
			$sql = "UPDATE dono SET 
			nome='" . $_POST['form_user_nome'] . "'
			, email = '" .$_POST['form_user_email'] . "'
			, user = '" . $_POST['form_user'] . "'
			, password = '" .sha1($_POST['form_user_password']) . "'
			, nivel = '" .$_POST['form_user_nivel'] . "'
			WHERE id =" . $user_id;
		}
        $query = mysqli_query($connection, $sql) OR die(mysqli_error($connection));
        if (!$query) {
            echo '<p>Internal error. Data has not update.</p>';
            return;
        } else {
            echo '<p>User successfully updated.</p>';
            return;
        }
    }
}

function deleteUser($userID) {
    global $connection;
    if (!empty($userID)) {
        $user_id = (int) $userID;
        $sql = "DELETE FROM `dono` WHERE `id` = $user_id";
        if ($connection->query($sql) === TRUE) {
            echo "Record deleted successfully\n";
        } else {
            echo "Error deleting record: " . $connection->error;
        }
        echo '<script type="text/javascript">window.location.href = "' . HOME_URI . '";</script>';
        return;
    }
}

function inserirUser() {
    global $connection;
    $user = $_POST['form_user'];
    $nome = $_POST['form_user_nome'];
    $email = $_POST['form_user_email'];
	$password = sha1($_POST['form_user_password']);
	$nivel = $_POST['form_user_nivel'];
    $sql = "INSERT INTO `dono` (nome,user,email,password,nivel)
            VALUES ('$nome', '$user','$email', '$password', '$nivel')";

    if ($connection->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $connection->error;
        return;
    }
}
function getUserLista() {
    global $connection;
    $sql = "SELECT * FROM `dono` ORDER BY user DESC";
    $query = mysqli_query($connection, $sql);

    if (mysqli_num_rows($query) > 0) { 
        $resultado = mysqli_fetch_assoc($query);
        return $query;
    } else {
        exit;
    }
}
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8" />
		<meta name="copyright" content="Projeto final de PHP">
		<meta name="author" content="Pedro Pita" />
		<title>Gerir Contas</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="./css/style.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
	</head>
    <body>
        <section class="section_banner">
            <h1>Gerir Contas</h1> 
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
		<h3>Criar novas contas:</h3>
        <form method="post" action="">
			<table class="form-table">
				<tr>
					<td>Nome:</td>
					<td> <input type="text" name="form_user_nome" value="<?php
						if (isset($userNome))
							echo htmlentities($userNome); ?>" />
					</td>
				</tr>
				<tr>
					<td>Username:</td>
					<td> <input type="text" name="form_user" value="<?php
						if (isset($userUser))
							echo htmlentities($userUser);?>" />
					</td>
				</tr>
				<tr>
					<td>Email:</td>
					<td> <input type="email" name="form_user_email" value="<?php
						if (isset($userEmail))
							echo htmlentities($userEmail);?>" />
					</td>
				</tr>
				<tr>
					<td>Password:</td>
					<td> <input type="text" name="form_user_password" value=""/></td>
				</tr>
				<tr>
					<td>Nivel:</td>
					<td> <input type="text" name="form_user_nivel" value="<?php
						if (isset($userNivel))
							echo htmlentities($userNivel);?>" />
					</td>
				</tr>
				<tr>
				<tr>
					<td colspan="2">
						<input type="hidden" name="save" value="<?php echo $userID; ?>">
						<input type="submit" value="save" />
						<a href="<?php echo HOME_URI; ?>?new=<? if (isset($userID)) echo $userID; ?>">Novo</a>
					</td>
				</tr>
			</table>
		</form>
        <br>
		<h3>Contas da base de dados:</h3>
		<p>Contas com artigos atribuidos não podem ser eliminadas.</p>
        <?php
			$userLista = getUserLista();
        ?>
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
					<th>Nivel</th>
                    <th>User</th>
                    <th>Nome</th>
                    <th>Edição</th>
					<th>Opções</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($userLista as $fetch_user_lista): ?>
                    <tr>
                        <td> <?php echo $fetch_user_lista['id']; ?> </td>
						<td> <?php echo $fetch_user_lista['nivel'] ?> </td>
                        <td> <?php echo $fetch_user_lista['user'] ?> </td>
                        <td> <?php echo $fetch_user_lista['nome'] ?> </td>
						<td> <?php echo $fetch_user_lista['email']?> </td>
                        <td> 
                            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                <input type="hidden" name="edit" value="<?php echo $fetch_user_lista['id']; ?>">
                                <input type="submit" name="submit" value="Edit">
                            </form>
                            <a href="<?php echo HOME_URI; ?>?del=<?php echo $fetch_user_lista['id']; ?>">Apagar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
	</body>
</html>