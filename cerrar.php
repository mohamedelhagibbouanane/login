<?php
session_start();

// Limpia todas las variables de sesión
$_SESSION = [];
session_unset();

// Destruye la sesión en el servidor
session_destroy();

// Borra la cookie de sesión del navegador
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Evita que la página protegida se cargue desde cache si el usuario pulsa atrás
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Redirige al login
header("Location: index.php");
exit;