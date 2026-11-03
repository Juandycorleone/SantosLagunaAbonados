<?php
session_start();
include "conexion.php";
header("Content-Type: application/json");

if (!isset($_SESSION["id"]) || $_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode(["ok" => false, "error" => "Sesión no válida"]);
    exit;
}

$id_usuario  = $_SESSION["id"];
$id_producto = intval($_POST["id_producto"]);
$id_paypal   = trim($_POST["id_paypal"]);

$conexion->begin_transaction();

$stmt = $conexion->prepare("UPDATE productos SET stock = stock - 1, ventas = ventas + 1 WHERE id = ? AND stock > 0");
$stmt->bind_param("i", $id_producto);
$stmt->execute();

if ($stmt->affected_rows !== 1) {
    $conexion->rollback();
    echo json_encode(["ok" => false, "error" => "Producto agotado"]);
    exit;
}

$stmt = $conexion->prepare("SELECT precio FROM productos WHERE id = ?");
$stmt->bind_param("i", $id_producto);
$stmt->execute();
$precio = $stmt->get_result()->fetch_assoc()["precio"];

$stmt = $conexion->prepare("INSERT INTO ventas (id_usuario, id_producto, monto, id_paypal) VALUES (?, ?, ?, ?)");
$stmt->bind_param("iids", $id_usuario, $id_producto, $precio, $id_paypal);
$stmt->execute();
$id_venta = $conexion->insert_id;

$conexion->commit();
echo json_encode(["ok" => true, "id_venta" => $id_venta]);
?>