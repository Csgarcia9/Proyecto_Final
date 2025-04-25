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
    <main class="d-flex justify-content-center align-items-center m-3">
      <div class="container text-center m-5">
        <div id="carruselPrincipal" class="carousel slide carousel-custom" data-bs-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="./public/img/finanzas.jpg" class="d-block mx-auto carousel-img" alt="Imagen 1">
            </div>
            <div class="carousel-item">
              <img src="./public/img/inventario.jpg" class="d-block mx-auto carousel-img" alt="Imagen 2">
            </div>
            <div class="carousel-item">
              <img src="./public/img/Simple.jpg" class="d-block mx-auto carousel-img" alt="Imagen 3">
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carruselPrincipal" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Anterior</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carruselPrincipal" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Siguiente</span>
          </button>
        </div>
      </div>
    </main>


<?php require_once APP . '/views/inc/footer.php' ?>