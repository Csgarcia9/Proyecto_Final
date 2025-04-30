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
            
            if (empty($username) || empty($password)){
                echo "<script>alert('Por favor completa todos los campos.');
                window.location.href = '" . URL . "/login';
                </script>";
                exit;
            }
            $user = $this->userDAO->getUser($username);
            if ($user) {
                if (password_verify($password, $user->password_hash)) {
                    session_start();
                    $_SESSION['user_id'] = $user->user_id;
                    $_SESSION['username'] = $user->username;

                    $sql = "UPDATE user_admin SET last_login = NOW() WHERE user_id = :user_id";
                    $stmt = $this->userDAO->prepare($sql);
                    $stmt->bindParam(':user_id', $user->user_id);
                    $stmt->execute();

                    echo "<script>alert('¡Bienvenido, " . $user->username . "!');
                    window.location.href = '" . URL . "/dashboard';</script>";
                    exit;
                } else {
                    echo "<script>alert('Contraseña incorrecta. Intenta de nuevo.');
                    window.location.href = '" . URL . "/login';</script>";
                    exit;
                }
            }else 
            {
                echo "<script>alert('El usuario no existe. Intenta de nuevo.');
                window.location.href = '" . URL . "/login';</script>";
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
