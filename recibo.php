<?php
session_start();
include "conexion.php";
require "fpdf/fpdf.php";

if (!isset($_SESSION["id"])) {
    header("Location: login.php");
    exit;
}

$id_venta = intval($_GET["venta"] ?? 0);

$sql = "SELECT v.id, v.monto, v.id_paypal, v.fecha,
               u.nombre AS cliente, u.correo,
               p.nombre AS producto
        FROM ventas v
        JOIN usuarios u ON u.id = v.id_usuario
        JOIN productos p ON p.id = v.id_producto
        WHERE v.id = ? AND (v.id_usuario = ? OR ? = 'admin')";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("iis", $id_venta, $_SESSION["id"], $_SESSION["rol"]);
$stmt->execute();
$venta = $stmt->get_result()->fetch_assoc();

if (!$venta) {
    header("Location: catalogo.php");
    exit;
}

function t($texto) {
    return iconv("UTF-8", "windows-1252//TRANSLIT", $texto);
}

function fila($pdf, $etiqueta, $valor) {
    $pdf->SetFont("Arial", "B", 12);
    $pdf->Cell(55, 10, t($etiqueta), 0, 0);
    $pdf->SetFont("Arial", "", 12);
    $pdf->Cell(0, 10, t($valor), 0, 1);
}

$pdf = new FPDF();
$pdf->AddPage();

$pdf->SetFillColor(0, 107, 69);
$pdf->Rect(0, 0, 210, 40, "F");
$pdf->Image("imagenes/slogo2.jpg", 15, 8, 24);
$pdf->SetTextColor(255, 255, 255);
$pdf->SetFont("Arial", "B", 20);
$pdf->SetXY(45, 14);
$pdf->Cell(0, 10, t("Club Santos Laguna"));
$pdf->SetFont("Arial", "", 12);
$pdf->SetXY(45, 24);
$pdf->Cell(0, 8, t("Recibo de pago de abono"));

$pdf->SetTextColor(0, 0, 0);
$pdf->SetY(55);
fila($pdf, "Folio:", str_pad($venta["id"], 6, "0", STR_PAD_LEFT));
fila($pdf, "Fecha:", $venta["fecha"]);
fila($pdf, "Cliente:", $venta["cliente"]);
fila($pdf, "Correo:", $venta["correo"]);
fila($pdf, "Abono:", $venta["producto"]);
fila($pdf, "Folio de PayPal:", $venta["id_paypal"]);

$pdf->Ln(8);
$pdf->SetFillColor(238, 243, 239);
$pdf->SetFont("Arial", "B", 16);
$pdf->SetTextColor(0, 107, 69);
$pdf->Cell(0, 16, t("Total pagado: $" . number_format($venta["monto"], 2) . " MXN"), 0, 1, "C", true);

$pdf->Ln(15);
$pdf->SetTextColor(90, 90, 90);
$pdf->SetFont("Arial", "I", 11);
$pdf->Cell(0, 8, t("¡Gracias por ser Guerrero!"), 0, 1, "C");

$pdf->Output("I", "recibo_" . $venta["id"] . ".pdf");
?>