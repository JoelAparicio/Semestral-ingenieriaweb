<?php
class base_de_datos{
    private $host = "tu_host";  // Ejemplo: 'localhost'
    private $db_name = "nombre_de_tu_base_de_datos";
    private $username = "tu_usuario";
    private $password = "tu_contraseña";
    public $conn;
    // Método para abrir la conexión
    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch(PDOException $exception) {
            echo "Error de conexión: " . $exception->getMessage();
        }

        return $this->conn;
    }
    // Método para cerrar la conexión
    public function closeConnection() {
        $this->conn = null;
    }
}

// Uso de la clase Base_de_datos:
// $baseDeDatos = new Base_de_datos();
// $db = $baseDeDatos->getConnection();

// Para cerrar la conexión:
// $baseDeDatos->closeConnection();