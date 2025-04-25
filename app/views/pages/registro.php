<?php
session_start();

// Incluir el archivo de conexión a la base de datos
require_once APP . '/config/db.php'; // Establece la conexión PDO
global $conexion;
require_once APP . '/models/DAO.php'; // Clase UserDAO

// Crear una instancia de UserDAO con la conexión
$userDAO = new UserDAO($conexion);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userDAO->registrarUsuarioDesdePost(); // Llamar al método de registro
}

require_once APP . '/views/inc/header.php'; // Cargar el header HTML
?>

<body class="body-registro">
  <div class="container d-flex flex-column justify-content-center align-items-center min-vh-100">
        <div class="mb-3">
            <img src="<?= URL . '/public/img/logo.png' ?>" id="logo-img" alt="logo F&CStore">
        </div>
        <div class="card bg-transparent card-login-custom" style="max-width: 500px; width: 100%;">
            <div class="card-body">
                <h5 class="card-title text-center mb-4">Crear cuenta</h5>

                <form method="POST">
                    <div class="mb-3">
                        <label for="usuario" class="form-label">Nombre de usuario</label>
                        <input type="text" class="form-control form-input input-registro" id="usuario" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo electrónico</label>
                        <input type="email" class="form-control form-input input-registro" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="clave" class="form-label">Contraseña</label>
                        <input type="password" class="form-control form-input input-registro" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Registrarse</button>
                </form>

                <div class="text-center mt-3">
                    <a class="link-volver" href="<?= URL ?>">← Volver al inicio</a>
                </div>
            </div>
        </div>
  </div>
</body>

<?php require_once APP . '/views/inc/footer.php'; ?>
