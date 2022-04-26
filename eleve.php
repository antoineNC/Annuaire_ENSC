<?php
require_once "includes/functions.php";
session_start();

if (isset($_GET['visu'])) { //obtention du l'identifiant de l'élève dont on visualise le profil
    $idMail = $_GET['visu'];
}
$MaRequete = getDb()->prepare("select * from compte,infos_perso where compte.idMail=? and compte.idMail=infos_perso.idMail");
$MaRequete->execute(array($idMail));

$ligne = $MaRequete->fetch();

$nom = $ligne['nom'];
$prenom = $ligne['prenom'];
$genre = $ligne['genre'];
$mail = $ligne['mail'];
$telephone = $ligne['telephone'];
$ville = $ligne['ville'];
$cpPerso = $ligne['CPPerso'];
$promotion = $ligne['promotion'];
?>


<!doctype html>
<html>

<?php
$pageTitle = "$prenom $nom";
require_once "includes/head.php";
?>

<body>

    <?php require_once "includes/header.php"; ?>
    <div class="container">
        <div style="padding-top:60px;">
            <h2 class="text-center"><?= $pageTitle ?></h2>
        </div>
        <!-- structure proche de la page profil.php -->
        <div id="accordion">
            <div class="card">
                <?php $stmt = getDb()->prepare('select * from infos_perso where idMail=?');
                $stmt->execute(array($idMail));
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
                            <div class="row my-2">
                                <div class="col-sm-2 ">Prénom : </div>
                                <div class="col-sm-10">
                                    <?php echo $prenom; ?>
                                </div>
                            </div>
                            <div class="row my-2">
                                <div class="col-sm-2 ">Nom : </div>
                                <div class="col-sm-10">
                                    <?php echo $nom; ?>
                                </div>
                            </div>
                            <div class="row my-2">
                                <div class=" col-sm-2">Genre : </div>
                                <div class="col-sm-10">
                                    <?php echo $genre ?>
                                </div>
                            </div>
                            <div class="row my-2">
                                <div class="col-sm-2 ">E-mail : </div>
                                <div class="col-sm-10">
                                    <?php if ($_SESSION['type'] == 0 or ($_SESSION['type'] == 1 and $mail[0] != '#')) {
                                        //vérification pour l'affichage des données cachées
                                        echo $mail;
                                    } ?>
                                </div>
                            </div>
                            <div class="row my-2">
                                <div class="col-sm-2 ">Téléphone : </div>
                                <div class="col-sm-10">
                                    <?php if ($_SESSION['type'] == 0 or ($_SESSION['type'] == 1 and $telephone[0] != '#')) {
                                        //vérification pour l'affichage des données cachées
                                        echo $telephone;
                                    } ?>
                                </div>
                            </div>
                            <div class="row my-2">
                                <div class="col-sm-2 ">Ville : </div>
                                <div class="col-sm-10">
                                    <?php if ($_SESSION['type'] == 0 or ($_SESSION['type'] == 1 and $ville[0] != '#')) {
                                        //vérification pour l'affichage des données cachées
                                        echo $ville;
                                    } ?>
                                </div>
                            </div>
                            <div class="row my-2">
                                <div class="col-sm-2 ">Code Postal : </div>
                                <div class="col-sm-10">
                                    <?php if ($_SESSION['type'] == 0 or ($_SESSION['type'] == 1 and $ville[0] != '#')) {
                                        //vérification pour l'affichage des données cachées
                                        echo $cpPerso;
                                    } ?>
                                </div>
                            </div>
                            <div class="row my-2">
                                <div class="col-sm-2 ">Promotion : </div>
                                <div class="col-sm-10">
                                    <?php echo $promotion ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingThree">
                    <h5 class="mb-0 text-center">
                        <button class="col-md-12 btn btn-light collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Formation
                        </button>
                    </h5>
                </div>
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                    <div class="card-body">
                        <?php $forma = getDb()->prepare('select * from formation where idMail=? order by dateDebut desc');
                        $forma->execute(array($idMail));
                        while ($ligne = $forma->fetch()) { ?>
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
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="headingFour">
                <h5 class="mb-0 text-center">
                    <button class="col-md-12 btn btn-light collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                        Expérience professionelle
                    </button>
                </h5>
            </div>
            <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                <div class="card-body">
                    <?php $forma = getDb()->prepare('select * from exp_pro where idMail=? order by dateDebPro desc');
                    $forma->execute(array($idMail));
                    while ($ligne = $forma->fetch()) { ?>
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
                                        Salaire : <?php echo $ligne['salaire'] ?>
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
                                                Fin : <?php echo date('d/m/Y', strtotime($ligne['dateFinPro'])) ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        Description :
                                        <p> <?php echo $ligne['description'] ?> </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php require_once "includes/footer.php"; ?>
    </div>
</body>

</html>