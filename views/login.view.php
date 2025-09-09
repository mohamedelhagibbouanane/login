<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Definición de la codificación de caracteres, importante para mostrar caracteres especiales correctamente -->
    <meta charset="UTF-8">

    <!-- Definición de la vista para dispositivos móviles, con la opción de adaptarse al ancho del dispositivo -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Título de la página que aparecerá en la pestaña del navegador -->
    <title>Contenido</title>

    <!-- Carga de la hoja de estilos de Font Awesome para poder usar íconos -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

    <!-- Carga de la fuente "Raleway" desde Google Fonts para el diseño tipográfico -->
    <link href='https://fonts.googleapis.com/css?family=Raleway:400,300' rel='stylesheet' type='text/css'>

    <!-- Carga del archivo de estilos CSS local para la personalización del diseño -->
    <link rel="stylesheet" href="css/estilos.css">
</head>

<body>
    <!-- Contenedor principal que engloba todo el contenido visible de la página -->
    <div class="contenedor">
        <!-- Título principal de la página, con la clase 'titulo' para el estilo -->
        <h1 class="titulo">Login</h1>

        <!-- Línea horizontal que se utiliza como separación, estilizada con la clase 'border' -->
        <hr class="border">

        <!-- Formulario que se enviará mediante el método POST a la misma página (self-submitting) -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="formulario" name="login">

            <!-- Primer campo del formulario para ingresar el nombre de usuario -->
            <div class="form-group">
                <!-- Ícono de usuario (Font Awesome) que se coloca a la izquierda del campo de texto -->
                <i class="icono izquierda fa fa-user"></i><input class="usuario" type="text" name="usuario" placeholder="Usuario">
                <!-- Campo de entrada de texto para el nombre de usuario -->

            </div>

            <!-- Segundo campo del formulario para ingresar la contraseña -->
            <div class="form-group">
                <!-- Ícono de candado (Font Awesome) colocado a la izquierda del campo de la contraseña -->
                <!-- Campo de entrada de texto para la contraseña, que oculta el contenido -->
                <!-- Ícono de un botón de flecha (Font Awesome) para enviar el formulario -->
                <i class="icono izquierda fa fa-lock"></i><input class="password_btn" type="password" name="password" placeholder="Contraseña"> <i class="submit-btn fa fa-arrow-right" onclick="login.submit()"></i>
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

        <!-- Mensaje debajo del formulario que invita a los usuarios a registrarse si no tienen cuenta -->
        <p class="texto-registrate">
            ¿No tienes cuenta?
            <!-- Enlace a la página de registro donde los usuarios pueden crear una cuenta -->
            <a href="registrate.php">Registrate</a>
        </p>
    </div>
</body>

</html>