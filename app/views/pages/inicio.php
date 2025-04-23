<?php require_once APP . '/views/inc/header.php' ?>

<body class="body-home">

  <!-- Navbar con links centrados -->
  <nav class="navbar navbar-expand-lg" style="background-color: inherit;">
    <div class="container d-flex justify-content-center">
      <ul class="navbar-nav flex-row">
        <li class="nav-item">
          <a class="nav-link" href="<?= URL ?>/login">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= URL ?>/dashboard">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= URL ?>/registro">Crear usuario</a>
        </li>
      </ul>
    </div>
  </nav>

  <!-- Espacio para el carrusel -->
  <main class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="container text-center">
      <div id="carousel-placeholder">
        <p class="text-muted">Aquí irá tu carrusel</p>
      </div>
    </div>
  </main>

<?php require_once APP . '/views/inc/footer.php' ?>