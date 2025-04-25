<?php
// Verificar si el usuario está autenticado
session_start();

if (!isset($_SESSION['user_id'])) {
    // Si no está autenticado, redirigir al login
    header("Location: " . URL . "/login");
    exit;
}
?>


<?php require_once APP . '/config/db.php'; ?>

<?php require_once APP . '/views/inc/header.php' ?>

<body class="body-dashboard">
  <header>
    <nav class="navbar navbar-expand-lg bg-transparent" >
      <div class="container-fluid">
        <div class="navbar-brand">Mi Dashboard</div>
        <div class="d-flex justify-content-center">
          <button class="btn btn-primary mx-2">Agregar</button>
          <button class="btn btn-danger mx-2">Eliminar</button>
          <button class="btn btn-warning mx-2">Editar</button>
        </div>
        <div class="ml-auto">
        <a href="<?= URL ?>/Auth/logout" class="btn btn-secondary">Cerrar sesión</a>
        </div>
      </div>
    </nav>
  </header>
  <div class="container-fluid d-flex">
    <aside class="sidebar p-3" style="background-color: transparent;">
      <button class="btn btn-outline-primary w-100 mb-2">Usuarios</button>
      <button class="btn btn-outline-primary w-100">Productos</button>
    </aside>
    <main class="main-content p-4 flex-grow-1" style="background-color: transparent;">
      <div class="contenido"></div>
    </main>
  </div>


<?php require_once APP . '/views/inc/footer.php' ?>