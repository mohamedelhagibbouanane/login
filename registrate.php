<?php
// -------------------------------------------------------
// INICIO DEL SCRIPT DE REGISTRO DE USUARIOS
// -------------------------------------------------------

// 🔹 Inicia la sesión en PHP
// Esto es obligatorio si queremos usar variables de sesión ($_SESSION)
// para guardar información entre diferentes páginas.
session_start();

// Importamos funciones auxiliares
// Aquí estarán definidas cosas como connectToDataBase(), excuteQuery(), cleanInputs(), getUserIP(), etc.
require("../library/reusedFunctions.php");

// -------------------------------------------------------
// 1. Verificar si el usuario YA está logueado
// -------------------------------------------------------
// Si existe la variable de sesión "usuario", significa que el usuario
// ya ha iniciado sesión y no tiene sentido que vuelva a registrarse.
// En ese caso, lo redirigimos a la página principal (index.php).
if (isset($_SESSION["usuario"])) {
    header("location:index.php");
}

// -------------------------------------------------------
// 2. Comprobamos si se envió el formulario de registro (POST)
// -------------------------------------------------------
if ($_SERVER["REQUEST_METHOD"] == 'POST') {

    // ---------------------------------------------------
    // 2.1. Capturamos y limpiamos los datos del formulario
    // ---------------------------------------------------
    // cleanInputs() es una función personalizada (definida en functions.php)
    // que elimina caracteres peligrosos y espacios innecesarios.
    // En el caso del usuario, lo pasamos a minúsculas y quitamos etiquetas HTML.
    $usuario = cleanInputs($_POST['usuario'], 'usuario');

    // Capturamos las contraseñas y también las limpiamos.
    $password  = cleanInputs($_POST['password'], '');
    $password2 = cleanInputs($_POST['password2'], '');

    // ---------------------------------------------------
    // 2.2. Obtenemos la IP del usuario
    // ---------------------------------------------------
    // getUserIP() es otra función auxiliar que devuelve la IP del cliente.
    $ip = getUserIP();

    // Inicializamos variables para almacenar errores o mensajes de éxito
    $error   = '';
    $message = '';

    // ---------------------------------------------------
    // 2.3. Validación de campos vacíos
    // ---------------------------------------------------
    // Antes de hacer nada con la BD, verificamos que los campos no estén vacíos.
    if (empty($usuario) or empty($password) or empty($password2)) {
        $error .= '<li>Por favor complete los datos correctamente</li>';
    } else {

        // ---------------------------------------------------
        // 2.5. Comprobar si el usuario ya existe
        // ---------------------------------------------------
        // Preparamos una consulta SQL que busca un registro con el mismo nombre de usuario.
        $sqlQuery = "SELECT * FROM usuarios WHERE usuario = :usuario LIMIT 1";
        $dsn = "mysql:host=localhost;dbname=login;charset=utf8mb4";
        $dbUser = "root";
        $dbPassword  = "";

        // Llamamos a nuestra función universal excuteQuery(), que devuelve un resultado o false.
        $result = executeQuery($dsn, $dbUser, $dbPassword, $sqlQuery, [':usuario' => $usuario], false);
     
        // Si $result contiene datos, significa que el usuario YA está registrado.
        if ($result) {

            $error .= '<li>El usuario ya está registrado</li>';
        } else {

            // ---------------------------------------------------
            // 2.6. Si no existe, comprobamos contraseñas
            // ---------------------------------------------------
            if (($password === $password2)) {

                // Si las contraseñas coinciden → las encriptamos antes de guardarlas.
                // password_hash() usa el algoritmo BCRYPT por defecto,
                // que es seguro para almacenar contraseñas.
                $password = password_hash($password, PASSWORD_DEFAULT);

                // ---------------------------------------------------
                // 2.7. Insertar el nuevo usuario
                // ---------------------------------------------------
                $sqlQuery = "INSERT INTO usuarios (usuario, pass, ip) VALUES (:usuario, :pass, :ip)";

                executeQuery($dsn, $dbUser, $dbPassword, $sqlQuery, [
                    ':usuario' => $usuario,
                    ':pass'    => $password,
                    ':ip'      => $ip
                ], false);

                // Después de registrar al usuario, lo mandamos a la página de login.
                header('location:login.php');
                exit; // Siempre salir después de un header para evitar ejecución extra
            } else{
                // Si las contraseñas no coinciden, guardamos un error.
                $error .= '<li>Las contraseñas no coinciden</li>';
            } 
        }
    }
}

// -------------------------------------------------------
// 3. Cargar la vista del formulario de registro
// -------------------------------------------------------
// Finalmente, se incluye el archivo que contiene el formulario HTML
// (registrate.view.php). Aquí se mostrarán los errores o mensajes.
require("views/registrate.view.php");
