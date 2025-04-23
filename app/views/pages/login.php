<?php require_once APP . '/views/inc/header.php' ?>

<body class="body-login">
    <div class="container d-flex flex-column justify-content-center align-items-center min-vh-100">
        <div class="card bg-transparent border-0" style="max-width: 500px; width: 100%;">
            <div class="card-body d-flex flex-column align-items-center card-login-custom">
                <h5 class="card-title text-center mb-4">Iniciar sesión</h5>
                <div class = "mb-3">
                    <img src="<?= URL . '/public/img/logo.png' ?>" id = "logo-img" alt="logo F&CStore">
                </div>
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="username" class="form-label">Nombre de usuario</label>
                        <input type="text" class="form-control form-input" id="usuario" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" class="form-control form-input" id="clave" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Iniciar sesión</button>
                </form>
                <div class="text-center mt-3">
                    <a class="link-volver" href="<?php echo URL; ?>">← Volver al inicio</a>
                </div>
            </div>
        </div>
    </div>

<?php require_once APP . '/views/inc/footer.php' ?>