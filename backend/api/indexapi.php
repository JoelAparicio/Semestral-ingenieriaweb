<?php
header('Content-Type: application/json');

require_once '../../config/base_de_datos.php';

$baseDeDatos = new base_de_datos();
$db = $baseDeDatos->getConnection();

$query = "SELECT * FROM productos";
$stmt = $db->prepare($query);

if ($stmt->execute()) {
    $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(['success' => true, 'data' => $productos]);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al recuperar datos de la base de datos']);
}

$baseDeDatos->closeConnection();
?>
