<nav class="navbar fixed-top navbar-expand-lg navbar-dark unique-color scrolling-navbar">
  <a class="navbar-brand" href="#">
    <img src="img/blocs.png" width="30" height="30" class="d-inline-block align-top" alt="">Creapolis
  </a>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Home
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="home.php">Todos Proyectos</a>
          <a class="dropdown-item" href="home-activos.php">Proyectos Activos</a>
          <a class="dropdown-item" href="home-finalizados.php">Proyectos Finalizados</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="home-person.php">Mis Proyectos</a>
          <a class="dropdown-item" href="home-person-activos.php">Mis Proyectos Activos</a>
          <a class="dropdown-item" href="home-person-finalizados.php">Mis Proyectos Finalizados</a>
          <a class="dropdown-item" href="#">Mi Agenda</a>
        </div>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Proyectos
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="register/project.php">Nuevo</a>
          <a class="dropdown-item" href="search/project.php">Buscar</a>
          <a class="dropdown-item" href="#">Agenda</a>
        </div>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Clientes
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="register/client.php">Nuevo</a>
          <a class="dropdown-item" href="search/client.php">Buscar</a>
        </div>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Colaboradores
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="register/user.php">Registrar Colaboradores</a>
          <a class="dropdown-item" href="search/user.php">Buscar Colaboradores</a>
          <a class="dropdown-item" href="register/area.php">Registrar Area</a>
          <a class="dropdown-item" href="search/area.php">Buscar Area</a>
        </div>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Cuenta
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Mi Cuenta</a>
          <a class="dropdown-item" href="php/logout.php">Salir</a>
        </div>
      </li>


      <li class="nav-item active">
        <a class="nav-link" href="#">Contacto<span class="sr-only">(current)</span></a>
      </li>
    </ul>

    <!--<form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>

    <a class="navbar-brand project-manager" href="#">Project Manager</a>-->
  </div>
</nav>