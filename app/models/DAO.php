<?php
class UserDAO {
    
    private $conexion;

    
    public function __construct($conexion) {
        if ($conexion == null) {
            throw new Exception("La conexión a la base de datos no es válida.");
        }
        $this->conexion = $conexion;
    }

    public function registrarUsuarioDesdePost() {
        if (!isset($_POST['username'], $_POST['email'], $_POST['password'])) {
            $_SESSION['mensajeError'] = 'Por favor completa todos los campos.';
            return;
        }
    
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $password = $_POST['password'];
    
        // Validación de correo electrónico
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['mensajeError'] = 'El correo electrónico no es válido.';
            return;
        }
    
        // Validación de nombre de usuario
        if (strlen($username) < 3) {
            $_SESSION['mensajeError'] = 'El nombre de usuario debe tener al menos 3 caracteres.';
            return;
        }
    
        // Validar que la contraseña tenga un mínimo de 6 caracteres
        if (strlen($password) < 6) {
            $_SESSION['mensajeError'] = 'La contraseña debe tener al menos 6 caracteres.';
            return;
        }
    
        $password_hash = password_hash($password, PASSWORD_BCRYPT);
    
        // Verificar si el email o username ya existen
        $checkUser = $this->conexion->prepare("SELECT user_id FROM user_admin WHERE email = :email OR username = :username");
        $checkUser->bindParam(':email', $email);
        $checkUser->bindParam(':username', $username);
        $checkUser->execute();
    
        if ($checkUser->rowCount() > 0) {
            $_SESSION['mensajeError'] = 'El correo o el nombre de usuario ya están registrados. Usa otros.';
            return;
        }
    
        // Insertar usuario si todo está bien
        $stmt = $this->conexion->prepare("INSERT INTO user_admin (username, email, password_hash) VALUES (:username, :email, :password_hash)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password_hash', $password_hash);
    
        if ($stmt->execute()) {
            echo "<script>
            alert('¡Usuario registrado exitosamente!');
            window.location.href = '" . URL . "/login';
            </script>";
            exit;
        } else {
            echo "<script>
            alert('¡El usuario no se registro, válida los datos!');
            window.location.href = '" . URL . "/registro';
            </script>";
        }
    }

    public function login($username, $password) {
        if (empty($username) || empty($password)) {
            echo "<script>alert('Por favor completa todos los campos.');</script>";
            return false;
        }

        $stmt = $this->conexion->prepare("SELECT * FROM user_admin WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        if ($stmt->rowCount() === 1) {
            $user = $stmt->fetch(PDO::FETCH_OBJ);

            if (password_verify($password, $user->password_hash)) {
                return $user; 
            } 
        } 

        return false;
    }
}
?>

