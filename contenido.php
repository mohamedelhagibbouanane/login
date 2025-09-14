<?php
// -------------------------------------------------------
// PROTECCIÓN DE PÁGINA: CONTENIDO PARA USUARIOS LOGUEADOS
// -------------------------------------------------------

// Iniciamos la sesión en PHP
// Esto es obligatorio si queremos usar $_SESSION para verificar si el usuario está logueado
session_start();
require("../library/reusedFunctions.php");
// -------------------------------------------------------
// 🔹 Evitar que el usuario vea la página usando el botón "Atrás"
// -------------------------------------------------------
// Esto fuerza al navegador a no cachear esta página
// Así, aunque pulse "Atrás", el contenido no se mostrará desde la caché
noBackProtection();

// -------------------------------------------------------
// 🔹 Verificar si hay sesión activa
// -------------------------------------------------------
// Si no existe la variable de sesión "usuario", significa que
// el usuario no ha iniciado sesión, entonces lo redirigimos al login
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
} // Siempre salir después de header() para evitar que se siga ejecutando código


// -------------------------------------------------------
// Cargar la vista del contenido protegido
// -------------------------------------------------------
// Solo llegará aquí si el usuario está logueado
require("views/contenido.view.php");
