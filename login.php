<?php session_start();
 // Pon aquí el hash de tu DB


$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = strip_tags(strtolower(trim($_POST["usuario"])));
    $password = trim($_POST["password"]);



    try {
        $connection = new PDO('mysql:host=localhost;dbname=login', username: 'root', password: '');
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {

        echo "Error" . $e->getMessage();
    }
    $statement = $connection->prepare("SELECT * FROM usuarios WHERE usuario = :usuario LIMIT 1");
    $statement->execute([':usuario' => $usuario]);
    $result = $statement->fetch(PDO::FETCH_ASSOC);

    if (!$result) {
        // Usuario no encontrado
        $error .= '<li>Error</li>';
        header('location: registrate.php');
    } else {
        // Usuario encontrado, verificamos contraseña
        if (password_verify($password, $result['pass'])) {
            // Contraseña correcta
            $_SESSION['usuario'] = $usuario;
            header('Location: index.php');
            exit;
        } else {
            // Contraseña incorrecta
            $error .= '<li>Error</li>';
        }
    }
}

require("views/login.view.php");