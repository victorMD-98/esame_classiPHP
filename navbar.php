

<header>
<nav class="navbar navbar-expand-lg bg-body-tertiary bg-dark border-bottom border-body" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand ms-5" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
      </ul>
      <ul class="navbar-nav ms-auto me-5">
        <?php if(!isset($_SESSION['userLogin'])){ ?>
            <li class="nav-item">
              <a class="nav-link" href="login.php">Accedi</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="register.php">Registrati</a>
            </li>
          <?php } else { ?>
            <li class="nav-item">
              <a class="nav-link" href="logout.php">Logout</a>
            </li>
          <?php }?>
      </ul>
      
    </div>
  </div>
</nav>
</header>