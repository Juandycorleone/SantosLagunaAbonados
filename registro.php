<?php
session_start();
include "conexion.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.php");
    exit;
}

$nombre   = trim($_POST["nombre"]);
$celular  = trim($_POST["celular"]);
$correo   = trim($_POST["correo"]);
$password = password_hash($_POST["password"], PASSWORD_DEFAULT);
$motivo   = trim($_POST["motivo"]);

$sql = "INSERT INTO usuarios (nombre, celular, correo, password, motivo)
        VALUES (?, ?, ?, ?, ?)";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("sssss", $nombre, $celular, $correo, $password, $motivo);

if ($stmt->execute()) {
    $_SESSION["id"]     = $conexion->insert_id;
    $_SESSION["nombre"] = $nombre;
    $_SESSION["rol"]    = "cliente";
    header("Location: catalogo.php");
} else {
    echo "Error: ese correo ya está registrado.";
}
?>7