<!DOCTYPE html>
<?php include('functions.php') ?>


<form method="post" action="register.php">
	<?php echo display_error(); ?>

</form>

<html>
<head>
	<title>Sistema de registro PHP y MySQL</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="header">
	<h2>Registro</h2>
</div>
<form method="post" action="register.php">
	<div class="input-group">
		<label>Usuario</label>
		<input type="text" name="username" value="<?php echo $username; ?>">
	</div>
	<div class="input-group">
		<label>Correo</label>
		<input type="email" name="email" value="<?php echo $email; ?>">
	</div>
	<div class="input-group">
		<label>Contraseña</label>
		<input type="password" name="password_1">
	</div>
	<div class="input-group">
		<label>Confirma Contraseña</label>
		<input type="password" name="password_2">
	</div>
	<div class="input-group">
		<button type="submit" class="btn" name="register_btn">Registro</button>
	</div>
	<p>
    Ya eres usuario? <a href="login.php">Entra</a>
	</p>
</form>
</body>
</html>