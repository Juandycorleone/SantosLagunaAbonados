<?php
session_start();
include "conexion.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $correo   = trim($_POST["correo"]);
    $password = $_POST["password"];

    $stmt = $conexion->prepare("SELECT id, nombre, password, rol FROM usuarios WHERE correo = ?");
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $usuario = $stmt->get_result()->fetch_assoc();

    if ($usuario && password_verify($password, $usuario["password"])) {
        session_regenerate_id(true);
        $_SESSION["id"]     = $usuario["id"];
        $_SESSION["nombre"] = $usuario["nombre"];
        $_SESSION["rol"]    = $usuario["rol"];

        if ($usuario["rol"] === "admin") {
            header("Location: panel.php");
        } else {
            header("Location: catalogo.php");
        }
        exit;
    }
    $error = "Correo o contraseña incorrectos.";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión | Club Santos Laguna</title>
    <link rel="stylesheet" href="estilo2.css">
    <link href="https://fonts.googleapis.com/css2?family=Manufacturing+Consent&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <div class="logo">
            <div class="logo-icon">
                <img src="imagenes/slogo2.jpg" alt="Escudo">
            </div>
            <h1>Club Santos Laguna</h1>
        </div>
        <nav>
            <a href="index.php">Inicio</a>
            <a href="index.php#registro">Registro</a>
        </nav>
    </header>

    <section class="registro">
        <div class="form-container">
            <h3>Iniciar sesión</h3>
            <p class="subtitle">Entra con tu correo y contraseña.</p>

            <?php if ($error !== "") { ?>
                <p class="error"><?php echo $error; ?></p>
            <?php } ?>

            <form action="login.php" method="POST">
                <div class="form-group">
                    <label for="correo">Correo electrónico</label>
                    <input type="email" id="correo" name="correo" placeholder="ejemplo@correo.com" required>
                </div>
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password" placeholder="Tu contraseña" required>
                </div>
                <button type="submit" class="submit-btn">Entrar</button>
            </form>

            <p class="subtitle enlace-registro">¿No tienes cuenta? <a href="index.php#registro">Regístrate aquí</a></p>
        </div>
    </section>

    <footer>
        <h3>Club Santos Laguna</h3>
        <p>¡Gracias por ser Guerrero!</p>
    </footer>
</body>
</html>