<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de registro</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Raleway:400,300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/estilos.css">
</head>

<body>
    <div class="contenedor">
        <h1 class="titulo">Registrate</h1>
        <hr class="border">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="formulario" name="login">
           	<div class="form-group">
				<i class="icono izquierda fa fa-user"></i><input class="usuario" type="text" name="usuario" placeholder="Usuario">
			</div>

			<div class="form-group">
				<i class="icono izquierda fa fa-lock"></i><input class="password" type="password" name="password" placeholder="Contraseña">
			</div>

			<div class="form-group">
				<i class="icono izquierda fa fa-lock"></i><input class="password_btn" type="password" name="password2" placeholder="Repite la contraseña">
				<i class="submit-btn fa fa-arrow-right" onclick="login.submit()"></i>
			</div>
            <?php if(!empty($error)):?>
                <div class="error">
                    <ul>
                        <?php echo $error;?>
                    </ul>
                </div>
             <?php endif?>
              <?php if(!empty($message)):?>
                <div class="message">
                    <ul>
                        <?php echo $message;?>
                    </ul>
                </div>
             <?php endif?>
        </form>
        <p class="texto-registrate">
            ¿Ya tienes cuenta?
            <a href="login.php">Iniciar Sesion</a>
        </p>
    </div>
</body>

</html>