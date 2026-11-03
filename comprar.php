<?php
session_start();
include "conexion.php";

if (!isset($_SESSION["id"])) {
    header("Location: login.php");
    exit;
}

$id = intval($_GET["id"] ?? 0);
$stmt = $conexion->prepare("SELECT * FROM productos WHERE id = ? AND stock > 0");
$stmt->bind_param("i", $id);
$stmt->execute();
$p = $stmt->get_result()->fetch_assoc();

if (!$p) {
    header("Location: catalogo.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comprar | Club Santos Laguna</title>
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
            <a href="logout.php">Salir (<?php echo htmlspecialchars($_SESSION["nombre"]); ?>)</a>
        </nav>
    </header>

    <section class="catalogo">
        <div class="form-container">
            <h3>Confirmar compra</h3>
            <p class="subtitle"><?php echo htmlspecialchars($p["nombre"]); ?> - $<?php echo number_format($p["precio"], 2); ?> MXN</p>

            <div id="paypal-button-container"></div>
            <p id="mensaje"></p>
        </div>
    </section>

    <footer>
        <h3>Club Santos Laguna</h3>
        <p>¡Gracias por ser Guerrero!</p>
    </footer>

    <script src="https://www.paypal.com/sdk/js?client-id=ATfLoZRHj8XauXpBk5AkzeRxvGEt6ETnbr5utzs_8Qvqy58ZN10KdIAYw97yuVqr1PFQ2Z4Jq9A8fEX0&currency=MXN"></script>
    <script>
        paypal.Buttons({
            createOrder: function (data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        description: "<?php echo htmlspecialchars($p["nombre"]); ?>",
                        amount: { value: "<?php echo number_format($p["precio"], 2, ".", ""); ?>" }
                    }]
                });
            },
            onApprove: function (data, actions) {
                return actions.order.capture().then(function (detalles) {
                    console.log("PayPal aprobó:", detalles.id);
                    return fetch("confirmarPago.php", {
                        method: "POST",
                        headers: { "Content-Type": "application/x-www-form-urlencoded" },
                        body: "id_producto=<?php echo $p["id"]; ?>&id_paypal=" + detalles.id
                    })
                    .then(function (r) { return r.text(); })
                    .then(function (texto) {
                        console.log("Respuesta del servidor:", texto);
                        var res = JSON.parse(texto);
                        if (res.ok) {
                            window.location = "recibo.php?venta=" + res.id_venta;
                        } else {
                            document.getElementById("mensaje").textContent = res.error;
                        }
                    });
                }).catch(function (err) {
                    console.error(err);
                    document.getElementById("mensaje").textContent = "Error: " + err.message;
                });
            },
            onError: function (err) {
                console.error(err);
                document.getElementById("mensaje").textContent = "Error de PayPal: " + err;
            }
        }).render("#paypal-button-container");
    </script>
</body>
</html>