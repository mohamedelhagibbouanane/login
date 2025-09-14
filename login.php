<?php
// -------------------------------------------------------
// SCRIPT DE LOGIN DE USUARIOS
// -------------------------------------------------------

// Inicia la sesión en PHP
// Esto es necesario para poder usar $_SESSION y almacenar datos del usuario logueado
session_start();

// Incluimos funciones auxiliares
// Aquí estarán definidas funciones como cleanInputs(), connectToDataBase() y excuteQuery()
require("../library/reusedFunctions.php");

// -------------------------------------------------------
// Inicializamos variable para errores
// -------------------------------------------------------
$error = "";

// -------------------------------------------------------
// 1. Comprobamos si se envió el formulario (POST)
// -------------------------------------------------------
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // ---------------------------------------------------
    // 1.1. Capturamos y limpiamos los datos del formulario
    // ---------------------------------------------------
    // cleanInputs() limpia la entrada de caracteres peligrosos y espacios
    // En el caso del usuario, también lo pasa a minúsculas y escapa caracteres HTML
    $usuario  = cleanInputs($_POST["usuario"], 'usuario');
    $password = cleanInputs($_POST["password"], '');

    // ---------------------------------------------------
    // 1.2. Conectamos a la base de datos
    // ---------------------------------------------------


    // ---------------------------------------------------
    // 1.3. Preparamos consulta SQL para buscar al usuario
    // ---------------------------------------------------
    // SELECT * WHERE usuario = :usuario LIMIT 1
    $sqlQuery = "SELECT * FROM usuarios WHERE usuario = :usuario LIMIT 1";
    $dsn = "mysql:host=localhost;dbname=login;charset=utf8mb4";
    $dbUser = "root";
    $dbPassword  = "";


    // Ejecutamos la consulta usando nuestra función universal excuteQuery()
    // false → significa que queremos solo una fila
    // $connection → usamos la conexión que ya creamos
    $result = executeQuery($dsn,$dbUser,$dbPassword,$sqlQuery, [':usuario' => $usuario], false);

    // ---------------------------------------------------
    // 1.4. Verificamos si el usuario existe
    // ---------------------------------------------------
    if (!$result) {
        //Usuario no encontrado
        $error .= '<li>Error registrate primero</li>';

        // Redirigimos al registro porque no existe el usuario
        //header('location: registrate.php');
        //exit; // Siempre salir después de header()
    } else {
        // ---------------------------------------------------
        // 1.5. Usuario encontrado → verificamos contraseña
        // ---------------------------------------------------
        if (password_verify($password, $result['pass'])) {
            //Contraseña correcta
            // Guardamos el usuario en sesión para saber que está logueado
            $_SESSION['usuario'] = $usuario;

            // Redirigimos a la página principal
            header('Location: index.php');
            exit; // Salimos del script después de redirigir
        } else {
            // Contraseña incorrecta
            $error .= '<li>Error</li>';
        }
    }
}

// -------------------------------------------------------
// 2. Cargamos la vista del login
// -------------------------------------------------------
// Contendrá el formulario donde el usuario ingresa su usuario y contraseña
// También mostrará errores si los hay
require("views/login.view.php");
