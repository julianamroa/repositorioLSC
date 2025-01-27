<?php 
include('../functions.php');

if (!isAdmin()) {
	$_SESSION['msg'] = "You must log in first";
	header('location: ../login.php');
}

if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['user']);
	header("location: ../login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Bienvenido</title>
	<link rel="stylesheet" type="text/css" href="../style.css">
	<style>
	.header {
		background:rgb(7, 7, 7);
	}
	button[name=register_btn] {
		background: #003366;
	}
	</style>
</head>
<body>
	<div class="header">
		<h2>Admin - Bienvenido</h2>
	</div>
	<div class="content">
		<!-- mensaje de notificación -->
		<?php if (isset($_SESSION['success'])) : ?>
			<div class="error success" >
				<h3>
					<?php 
						echo $_SESSION['success']; 
						unset($_SESSION['success']);
					?>
				</h3>
			</div>
		<?php endif ?>

		<!-- información del usuario registrado -->
		<div class="profile_info">
			<img src="../images/foto.jpg"  >

			<div>
				<?php  if (isset($_SESSION['user'])) : ?>
					<strong><?php echo $_SESSION['user']['username']; ?></strong>

					<small>
						<i  style="color: #888;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i> 
						<br>
						<a href="home.php?logout='1'" style="color: red;">cerrar sesión</a>
                       &nbsp;<a href="create_user.php"> + agregar usuario</a>
                       &nbsp;<a href="../../jvh-crud/alumno.php">ver lista</a>
					   &nbsp;<a href="../../Materias/Video_sistemas.html">Mi pagina</a>
					</small>

				<?php endif ?>
			</div>
		</div>
	</div>
</body>
</html>