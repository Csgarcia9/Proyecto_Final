<?php 

require_once APP . '/models/DAO.php';
require_once APP . '/config/db.php'; // donde tienes $conexion PDO

class Api {
    private $userDAO;
     // Conexión a la base de datos

     public function __construct($conexion) {
        $this->userDAO = new UserDAO($conexion);
    }

    public function UserJson() {
        $users = $this->userDAO->getUserAll();
        header('Content-Type: application/json');

        if ($users === null) {
            http_response_code(404);
            echo json_encode(['error' => 'No se encontraron usuarios.']);
        } else {
            http_response_code(200);
            echo json_encode($users);
        }
    }

    public function ProductosJson() {
        $productos = $this->userDAO->getProductosAll();
        header('Content-Type: application/json');

        if ($productos === null) {
            http_response_code(404);
            echo json_encode(['error' => 'No se encontraron productos.']);
        } else {
            http_response_code(200);
            echo json_encode($productos);
        }
    }
}
?>



