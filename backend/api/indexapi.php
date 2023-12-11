<?php
header('Content-Type: application/json');

// Incluir el archivo de conexión a la base de datos
require_once '../../config/base_de_datos.php';

// Crear una nueva instancia de la clase base_de_datos y obtener la conexión
$baseDeDatos = new base_de_datos();
$db = $baseDeDatos->getConnection();

// Preparar la consulta para obtener todos los productos
$query = "SELECT * FROM productos";
$stmt = $db->prepare($query);

if ($stmt->execute()) {
    // Obtener los resultados como un arreglo asociativo
    $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Enviar respuesta JSON con los datos de los productos
    echo json_encode(['success' => true, 'data' => $productos]);
} else {
    // Enviar respuesta en caso de error
    echo json_encode(['success' => false, 'message' => 'Error al recuperar datos de la base de datos']);
}

// Cerrar la conexión
$baseDeDatos->closeConnection();
?>
