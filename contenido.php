<?php
session_start();
//chaleco antibalas de contenido para no poder darle boton atras
// Evita que la página se muestre desde la caché del navegador
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Si no hay sesión activa, redirige al login
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit;
}
require("views/contenido.view.php");
?>
