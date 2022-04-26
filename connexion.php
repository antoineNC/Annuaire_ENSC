<?php
require_once "includes/functions.php";
session_start();
//vérification de l'entrée des identifiants
if (!empty($_POST['login']) and !empty($_POST['password'])) {
    $login = $_POST['login'];
    $password = $_POST['password'];

    $stmt = getDb()->prepare('select * from compte where idMail=? and mot_de_passe=?');
    $stmt->execute(array($login, $password)); //recherche d'un compte avec les identifiants donnés
    if ($stmt->rowCount() == 1) {//si un tel compte existe, alors..
        $ligne = $stmt->fetch();
        if ($ligne['typeC'] == 2) { //le compte existe mais l'inscription n'est pas encore validée
            $error = "Compte en cours de validation";
        } else { //mise en mémoire pour la session des informations du compte
            $_SESSION['login'] = $login;
            $_SESSION['type'] = $ligne['typeC'];
            $_SESSION['password'] = $password;
            if($ligne['typeC'] == 0){ //utilisateur est un gestionnaire
                redirect("site.php");
            }
            else {
                redirect("profil.php");
            }
        }
    } else {
        $error = "Utilisateur.ice non reconnu.e";
    }
}
?>

<!doctype html>
<html>

<?php
$pageTitle = "Connexion";
require_once "includes/head.php";
?>

<body>

    <?php require_once "includes/header.php"; ?>
    <div class="container">
        <div style="padding-top:60px;">
            <h2 class="text-center"><?= $pageTitle ?></h2>
        </div>

        <?php if (isset($error)) { ?>
            <div class="alert alert-danger">
                <strong>Erreur !</strong> <?= $error ?>
            </div>
        <?php } ?>

        <div class="container">
            <div class="row text-black">
                <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 mx-auto form p-4">
                    <form class="form-signin form-horizontal" role="form" action="connexion.php" method="post">
                        <div class="form-group text-center">
                            <label for="login" style="padding-bottom:5px;">Login</label>
                            <input type="text" name="login" class="form-control mb-2" placeholder="Entrez votre login" required autofocus />
                        </div>
                        <div class="form-group text-center">
                            <label for="password" style="padding-bottom:5px;">Mot de passe</label>
                            <input type="password" name="password" class="form-control" placeholder="Entrez votre mot de passe" required />
                        </div>
                        </br>
                        <button type="submit" class=" col-md-12 btn btn-primary btn-lg"><i class="fas fa-sign-in-alt"></i> Se connecter</button>
                    </form>
                </div>
            </div>
        </div>

        <?php require_once "includes/footer.php"; ?>
    </div>
</body>

</html>