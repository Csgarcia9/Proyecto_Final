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
          <button class="btn btn-primary mx-2" data-bs-toggle="modal" data-bs-target="#modalAgregar"  name = "crear">Agregar</button>
          <button class="btn btn-danger mx-2" data-bs-toggle="modal" data-bs-target="#modalEliminar"  name = "eliminar">Eliminar </button>
          <button class="btn btn-warning mx-2" data-bs-toggle="modal" data-bs-target="#modalEditar"  name = "editar">Editar</button>
        </div>
        <div class="ml-auto">
        <a href="<?= URL ?>/Auth/logout" class="btn btn-secondary">Cerrar sesión</a>
        </div>
      </div>
    </nav>
  </header>
  <div class="container-fluid d-flex">
    <aside class="sidebar p-3" >
      <button class="btn btn-outline-primary w-100 mb-2 items-button" id = "usuarios">Usuarios</button>
      <button class="btn btn-outline-primary w-100 mb-2 items-button" id = "productos">Productos</button>
      <button class="btn btn-outline-primary w-100 mb-2 items-button" id = "limpiar">Limpiar</button>
    </aside>
    <main class="main-content p-4 flex-grow-1" style="background-color: transparent;">
        <div class="contenido d-flex justify-content-center align-items-center" id = "contenido">
          

        </div>
    </main>
  </div>

  <!-- Modales de registro -->

<!-- Modal para agregar producto -->

  <div class="modal fade" id="modalAgregar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Agregar Producto</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <?php require_once APP . '/views/inc/productoform.php' ?>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
      </div>
    </div>
</div>

<!-- Modal para editar producto -->

<div class="modal fade" id="modalEditar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Editar Producto</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <?php require_once APP . '/views/inc/editarpro.php' ?>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
      </div>
    </div>
</div>

<!-- Modal para eliminar producto -->

<div class="modal fade" id="modalEliminar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Agregar Producto</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
           <?php require_once APP . '/views/inc/eliminarpro.php' ?>
          </div>
          <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>  
          </div>
      </div>
    </div>
</div>


<?php require_once APP . '/views/inc/footer.php' ?>