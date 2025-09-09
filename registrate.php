<?php
// Inicia la sesión en PHP. Esto permite acceder a datos guardados en la sesión del usuario.
session_start();

// Verifica si ya existe una sesión iniciada para el usuario (es decir, si ya está logueado).
// Si está logueado, redirige al index.php, evitando que el usuario acceda a la página de registro.
if (isset($_SESSION["usuario"])) {
    header("location:index.php");
}

// Si se está enviando un formulario POST (es decir, el usuario está intentando registrarse).
if ($_SERVER["REQUEST_METHOD"] == 'POST') {

    // Limpia y normaliza el nombre de usuario:
    // strip_tags() elimina etiquetas HTML, strtolower() convierte a minúsculas y trim() elimina espacios al inicio y al final.
    $usuario = strip_tags(strtolower(trim($_POST['usuario'])));

    // Recupera las contraseñas ingresadas por el usuario
    $password = trim($_POST['password']);
    $password2 = trim($_POST['password2']);

    // Función para obtener la IP pública del usuario
    function getUserIP()
    {
        // Verifica si la IP proviene de un cliente directo.
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            return $_SERVER['HTTP_CLIENT_IP'];
        }
        // Si no es un cliente directo, revisa si está pasando por un proxy (X-Forwarded-For).
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            // Si existe un proxy, se toma la primera IP en la lista.
            return explode(',', $_SERVER['HTTP_X_FORWARDED_FOR'])[0];
        } else {
            // Si no se pudo obtener la IP de los anteriores métodos, se devuelve la IP del servidor remoto.
            return $_SERVER['REMOTE_ADDR'];
        }
    }

    // Llama a la función para obtener la IP del usuario.
    $ip = getUserIP();

    // Inicializa las variables de error y mensaje que se usarán más adelante para mostrar retroalimentación.
    $error = '';
    $message = '';

    // Verifica que el usuario haya completado todos los campos correctamente.
    if (empty($usuario) or empty($password) or empty($password2)) {
        $error .= '<li>Por favor complete los datos correctamente</li>';
    } else {
        try {
            // Intenta establecer una conexión con la base de datos utilizando PDO (PHP Data Objects).
            // Conexión con la base de datos 'login' en localhost con las credenciales de usuario y contraseña.
            $connection = new PDO('mysql:host=localhost;dbname=login', username: 'root', password: '');

            // Configura el modo de error para que se muestre una excepción en caso de fallos.
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // Si no se puede conectar a la base de datos, muestra el error.
            echo "Error" . $e->getMessage();
        }

        // Prepara una consulta para verificar si el nombre de usuario ya existe en la base de datos.
        // Utiliza un 'SELECT' que busca un registro con el mismo nombre de usuario.
        $statement = $connection->prepare("SELECT * FROM usuarios WHERE (usuario) = (:usuario) LIMIT 1");

        // Ejecuta la consulta con el nombre de usuario que se está registrando.
        $statement->execute(array(':usuario' => $usuario));

        // Obtiene el resultado de la consulta.
        $result = $statement->fetch();  // Esto devolverá un array si se encuentra un usuario, o 'false' si no.

        // Si el resultado es verdadero (es decir, el usuario ya existe), muestra un error.
        if ($result) {
            $error .= '<li>El usuario ya está registrado</li>';
        } else {

            // Si el usuario no existe, verifica que las contraseñas coincidan.
            if ($password === $password2) {
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                $statement = $connection->prepare(
                    "INSERT INTO usuarios (usuario, pass, ip) VALUES (:usuario, :pass, :ip)"
                );
                $statement->execute([
                    ':usuario' => $usuario,
                    ':pass'    => $passwordHash,
                    ':ip'      => $ip
                ]);

                
                header('location:login.php');
                exit;
            } else {
                $error .= '<li>Las contraseñas no coinciden</li>';
            }
        }
    }
}

// Se carga la vista del registro, que contiene el formulario donde el usuario puede registrarse.
require("views/registrate.view.php");
