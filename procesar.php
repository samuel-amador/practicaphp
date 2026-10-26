<?php
$esPost = ($_SERVER["REQUEST_METHOD"] ?? "") === "POST";

$nombre = "";
$correo = "";
$mensaje = "";
$error = "";

if ($esPost) {
    $nombre = is_string($_POST["nombre"] ?? null)
        ? trim($_POST["nombre"])
        : "";

    $correo = is_string($_POST["correo"] ?? null)
        ? trim($_POST["correo"])
        : "";

    $mensaje = is_string($_POST["mensaje"] ?? null)
        ? trim($_POST["mensaje"])
        : "";

    if ($nombre === "" || $correo === "" || $mensaje === "") {
        $error = "Debes completar todos los campos.";
    } elseif (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $error = "El correo electronico no es valido.";
    }
}

function escapar($texto) {
    return htmlspecialchars($texto, ENT_QUOTES, "UTF-8");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado del formulario</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 25px 15px;
            font-family: Arial, sans-serif;
            background: #eaf6ff;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .cartel {
            width: 100%;
            max-width: 580px;
            padding: 35px;
            background: linear-gradient(135deg, #0077b6, #00b4d8);
            color: white;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.25);
        }

        h1,
        .introduccion,
        .acciones {
            text-align: center;
        }

        h1 {
            margin-top: 0;
        }

        .datos {
            margin: 25px 0;
            padding: 20px;
            background: white;
            color: #023e8a;
            border-radius: 12px;
            overflow-wrap: anywhere;
        }

        .datos p {
            line-height: 1.6;
        }

        .boton {
            display: inline-block;
            padding: 12px 25px;
            background: white;
            color: #0077b6;
            text-decoration: none;
            font-weight: bold;
            border-radius: 10px;
        }

        .boton:hover {
            background: #caf0f8;
        }
    </style>
</head>

<body>
    <main class="cartel">
        <?php if (!$esPost): ?>

            <h1>Formulario pendiente</h1>

            <p class="introduccion">
                Primero completa y envia el formulario.
            </p>

        <?php elseif ($error !== ""): ?>

            <h1>Revisa tus datos</h1>

            <p class="introduccion">
                <?php echo escapar($error); ?>
            </p>

        <?php else: ?>

            <h1>Datos recibidos</h1>

            <p class="introduccion">
                El sistema recibio la siguiente informacion:
            </p>

            <section class="datos">
                <h2>Datos del formulario</h2>

                <p>
                    <strong>Nombre:</strong><br>
                    <?php echo escapar($nombre); ?>
                </p>

                <p>
                    <strong>Correo electronico:</strong><br>
                    <?php echo escapar($correo); ?>
                </p>

                <p>
                    <strong>Mensaje:</strong><br>
                    <?php echo nl2br(escapar($mensaje)); ?>
                </p>
            </section>

        <?php endif; ?>

        <div class="acciones">
            <a href="index.html" class="boton">
                VOLVER AL FORMULARIO
            </a>
        </div>
    </main>
</body>
</html>