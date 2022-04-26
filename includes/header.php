<?php require_once "includes/functions.php"; ?>

<nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <!-- côté gauche de la navbar -->
    <?php if (isUserConnected()) { ?>
      <div class="navbar-header">
        <?php if ($_SESSION['type'] == 0) { //si gestionnaire, accueil (connecté) = site.php 
        ?>
          <a class="navbar-brand" href="site.php"><img src=images/logo_ensc.jpg width="100" height="..." alt="logo_ensc" />
            Annuaire ENSC
          </a>
        <?php } else { //si élève, accueil (connecté) = profil.php 
        ?>
          <a class="navbar-brand" href="profil.php"><img src=images/logo_ensc.jpg width="100" height="..." alt="logo_ensc" />
            Annuaire ENSC
          </a>
        <?php } ?>
      </div>
      <div class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
          <?php if ($_SESSION['type'] == 1) { //si élève, on ajoute le bouton "profil"
          ?>
            <li class="mx-2"><a class="btn btn-outline-info" href="profil.php">PROFIL</a></li>
          <?php } ?>
          <li><a class="btn btn-outline-info" href="recherche.php">RECHERCHE</a></li>
        </ul>
      </div>
    <?php } else { //cas non connecté, accueil = index.php?>
      <div class="navbar-header">
        <a class="navbar-brand" href="index.php"><img src=images/logo_ensc.jpg width="100" height="..." alt="logo_ensc" />
          Annuaire ENSC
        </a>
      </div>
    <?php } ?>


    <!-- côté droit de la navbar -->
    <div>
      <?php if (isUserConnected()) { ?>
        <ul class="nav navbar-nav">
          <li class="nav-item active">
            <a class="nav-link btn btn-outline-danger" href="logout.php">DECONNEXION</a>
          </li>
        </ul>
      <?php } else { ?>
        <ul class="nav navbar-nav btnnav">
          <li class="nav-item active">
            <a class="nav-link btn btn-outline-secondary mx-2" href="inscription.php">S'INSCRIRE</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link btn btn-outline-info mx-2" href="connexion.php">CONNEXION</a>
          </li>
        </ul>

      <?php } ?>
    </div>
  </div>
</nav>