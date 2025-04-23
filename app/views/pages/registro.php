<?php require_once APP . '/views/inc/header.php' ?>

<body class="body-registro">
  <div class="container d-flex flex-column justify-content-center align-items-center min-vh-100">
        <div class = "mb-3">
                        <img src="<?= URL . '/public/img/logo.png' ?>" id = "logo-img" alt="logo F&CStore">
        </div>
        <div class="card bg-transparent card-login-custom" style="max-width: 500px; width: 100%;">
            <div class="card-body">
                <h5 class="card-title text-center mb-4">Crear cuenta</h5>
                <form action="" method="POST">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre completo</label>
                    <input type="text" class="form-control form-input input-registro" id="nombre" name="nombre" required>
                </div>
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
                    <input type="password" class="form-control form-input input-registro" id="clave" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Registrarse</button>
                </form>

                <!-- Enlace para volver -->
                <div class="text-center mt-3">
                <a class="link-volver" href="<?php echo URL; ?>">← Volver al inicio</a>
                </div>
            </div>
        </div>
  </div>

<?php require_once APP . '/views/inc/footer.php' ?>
