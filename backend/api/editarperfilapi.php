<?php

include __DIR__ . '/../../config/base_de_datos.php';
class editarperfilapi
{
    private $conn;
    private $usersTable = "usuarios"; // Asegúrate de que este sea el nombre correcto de tu tabla
    public $usuario;
    public $direccion;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Método para actualizar el nombre de usuario
    public function updateName() {
        $stmt = $this->conn->prepare("UPDATE " . $this->usersTable . " SET Usuario = ? WHERE Usuario = ?");
        $this->usuario = htmlspecialchars(strip_tags($this->usuario));
        $stmt->bind_param("ss", $this->usuario, $this->usuario);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Método para actualizar la dirección
    public function updateAddress() {
        $stmt = $this->conn->prepare("UPDATE " . $this->usersTable . " SET Direccion = ? WHERE Usuario = ?");
        $this->direccion = htmlspecialchars(strip_tags($this->direccion));
        $this->usuario = htmlspecialchars(strip_tags($this->usuario));
        $stmt->bind_param("ss", $this->direccion, $this->usuario);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}