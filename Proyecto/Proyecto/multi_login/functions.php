<?php 
session_start();

// CONECTAR BASE DE DATOS
$db = mysqli_connect('localhost', 'root', '', 'multi_login');

// DECLARAR VARIABLES
$username = "";
$email    = "";
$errors   = array(); 

// LLAMAR A REGISTRO
if (isset($_POST['register_btn'])) {
	register();
}

// RESGISTRAR USUARIOS
function register(){

	global $db, $errors, $username, $email;

	// recibe todos los valores de entrada del formulario. Llame a la función e ()
    // definido a continuación para escapar de los valores del formulario
	$username    =  e($_POST['username']);
	$email       =  e($_POST['email']);
	$password_1  =  e($_POST['password_1']);
	$password_2  =  e($_POST['password_2']);

	// FORMULARIO VALIDACION
	if (empty($username)) { 
		array_push($errors, "Username is required"); 
	}
	if (empty($email)) { 
		array_push($errors, "Email is required"); 
	}
	if (empty($password_1)) { 
		array_push($errors, "Password is required"); 
	}
	if ($password_1 != $password_2) {
		array_push($errors, "Las dos contraseñas no coinciden");
	}

	// registrar usuario si no hay errores en el formulario
	if (count($errors) == 0) {
		$password = md5($password_1);//cifrar la contraseña antes de guardarla en la base de datos

		if (isset($_POST['user_type'])) {
			$user_type = e($_POST['user_type']);
			$query = "INSERT INTO users (username, email, user_type, password) 
					  VALUES('$username', '$email', '$user_type', '$password')";
			mysqli_query($db, $query);
			$_SESSION['success']  = "Nuevo usuario creado con éxito !!";
			header('location: home.php');
		}else{
			$query = "INSERT INTO users (username, email, user_type, password) 
					  VALUES('$username', '$email', 'user', '$password')";
			mysqli_query($db, $query);

			// obtener id del usuario creado
			$logged_in_user_id = mysqli_insert_id($db);

			$_SESSION['user'] = getUserById($logged_in_user_id); // put logged in user in session
			$_SESSION['success']  = "Ahora está conectado";
			header('location: index.php');				
		}
	}
}


// return la matriz de usuario de su id
function getUserById($id){
	global $db;
	$query = "SELECT * FROM users WHERE id=" . $id;
	$result = mysqli_query($db, $query);

	$user = mysqli_fetch_assoc($result);
	return $user;
}


function e($val){
	global $db;
	return mysqli_real_escape_string($db, trim($val));
}

function display_error() {
	global $errors;

	if (count($errors) > 0){
		echo '<div class="error">';
			foreach ($errors as $error){
				echo $error .'<br>';
			}
		echo '</div>';
	}
}	

function isLoggedIn()
{
	if (isset($_SESSION['user'])) {
		return true;
	}else{
		return false;
	}
}

// cerrar la sesión del usuario si se hace clic en el botón de cierre de sesión
if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['user']);
	header("location: login.php");
}

// llamar a la función login () si se hace clic en register_btn
if (isset($_POST['login_btn'])) {
	login();
}

// INICIAR SESIÓN DE USUARIO
function login(){
	global $db, $username, $errors;


	$username = e($_POST['username']);
	$password = e($_POST['password']);

	if (empty($username)) {
		array_push($errors, "Se requiere nombre de usuario");
	}
	if (empty($password)) {
		array_push($errors, "Se requiere nombre de usuario");
	}


	if (count($errors) == 0) {
		$password = md5($password);

		$query = "SELECT * FROM users WHERE username='$username' AND password='$password' LIMIT 1";
		$results = mysqli_query($db, $query);

		if (mysqli_num_rows($results) == 1) { // usuario encontrado
            // comprobar si el usuario es administrador o usuario
			$logged_in_user = mysqli_fetch_assoc($results);
			if ($logged_in_user['user_type'] == 'admin') {

				$_SESSION['user'] = $logged_in_user;
				$_SESSION['success']  = "Ahora está conectado";
				header('location: admin/home.php');		  
			}else{
				$_SESSION['user'] = $logged_in_user;
				$_SESSION['success']  = "Ahora está conectado";

				header('location: ../Materias/Video_sistemas.html');
			}
		}else {
			array_push($errors, "Combinación incorrecta de nombre de usuario / contraseña");
		}
	}
}

function isAdmin()
{
	if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == 'admin' ) {
		return true;
	}else{
		return false;
	}
}