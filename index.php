<?php

session_start();
//si el usuario esta registrado entra en contenido si no que se registre primero
if (isset($_SESSION['usuario'])) {
    header("location:contenido.php");
} else {

    header("location:registrate.php");
}
