<?php
require_once "includes/functions.php";
session_start();

//le gestionnaire a appuyé sur accepter l'élève
if (!empty($_POST['idA'])) {
    $idA = $_POST['idA'];
    $stmt = getDb()->prepare('UPDATE compte SET typeC=1 WHERE idMail=?');
    $stmt->execute(array($idA));
}
//le gestionnaire a refusé l'élève
if (!empty($_POST['idR'])) {
    $idR = $_POST['idR'];
    $stmt = getDb()->prepare('DELETE FROM infos_perso WHERE idMail=?');
    $stmt->execute(array($idR));
    $stmt = getDb()->prepare('DELETE FROM compte WHERE idMail=?');
    $stmt->execute(array($idR));
}
?>

<!doctype html>
<html>

<?php
if ($_SESSION['type'] == 1) { //type élève
    $pageTitle = "Espace élève";
} else {
    $pageTitle = "Espace gestionnaire";
}
require_once "includes/head.php";
?>

<body>

    <?php require_once "includes/header.php"; ?>
    <div class="container">
        <div style="padding-top:60px;">
            <h2 class="text-center"><?= $pageTitle ?></h2>
        </div>
        <form class="form-inline my-2 my-lg-0">
            <div class="container-fluid">

                <div class="row">
                    <div class=" col-5">
                        <h5> <strong>Demandes d'inscriptions : </h5> </strong>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-auto">
                    <h6> Veuillez accepter ou refuser les demandes d'inscriptions suivantes : </h6>
                </div>
            </div>
            <?php
            $req = getDb()->prepare('select * from infos_perso,compte where infos_perso.idMail = compte.idMail and typeC=2');
            $req->execute(array());
            while ($ligne = $req->fetch()) { ?>
                <div class="container-fluid mb-3">
                    <div class="row">
                        <div class="offset-md-1 col-md-3">
                                <form action="eleve.php" role="form" method="get">
                                    <input id="visu" name="visu" type="hidden" value="<?= $ligne['idMail'] ?>">
                                    <button class="btn btn-light btn-md" type="submit" for="visu"><?php echo $ligne['prenom'] . " " . $ligne['nom'] ?></button>
                                </form>
                        </div>
                        <div class="col-md-1 left">
                            <form action="site.php" role="form" method="POST">
                                <input id="idA" name="idA" type="hidden" value="<?= $ligne['idMail'] ?>">
                                <button class="btn btn-outline-success btn-sm my-2 my-sm-0" type="submit">Accepter</button>
                            </form>
                        </div>
                        <div class="col-md-1 left">
                            <form action="site.php" role="form" method="POST">
                                <input id="idR" name="idR" type="hidden" value="<?= $ligne['idMail'] ?>">
                                <button class="btn btn-outline-danger btn-sm my-2  my-sm-0" type="submit">Refuser</button>
                            </form>
                        </div>
                        <div class="col-md-6 right"></div>
                    </div>
                </div>
            <?php } ?>
        </form>
        <div class="offset-md-5">
        <!-- pour que le gestionnaire crée un compte élève -->
            <a class="btn btn-outline-info" href="inscription_gest.php" type="submit">Créer un compte</a>
        </div>

        <?php require_once "includes/footer.php"; ?>
    </div>
</body>

</html>