<?php
require_once "includes/functions.php";
session_start();

//vérification pour chaque input de compte et infos_perso dans le form plus bas
if (!empty($_POST['password'])) {
    $modif = $_POST['password'];
    $stmt = getDb()->prepare('UPDATE compte SET mot_de_passe=? WHERE idMail=?');
    $stmt->execute(array($modif, $_SESSION['login']));
    $chgt = "Modification(s) enregistrée(s)";
}
if (!empty($_POST['prenom'])) {
    $modif = $_POST['prenom'];
    $stmt = getDb()->prepare('UPDATE infos_perso SET prenom=? WHERE idMail=?');
    $stmt->execute(array($modif, $_SESSION['login']));
    $chgt = "Modification(s) enregistrée(s)";
}
if (!empty($_POST['nom'])) {
    $modif = $_POST['nom'];
    $stmt = getDb()->prepare('UPDATE infos_perso SET nom=? WHERE idMail=?');
    $stmt->execute(array($modif, $_SESSION['login']));
    $chgt = "Modification(s) enregistrée(s)";
}
if (!empty($_POST['genre'])) {
    $modif = $_POST['genre'];
    $stmt = getDb()->prepare('UPDATE infos_perso SET genre=? WHERE idMail=?');
    $stmt->execute(array($modif, $_SESSION['login']));
    $chgt = "Modification(s) enregistrée(s)";
}
if (!empty($_POST['mail'])) {
    $modif = $_POST['mail'];
    $stmt = getDb()->prepare('UPDATE infos_perso SET mail=? WHERE idMail=?');
    $stmt->execute(array($modif, $_SESSION['login']));
    $chgt = "Modification(s) enregistrée(s)";
}
//cahcher le mail
$stmt = getDb()->prepare('SELECT mail FROM infos_perso WHERE idMail=?');
$stmt->execute(array($_SESSION['login']));
$ligne = $stmt->fetch();
if (!empty($_POST['cacheMail'])) { //l'élève veut cacher son mail
    if ($ligne['mail'][0] != '#') { //s'il n'est pas déjà caché
        $ligne['mail'] = '#' . $ligne['mail']; //rajout de '#' pour le noter comme caché
        $stmt = getDb()->prepare('UPDATE infos_perso SET mail=? WHERE idMail=?');
        $stmt->execute(array($ligne['mail'], $_SESSION['login']));
    }
} else { //veut dévoiler son mail
    if ($ligne['mail'][0] == '#') { //s'il n'est pas déjà dévoilé
        $ligne['mail'] = substr($ligne['mail'], 1); //on enlève le 1er caractère : '#'
        $stmt = getDb()->prepare('UPDATE infos_perso SET mail=? WHERE idMail=?');
        $stmt->execute(array($ligne['mail'], $_SESSION['login']));
    }
}

if (!empty($_POST['tel'])) {
    $modif = $_POST['tel'];
    $stmt = getDb()->prepare('UPDATE infos_perso SET telephone=? WHERE idMail=?');
    $stmt->execute(array($modif, $_SESSION['login']));
    $chgt = "Modification(s) enregistrée(s)";
}
//cacher le téléphone (même que pour mail)
$stmt = getDb()->prepare('SELECT telephone FROM infos_perso WHERE idMail=?');
$stmt->execute(array($_SESSION['login']));
$ligne = $stmt->fetch();
if (!empty($_POST['cacheTel'])) {
    if ($ligne['telephone'][0] != '#') {
        $ligne['telephone'] = '#' . $ligne['telephone'];
        $stmt = getDb()->prepare('UPDATE infos_perso SET telephone=? WHERE idMail=?');
        $stmt->execute(array($ligne['telephone'], $_SESSION['login']));
    }
} else {
    if ($ligne['telephone'][0] == '#') {
        $ligne['telephone'] = substr($ligne['telephone'], 1);
        $stmt = getDb()->prepare('UPDATE infos_perso SET telephone=? WHERE idMail=?');
        $stmt->execute(array($ligne['telephone'], $_SESSION['login']));
    }
}

if (!empty($_POST['ville'])) {
    $modif = $_POST['ville'];
    $stmt = getDb()->prepare('UPDATE infos_perso SET ville=? WHERE idMail=?');
    $stmt->execute(array($modif, $_SESSION['login']));
    $chgt = "Modification(s) enregistrée(s)";
}
if (!empty($_POST['cp'])) {
    $modif = $_POST['cp'];
    $stmt = getDb()->prepare('UPDATE infos_perso SET CPPerso=? WHERE idMail=?');
    $stmt->execute(array($modif, $_SESSION['login']));
    $chgt = "Modification(s) enregistrée(s)";
}
//cacher ville (servira pour cacher aussi le code postal)
$stmt = getDb()->prepare('SELECT ville FROM infos_perso WHERE idMail=?');
$stmt->execute(array($_SESSION['login']));
$ligne = $stmt->fetch();
if (!empty($_POST['cacheLieu'])) {
    if ($ligne['ville'][0] != '#') {
        $ligne['ville'] = '#' . $ligne['ville'];
        $stmt = getDb()->prepare('UPDATE infos_perso SET ville=? WHERE idMail=?');
        $stmt->execute(array($ligne['ville'], $_SESSION['login']));
    }
} else {
    if ($ligne['ville'][0] == '#') {
        $ligne['ville'] = substr($ligne['ville'], 1);
        $stmt = getDb()->prepare('UPDATE infos_perso SET ville=? WHERE idMail=?');
        $stmt->execute(array($ligne['ville'], $_SESSION['login']));
    }
}

if (!empty($_POST['promo'])) {
    $modif = $_POST['promo'];
    $stmt = getDb()->prepare('UPDATE infos_perso SET promotion=? WHERE idMail=?');
    $stmt->execute(array($modif, $_SESSION['login']));
    $chgt = "Modification(s) enregistrée(s)";
}

?>

<!doctype html>
<html>

<?php
$pageTitle = "Profil";
require_once "includes/head.php";
?>

<body>

    <?php require_once "includes/header.php"; ?>
    <div class="container">
        <div style="padding-top:60px;">
            <h2 class="text-center"><?= $pageTitle ?></h2>
        </div>

        <?php if (isset($chgt)) { ?>
            <div class="alert alert-success">
                <strong>Succès !</strong> <?= $chgt ?>
                <!-- message lors d'une modif du compte ou de infos_perso -->
            </div>
        <?php } ?>

        <div id="accordion">
            <div class="card">
                <!-- INFOS_PERSO -->
                <?php $stmt = getDb()->prepare('select * from infos_perso where idMail=?');
                $stmt->execute(array($_SESSION['login']));
                $ligne = $stmt->fetch(); ?>
                <div class="card-header" id="headingOne">
                    <h5 class="mb-0 text-center">
                        <button class="col-md-12 btn btn-light" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Informations personnelles
                        </button>
                    </h5>
                </div>
                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <form action="profil.php" role="form" method="POST">
                                <!-- form pour modifier les infos perso, 
                                                                                les infos actuelles sont dans les placeholder -->
                                <div class="form-group row my-2">
                                    <label for="prenom" class="col-sm-2 col-form-label">Prénom : </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="prenom" id="prenom" placeholder=<?php echo $ligne['prenom'] ?>>
                                    </div>
                                </div>
                                <div class="form-group row my-2">
                                    <label for="nom" class="col-sm-2 col-form-label">Nom : </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="nom" id="nom" placeholder=<?php echo $ligne['nom']; ?>>
                                    </div>
                                </div>
                                <fieldset class="form-group">
                                    <div class="row">
                                        <legend class="col-form-label col-sm-2 pt-0">Genre : </legend>
                                        <div class="col-sm-10">
                                            <div class="form-check">
                                                <!-- 3 cas pour pour pré-coché la bonne case -->
                                                <?php if ($ligne['genre'] == "Femme") { ?>
                                                    <input class="form-check-input" type="radio" name="genre" id="gridRadios1" value="Femme" checked>
                                                <?php } else { ?>
                                                    <input class="form-check-input" type="radio" name="genre" id="gridRadios1" value="Femme">
                                                <?php } ?>
                                                <label class="form-check-label" for="gridRadios1">Femme</label>
                                            </div>
                                            <div class="form-check">
                                                <?php if ($ligne['genre'] == "Homme") { ?>
                                                    <input class="form-check-input" type="radio" name="genre" id="gridRadios2" value="Homme" checked>
                                                <?php } else { ?>
                                                    <input class="form-check-input" type="radio" name="genre" id="gridRadios2" value="Homme">
                                                <?php } ?>
                                                <label class="form-check-label" for="gridRadios2">Homme</label>
                                            </div>
                                            <div class="form-check">
                                                <?php if ($ligne['genre'] == "Autre") { ?>
                                                    <input class="form-check-input" type="radio" name="genre" id="gridRadios3" value="Autre" checked>
                                                <?php } else { ?>
                                                    <input class="form-check-input" type="radio" name="genre" id="gridRadios3" value="Autre">
                                                <?php } ?>
                                                <label class="form-check-label" for="gridRadios3">Autre</label>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <div class="form-group row my-2">
                                    <label for="mail" class="col-sm-2 col-form-label">E-mail : </label>
                                    <?php if ($ligne['mail'][0] != '#') { ?>
                                        <!-- pour pré-cocher le fait que le mail soit caché ou pas -->
                                        <div class="col-sm-8">
                                            <input type="email" class="form-control" name="mail" id="mail" placeholder=<?php echo $ligne['mail'] ?>>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="custom-control custom-switch">
                                                <!-- checxbox pour cacher le mail -->
                                                <input type="checkbox" class="custom-control-input" id="customSwitch3" name="cacheMail">
                                                <label class="custom-control-label" for="customSwitch3">Cacher</label>
                                            </div>
                                        </div>
                                    <?php } else { ?>
                                        <div class="col-sm-8">
                                            <input type="email" class="form-control" name="mail" id="mail" placeholder=<?php echo substr($ligne['mail'], 1) ?>>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="custom-control custom-switch">
                                                <!-- checxbox pour cacher le mail -->
                                                <input type="checkbox" class="custom-control-input" id="customSwitch3" name="cacheMail" checked>
                                                <label class="custom-control-label" for="customSwitch3">Cacher</label>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="form-group row my-2">
                                    <label for="telephone" class="col-sm-2 col-form-label">Téléphone : </label>
                                    <?php if ($ligne['telephone'][0] != '#') { ?>
                                        <!-- même structure que pour le mail -->
                                        <div class="col-sm-8">
                                            <input type="tel" pattern="[0-9]{10}" class="form-control" name="tel" id="telephone" placeholder=<?php echo $ligne['telephone'] ?>>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="customSwitch1" name="cacheTel">
                                                <label class="custom-control-label" for="customSwitch1">Cacher</label>
                                            </div>
                                        </div>
                                    <?php } else { ?>
                                        <div class="col-sm-8">
                                            <input type="tel" pattern="[0-9]{10}" class="form-control" name="tel" id="tel" placeholder=<?php echo substr($ligne['telephone'], 1) ?>>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="customSwitch1" name="cacheTel" checked>
                                                <label class="custom-control-label" for="customSwitch1">Cacher</label>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="form-group row my-2">
                                    <label for="ville" class="col-sm-2 col-form-label">Ville : </label>
                                    <?php if ($ligne['ville'][0] != '#') { ?>
                                        <!-- même structure encore, le code postal est compris dans le if pour ne pas le répéter -->
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" name="ville" id="ville" placeholder=<?php echo $ligne['ville'] ?>>
                                        </div>
                                        <label for="cp" class="col-sm-2 col-form-label text-right">Code Postal : </label>
                                        <div class="col-sm-2">
                                            <input type="text" pattern="[0-9]{5}" class="form-control" name="cp" id="cp" placeholder=<?php echo $ligne['CPPerso'] ?>>
                                        </div>
                                        <div class="col-sm-2 bottom">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="customSwitch2" name="cacheLieu">
                                                <label class="custom-control-label" for="customSwitch2">Cacher</label>
                                            </div>
                                        </div>
                                    <?php } else { ?>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" name="ville" id="ville" placeholder=<?php echo substr($ligne['ville'], 1) ?>>
                                        </div>
                                        <label for="cp" class="col-sm-2 col-form-label text-right">Code Postal : </label>
                                        <div class="col-sm-2">
                                            <input type="text" pattern="[0-9]{5}" class="form-control" name="cp" id="cp" placeholder=<?php echo $ligne['CPPerso'] ?>>
                                        </div>
                                        <div class="col-sm-2 bottom">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="customSwitch2" name="cacheLieu" checked>
                                                <label class="custom-control-label" for="customSwitch2">Cacher</label>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="form-group row my-2">
                                    <label for="promo" class="col-sm-2 col-form-label">Promotion : </label>
                                    <div class="col-sm-10">
                                        <input type="number" min="2007" max="2023" class="form-control" name="promo" id="promo" placeholder=<?php echo $ligne['promotion'] ?>>
                                    </div>
                                </div>
                                <div class="form-group row justify-content-center">
                                    <div class="col-sm-10 text-center">
                                        <button type="reset" class=" col-md-3 btn btn-outline-primary">Effacer</button>
                                        <button type="submit" class=" col-md-3 btn btn-primary">Enregistrer</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <!-- COMPTE -->
                <?php $stmt = getDb()->prepare('select * from compte where idMail=?');
                $stmt->execute(array($_SESSION['login']));
                $ligne = $stmt->fetch(); ?>
                <div class="card-header" id="headingTwo">
                    <h5 class="mb-0 text-center">
                        <button class="col-md-12 btn btn-light collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Compte
                        </button>
                    </h5>
                </div>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <form action="profil.php" role="form" method="POST">
                                <div class="form-group row my-2">
                                    <label for="login" class="col-sm-2 col-form-label">Identifiant : </label>
                                    <div class="col-sm-10">
                                        <input type="text" readonly class="form-control-plaintext" id="login" value=<?php echo $ligne['idMail'] ?>>
                                    </div>
                                </div>
                                <div class="form-group row my-2">
                                    <label for="password" class="col-sm-2 col-form-label">Mot de passe : </label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" name="password" id="password" placeholder='Saisisez votre nouveau mot de passe'>
                                    </div>
                                </div>
                                <div class="form-group row justify-content-center">
                                    <div class="col-sm-10 text-center">
                                        <button type="reset" class=" col-md-3 btn btn-outline-primary">Effacer</button>
                                        <button type="submit" class=" col-md-3 btn btn-primary">Enregistrer</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <!-- FORMATION  -->
                <div class="card-header" id="headingThree">
                    <h5 class="mb-0 text-center">
                        <button class="col-md-12 btn btn-light collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Formation
                        </button>
                    </h5>
                </div>
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                    <div class="card-body">
                        <div class="text-center my-2">
                            <!-- ajout d'une formation -->
                            <a href="ajoutForma.php"><button type="submit" class=" col-md-3 btn btn-primary">Ajouter</button></a>
                        </div>
                        <?php $forma = getDb()->prepare('select * from formation where idMail=? order by dateDebut desc');
                        $forma->execute(array($_SESSION['login']));
                        while ($ligne = $forma->fetch()) { ?>
                            <!-- boucle pour afficher toutes les formations -->
                            <div class="container border rounded border-dark my-2">
                                <div class="row">
                                    <div class="col-md-3 px-4 pb-2">
                                        <div class="row">
                                            <?php echo $ligne['typeF'] ?>
                                        </div>
                                        <div class="row">
                                            Etablissement : <?php echo $ligne['etablissement'] ?>
                                        </div>
                                        <div class="row">
                                            Diplôme : <?php echo $ligne['diplome'] ?>
                                        </div>
                                    </div>
                                    <div class="col-md-3 offset-md-1">
                                        <div class="row">
                                            Ville : <?php echo $ligne['villeF'] ?>
                                        </div>
                                        <div class="row">
                                            Code postal : <?php echo $ligne['CPF'] ?>
                                        </div>
                                    </div>
                                    <div class="col-md-2 offset-md-1">
                                        <div class="row">
                                            Début : <?php echo date('d/m/Y', strtotime($ligne['dateDebut'])) ?>
                                        </div>
                                        <div class="row">
                                            Fin : <?php echo date('d/m/Y', strtotime($ligne['dateFin'])) ?>
                                        </div>
                                    </div>
                                    <div class="col-md-2 text-center">
                                        <form action="modifForma.php" role="form" method="post"> <!-- modification de la formation -->
                                            <input id="idF" name="idF" type="hidden" value="<?= $ligne['idF'] ?>">
                                            <button type="submit" class="btn btn-outline-secondary mt-2"><i class="bi bi-pencil-fill"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <!-- EXP_PRO -->
            <div class="card-header" id="headingFour">
                <h5 class="mb-0 text-center">
                    <button class="col-md-12 btn btn-light collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                        Expérience professionelle
                    </button>
                </h5>
            </div>
            <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                <div class="card-body">
                    <div class="text-center my-2">
                    <!-- ajout d'une expérience -->
                        <a href="ajoutExp.php"><button type="submit" class="col-md-3 btn btn-primary">Ajouter</button></a>
                    </div>
                    <?php $forma = getDb()->prepare('select * from exp_pro where idMail=? order by dateDebPro desc');
                    $forma->execute(array($_SESSION['login']));
                    while ($ligne = $forma->fetch()) { ?>
                        <!-- boucle pour afficher toutes les expériences -->
                        <div class="container border rounded border-dark my-2">
                            <div class="row">
                                <div class="col-md-4 px-4 pb-2">
                                    <div class="row">
                                        <?php echo $ligne['typePro'] ?>
                                    </div>
                                    <div class="row">
                                        Organisme : <?php echo $ligne['organisme'] ?>
                                    </div>
                                    <div class="row">
                                        Secteur d'activité : <?php echo $ligne['secteur_act'] ?>
                                    </div>
                                    <div class="row">
                                        Poste : <?php echo $ligne['poste'] ?>
                                    </div>
                                    <div class="row">
                                        Salaire : <?php echo $ligne['salaire'] . ' euros' ?>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="row">
                                        <div class="col-md-5 offset-md-1">
                                            <div class="row">
                                                Ville : <?php echo $ligne['villePro'] ?>
                                            </div>
                                            <div class="row">
                                                Code postal : <?php echo $ligne['CPPro'] ?>
                                            </div>
                                        </div>
                                        <div class="col-md-5 offset-md-1">
                                            <div class="row">
                                                Activité actuelle : <?php if ($ligne['actiActuel']) {
                                                                        echo 'Non';
                                                                    } else {
                                                                        echo 'Oui';
                                                                    } ?>
                                            </div>
                                            <div class="row">
                                                Début : <?php echo date('d/m/Y', strtotime($ligne['dateDebPro'])) ?>
                                            </div>
                                            <div class="row">
                                                Fin : <?php if ($ligne['dateFinPro'] != "0000-00-00" and $ligne['dateFinPro'] != null) {
                                                            echo date('d/m/Y', strtotime($ligne['dateFinPro']));
                                                        } ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        Description :
                                        <p> <?php echo $ligne['description'] ?> </p>
                                    </div>
                                </div>
                                <div class="col-md-1 text-center">
                                    <form action="modifExp.php" role="form" method="post"> <!-- modif de l'expérience -->
                                        <input id="idPro" name="idPro" type="hidden" value="<?= $ligne['idPro'] ?>">
                                        <button type="submit" class="btn btn-outline-secondary mt-2"><i class="bi bi-pencil-fill"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    </div>
    <?php require_once "includes/footer.php"; ?>
</body>

</html>