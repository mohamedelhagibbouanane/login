<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Error 404</title>
  <meta http-equiv="refresh" content="3;url=/Curso_PHP/login/index.php">
  <style>
    /* Reset básico */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Raleway', sans-serif;
      background: #1B1D35;
      color: #fff;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      /* Ocupa toda la pantalla */
      text-align: center;
    }

    .contenedor {
      max-width: 600px;
      width: 90%;
    }

    .error4 {
      font-size: 20vw;
      /* Escala con el ancho de la pantalla */
      font-weight: bold;
      color: #B8711B;
      margin-bottom: 20px;
      line-height: 1;
    }

    .mensaje {
      font-size: 20px;
      margin-bottom: 10px;
    }

    .detalle {
      font-size: 14px;
      color: #ccc;
    }

    a {
      display: inline-block;
      margin-top: 20px;
      color: #B8711B;
      text-decoration: none;
      font-weight: bold;
    }

    a:hover {
      text-decoration: underline;
    }
  </style>
</head>

<body>
  <div class="contenedor">
    <p class="error4">404</p>
    <p class="mensaje">Not Found</p>
    <p class="detalle">The resource requested could not be found on this server.</p>
    <p class="detalle">You will be redirected to main page automaticly en a few seconds</p>
  </div>
</body>

</html>