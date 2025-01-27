<?php include('../functions.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Sistema de registro PHP y MySQL - Crear usuario</title>
	<link rel="stylesheet" type="text/css" href="../style.css">
	<style>
		.header {
			background:rgb(7, 8, 8);
		}
		button[name=register_btn] {
			background: #003366;
		}
	</style>
</head>
<body>
	<div class="header">
		<h2>Admin - crear usuarios</h2>
	</div>
	
	<form method="post" action="create_user.php">

		<?php echo display_error(); ?>

		<div class="input-group">
			<label>Usuarios</label>
			<input type="text" name="username" value="<?php echo $username; ?>">
		</div>
		<div class="input-group">
			<label>Correo</label>
			<input type="email" name="email" value="<?php echo $email; ?>">
		</div>
		<div class="input-group">
			<label>Tipo de Usuario</label>
			<select name="user_type" id="user_type" >
				<option value=""></option>
				<option value="admin">Admin</option>
				<option value="user">Estudiante</option>
				<option value="user">Docente</option>
			</select>
		</div>
		<div class="input-group">
			<label>Contraseña</label>
			<input type="password" name="password_1">
		</div>
		<div class="input-group">
			<label>Confimar contraseña</label>
			<input type="password" name="password_2">
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="register_btn"> + Crear Usuario</button>
		</div>
	</form>
</body>
</html>