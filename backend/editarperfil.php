<?php
    include_once 'api/editarperfilapi.php';
    include_once '../config/base_de_datos.php';

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    $database = new Base_de_datos();
    $db = $database->getConnection();

    $editarPerfil = new EditarPerfilAPI($db);
    $data = json_decode(file_get_contents("php://input"));
    echo $data->direccion;
    echo $data->usuario;
    if (!empty($data->usuario) && !empty($data->direccion)) {
    $editarPerfil->usuario = $data->usuario;
    $editarPerfil->direccion = $data->direccion;


    if($editarPerfil->updateName() && $editarPerfil->updateAddress()) {
    http_response_code(200);
    echo json_encode(array("message" => "Perfil actualizado con éxito."));
    } else {
    http_response_code(503);
    echo json_encode(array("message" => "No se pudo actualizar el perfil."));
    }
    } else {
    http_response_code(400);
    echo json_encode(array("message" => "Datos incompletos."));
    }

