<?php
require_once APP . '/models/DAO.php';

class Auth {
    private $userDAO;

    public function __construct($conexion) {
        $this->userDAO = new UserDAO($conexion);
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            
            $authUser = $this->userDAO->login($username, $password);

            if ($authUser) {
                session_start();
                $_SESSION['user_id'] = $authUser->user_id;
                $_SESSION['username'] = $authUser->username;
                
            
                echo "<script>
                    alert('¡Bienvenido, " . $authUser->username . "!');
                    window.location.href = '" . URL . "/dashboard';
                </script>";
                exit;
            } else {
                echo "<script>
                    alert('Usuario o contraseña incorrectos.');
                    window.location.href = '" . URL . "/login';
                </script>";
                exit;
            }
            
        }
    }

    public function logout() {
        session_start();
        // Obtener el nombre de usuario antes de destruir la sesión
        $username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Usuario';
    
        session_unset();
        session_destroy();
    
        echo "<script>
            alert('¡Has cerrado sesión, $username!');
            window.location.href = '" . URL . "/login';
            </script>";
        exit;
    }
    
}
