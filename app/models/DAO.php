<?php
class UserDAO {
    
    private $conexion;

    
    public function __construct($conexion) {
        if ($conexion == null) {
            throw new Exception("La conexión a la base de datos no es válida.");
        }
        $this->conexion = $conexion;
    }

    public function prepare($sql) {
        return $this->conexion->prepare($sql);
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

    public function getUser($username){
        $stmt = $this->conexion->prepare("SELECT * FROM user_admin WHERE username = :username LIMIT 1");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
    
        if ($stmt->rowCount() === 1) {
            return $stmt->fetch(PDO::FETCH_OBJ);
        } else {
            return null;
        }
    }

    public function getUserAll(){
        $stmt = $this->conexion->prepare("SELECT * FROM user_admin ORDER BY user_id DESC");
        $stmt->execute();
    
        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } else {
            return null;
        }
    }

    public function getProductosAll(){
        $stmt = $this->conexion->prepare("SELECT * FROM productos ORDER BY productoID DESC");
        $stmt->execute();
    
        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } else {
            return null;
        }
    }
    

    public function eliminarProducto() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['productoEliminarID'])) {
            $productoId = trim($_POST['productoEliminarID']);

            if (!empty($productoId)) {
                try {
                    // Verificar si el producto existe
                    $stmt = $this->conexion->prepare("SELECT COUNT(*) FROM productos WHERE productoID = :productoId");
                    $stmt->bindParam(':productoId', $productoId);
                    $stmt->execute();

                    if ($stmt->fetchColumn() > 0) {
                        // El producto existe, proceder a eliminar
                        $stmt = $this->conexion->prepare("DELETE FROM productos WHERE productoID = :productoId");
                        $stmt->bindParam(':productoId', $productoId);
                        if ($stmt->execute()) {
                            echo "<script>alert('Producto con ID " . htmlspecialchars($productoId) . " eliminado exitosamente.');
                             window.location.href = '" . URL . "/dashboard';</script>";
                        } else {
                            echo "<script>alert('Error al eliminar el producto con ID " . htmlspecialchars($productoId) . ".');
                             window.location.href = '" . URL . "/dashboard';</script>";
                        }
                    } else {
                        echo "<script>alert('No se encontró ningún producto con el ID " . htmlspecialchars($productoId) . ".');
                         window.location.href = '" . URL . "/dashboard';</script>";
                    }
                } catch (PDOException $e) {
                    error_log("Error al eliminar producto: " . $e->getMessage());
                    echo "<script>alert('Ocurrió un error en la base de datos al eliminar el producto.'); 
                    window.location.href = '" . URL . "/AdminProductos';</script>";
                }
                exit;
            } else {
                echo "<script>alert('Por favor, introduce el ID del producto a eliminar.'); 
                window.location.href = '" . URL . "/dashboard';</script>";
                exit;
            }
        } else {
            // Si no se envió el ID por POST o no se accedió por POST
            header("Location: " . URL . "/dashboard");
            exit;
        }
    }

    public function editarProducto() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['productoID'])) {
            $productoId = trim($_POST['productoID']);
    
            if (empty($productoId)) {
                echo "<script>alert('El ID del producto es obligatorio.'); window.location.href = '" . URL . "/dashboard';</script>";
                exit;
            }
    
            try {
                // Primero verificar si existe el producto
                $checkStmt = $this->conexion->prepare("SELECT COUNT(*) FROM productos WHERE productoID = :productoId");
                $checkStmt->bindParam(':productoId', $productoId);
                $checkStmt->execute();
                $existeProducto = $checkStmt->fetchColumn();
    
                if (!$existeProducto) {
                    echo "<script>alert('No existe un producto con el ID " . htmlspecialchars($productoId) . ".'); 
                    window.location.href = '" . URL . "/dashboard';</script>";
                    exit;
                }
    
                // Ahora preparar los campos a actualizar
                $campos = [];
                $params = [':productoId' => $productoId];
    
                if (!empty($_POST['nombreProducto'])) {
                    $campos[] = "nombreProducto = :nombreProducto";
                    $params[':nombreProducto'] = trim($_POST['nombreProducto']);
                }
                if (!empty($_POST['productoDescripcion'])) {
                    $campos[] = "productoDescripcion = :productoDescripcion";
                    $params[':productoDescripcion'] = trim($_POST['productoDescripcion']);
                }
                if (!empty($_POST['precio'])) {
                    $campos[] = "precio = :precio";
                    $params[':precio'] = trim($_POST['precio']);
                }
                if (!empty($_POST['Stock'])) {
                    $campos[] = "Stock = :stock";
                    $params[':stock'] = trim($_POST['Stock']);
                }
                if (!empty($_POST['imageURL'])) {
                    $campos[] = "imageURL = :imageURL";
                    $params[':imageURL'] = trim($_POST['imageURL']);
                }
                if (!empty($_POST['fechaedicion'])) {
                    $campos[] = "fechaActualizacion = :fechaActualizacion";
                    $params[':fechaActualizacion'] = trim($_POST['fechaedicion']);
                }
    
                if (empty($campos)) {
                    echo "<script>alert('No hay campos para actualizar.'); window.location.href = '" . URL . "/dashboard';</script>";
                    exit;
                }
    
                // Construir el UPDATE dinámico
                $sql = "UPDATE productos SET " . implode(", ", $campos) . " WHERE productoID = :productoId";
    
                $stmt = $this->conexion->prepare($sql);
                foreach ($params as $key => $value) {
                    $stmt->bindValue($key, $value);
                }
    
                if ($stmt->execute()) {
                    echo "<script>alert('Producto con ID " . htmlspecialchars($productoId) . " editado exitosamente.');
                    window.location.href = '" . URL . "/dashboard';</script>";
                } else {
                    echo "<script>alert('Error al editar el producto con ID " . htmlspecialchars($productoId) . ".');
                    window.location.href = '" . URL . "/dashboard';</script>";
                }
    
            } catch (PDOException $e) {
                error_log("Error al editar producto: " . $e->getMessage());
                echo "<script>alert('Ocurrió un error en la base de datos al editar el producto.');
                window.location.href = '" . URL . "/dashboard';</script>";
            }
            exit;
        }
    }    
    
    public function crearProducto() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['productoID'])) {
            $productoId = trim($_POST['productoID']);
            $nombreProducto = trim($_POST['nombreProducto']);
            $productoDescripcion = trim($_POST['productoDescripcion']);
            $precio = trim($_POST['precio']);
            $stock = trim($_POST['Stock']);
            $imageURL = trim($_POST['imageURL']);
            $fechaCreacion = isset($_POST['fechaCreacion']) ? trim($_POST['fechaCreacion']) : null;
    
            if (!empty($productoId) && !empty($nombreProducto) && !empty($productoDescripcion) && !empty($precio) && !empty($stock) && !empty($imageURL)) {
                try {
                    // Primero, validar si el productoID ya existe
                    $verificarStmt = $this->conexion->prepare("SELECT COUNT(*) FROM productos WHERE productoID = :productoID");
                    $verificarStmt->bindParam(':productoID', $productoId);
                    $verificarStmt->execute();
                    $existeProducto = $verificarStmt->fetchColumn();
    
                    if ($existeProducto > 0) {
                        echo "<script>
                            alert('El ID del producto ya existe. Usa uno diferente.');
                            window.location.href = '" . URL . "/dashboard';
                        </script>";
                        exit;
                    }
    
                    // Insertar el producto
                    $sql = "INSERT INTO productos (productoID, nombreProducto, productoDescripcion, precio, Stock, imageURL";
                    if (!empty($fechaCreacion)) {
                        $sql .= ", fechaCreacion";
                    }
                    $sql .= ") VALUES (:productoID, :nombreProducto, :productoDescripcion, :precio, :Stock, :imageURL";
                    if (!empty($fechaCreacion)) {
                        $sql .= ", :fechaCreacion";
                    }
                    $sql .= ")";
    
                    $stmt = $this->conexion->prepare($sql);
    
                    $stmt->bindParam(':productoID', $productoId);
                    $stmt->bindParam(':nombreProducto', $nombreProducto);
                    $stmt->bindParam(':productoDescripcion', $productoDescripcion);
                    $stmt->bindParam(':precio', $precio);
                    $stmt->bindParam(':Stock', $stock);
                    $stmt->bindParam(':imageURL', $imageURL);
    
                    if (!empty($fechaCreacion)) {
                        $stmt->bindParam(':fechaCreacion', $fechaCreacion);
                    }
    
                    if ($stmt->execute()) {
                        echo "<script>alert('Producto creado correctamente.');
                        window.location.href = '" . URL . "/dashboard';</script>";
                    } else {
                        echo "<script>alert('Error al crear el producto.');
                        window.location.href = '" . URL . "/dashboard';</script>";
                    }
                } catch (PDOException $e) {
                    error_log("Error al crear producto: " . $e->getMessage());
                    echo "<script>alert('Ocurrió un error en la base de datos.');
                    window.location.href = '" . URL . "/dashboard';</script>";
                }
                exit;
            } else {
                echo "<script>alert('Completa todos los campos requeridos.');
                window.location.href = '" . URL . "/dashboard';</script>";
                exit;
            }
        }
    }
    
}
?>

