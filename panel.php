<?php
session_start();
include "conexion.php";

if (!isset($_SESSION["id"]) || $_SESSION["rol"] !== "admin") {
    header("Location: index.php");
    exit;
}

$productos = $conexion->query("SELECT * FROM productos ORDER BY id");
$usuarios  = $conexion->query("SELECT id, nombre, celular, correo, rol, fecha_registro FROM usuarios ORDER BY id");
$ventas    = $conexion->query(
    "SELECT v.id, v.monto, v.id_paypal, v.fecha,
            u.nombre AS cliente, u.correo, p.nombre AS producto
     FROM ventas v
     JOIN usuarios u ON u.id = v.id_usuario
     JOIN productos p ON p.id = v.id_producto
     ORDER BY v.fecha DESC"
);
$totales = $conexion->query("SELECT COUNT(*) AS num, COALESCE(SUM(monto), 0) AS total FROM ventas")->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de administrador | Club Santos Laguna</title>
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
            <a href="panel.php">Panel</a>
            <a href="logout.php">Salir (<?php echo htmlspecialchars($_SESSION["nombre"]); ?>)</a>
        </nav>
    </header>

    <section class="panel">
        <div class="section-title">
            <h2>Panel de administrador</h2>
            <p>Resumen general de la tienda.</p>
        </div>

        <div class="resumen">
            <div class="resumen-box">
                <h3><?php echo $totales["num"]; ?></h3>
                <p>Ventas realizadas</p>
            </div>
            <div class="resumen-box">
                <h3>$<?php echo number_format($totales["total"], 2); ?></h3>
                <p>Ingresos totales (MXN)</p>
            </div>
            <div class="resumen-box">
                <h3><?php echo $productos->num_rows; ?></h3>
                <p>Productos</p>
            </div>
            <div class="resumen-box">
                <h3><?php echo $usuarios->num_rows; ?></h3>
                <p>Usuarios registrados</p>
            </div>
        </div>

        <h3 class="tabla-titulo">Productos</h3>
        <div class="tabla-scroll">
            <table>
                <tr>
                    <th>ID</th><th>Nombre</th><th>Descripción</th><th>Precio</th><th>Stock</th><th>Vendidos</th><th>Imagen</th>
                </tr>
                <?php while ($p = $productos->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $p["id"]; ?></td>
                    <td><?php echo htmlspecialchars($p["nombre"]); ?></td>
                    <td><?php echo htmlspecialchars($p["descripcion"] ?? ""); ?></td>
                    <td>$<?php echo number_format($p["precio"], 2); ?></td>
                    <td><?php echo $p["stock"]; ?></td>
                    <td><?php echo $p["ventas"]; ?></td>
                    <td><img src="<?php echo htmlspecialchars($p["imagen"] ?? ""); ?>" alt="" class="mini"></td>
                </tr>
                <?php } ?>
            </table>
        </div>

        <h3 class="tabla-titulo">Ventas</h3>
        <div class="tabla-scroll">
            <table>
                <tr>
                    <th>Folio</th><th>Fecha</th><th>Cliente</th><th>Correo</th><th>Abono</th><th>Monto</th><th>Folio PayPal</th><th>Recibo</th>
                </tr>
                <?php while ($v = $ventas->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $v["id"]; ?></td>
                    <td><?php echo $v["fecha"]; ?></td>
                    <td><?php echo htmlspecialchars($v["cliente"]); ?></td>
                    <td><?php echo htmlspecialchars($v["correo"]); ?></td>
                    <td><?php echo htmlspecialchars($v["producto"]); ?></td>
                    <td>$<?php echo number_format($v["monto"], 2); ?></td>
                    <td><?php echo htmlspecialchars($v["id_paypal"] ?? ""); ?></td>
                    <td><a href="recibo.php?venta=<?php echo $v["id"]; ?>" target="_blank">Ver PDF</a></td>
                </tr>
                <?php } ?>
            </table>
        </div>

        <h3 class="tabla-titulo">Usuarios</h3>
        <div class="tabla-scroll">
            <table>
                <tr>
                    <th>ID</th><th>Nombre</th><th>Celular</th><th>Correo</th><th>Rol</th><th>Registro</th>
                </tr>
                <?php while ($u = $usuarios->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $u["id"]; ?></td>
                    <td><?php echo htmlspecialchars($u["nombre"]); ?></td>
                    <td><?php echo htmlspecialchars($u["celular"]); ?></td>
                    <td><?php echo htmlspecialchars($u["correo"]); ?></td>
                    <td><?php echo $u["rol"]; ?></td>
                    <td><?php echo $u["fecha_registro"]; ?></td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </section>

    <footer>
        <h3>Club Santos Laguna</h3>
        <p>Panel de administración</p>
    </footer>
</body>
</html>