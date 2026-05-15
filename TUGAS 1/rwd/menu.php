<nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php?hal=home">
      <img src="img/sttnf.png" alt="Logo" width="40">
      My Web
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php?hal=home">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?hal=about">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?hal=contact">Contact</a>
        </li>
        
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            My Studies
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="index.php?hal=level_list">Level</a></li>
            <li><a class="dropdown-item" href="index.php?hal=studies_list">Studies</a></li>
          </ul>
        </li>

        <?php
        if(!isset($_SESSION['MEMBER'])){ 
        ?>
          <li class="nav-item">
            <a class="nav-link" href="index.php?hal=login">Login</a>
          </li>
        <?php
        }
        else{ 
        ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="bi bi-person-circle"></i> <?= $_SESSION['MEMBER']['username'] ?>
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#"><?= $_SESSION['MEMBER']['role'] ?></a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="logout.php">Logout</a></li>
            </ul>
          </li>
        <?php } ?>
      </ul>

      <form class="d-flex" role="search" method="GET" action="index.php">
        <input type="hidden" name="hal" value="studies_cari">
        
        <input class="form-control me-2" type="search" name="keyword" placeholder="Cari Sekolah..." aria-label="Search" value="<?= $_GET['keyword'] ?? '' ?>">
        <button class="btn btn-outline-light" type="submit">Search</button>
      </form>

    </div>
  </div>
</nav>