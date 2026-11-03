<?php
session_start();
include "conexion.php";

if (!isset($_SESSION["id"])) {
    header("Location: login.php");
    exit;
}

$resultado = $conexion->query("SELECT * FROM productos");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abonos | Club Santos Laguna</title>
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
            <a href="catalogo.php">Abonos</a>
            <?php if ($_SESSION["rol"] === "admin") { ?>
                <a href="panel.php">Panel</a>
            <?php } ?>
            <a href="logout.php">Salir (<?php echo htmlspecialchars($_SESSION["nombre"]); ?>)</a>
        </nav>
    </header>

    <section class="catalogo">
        <div class="section-title">
            <h2>Elige tu abono</h2>
            <p>Compra con PayPal y recibe tu recibo en PDF.</p>
        </div>

        <div class="cards">
            <?php while ($p = $resultado->fetch_assoc()) { ?>
                <div class="card">
                    <div class="card-top">
                        <img src="<?php echo htmlspecialchars($p["imagen"]); ?>" alt="<?php echo htmlspecialchars($p["nombre"]); ?>">
                    </div>
                    <div class="card-content">
                        <h3><?php echo htmlspecialchars($p["nombre"]); ?></h3>
                        <p><?php echo htmlspecialchars($p["descripcion"]); ?></p>
                        <p class="precio">$<?php echo number_format($p["precio"], 2); ?> MXN</p>
                        <p class="stock">Disponibles: <?php echo $p["stock"]; ?></p>
                        <?php if ($p["stock"] > 0) { ?>
                            <a class="btn-comprar" href="comprar.php?id=<?php echo $p["id"]; ?>">Comprar</a>
                        <?php } else { ?>
                            <span class="agotado">Agotado</span>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>

    <footer>
        <h3>Club Santos Laguna</h3>
        <p>¡Gracias por tu compra!</p>
    </footer>
</body>
</html>