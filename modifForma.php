<?php
require_once "includes/functions.php";
session_start();

//vérifiaction de chaque input
if (!empty($_POST['typeF'])) {
    $modif = $_POST['typeF'];
    $stmt = getDb()->prepare('UPDATE formation SET typeF=? WHERE idF=?');
    $stmt->execute(array($modif, $_POST['idF']));
    $chgt = "Modification(s) enregistrée(s)";
}
if (!empty($_POST['etab'])) {
    $modif = $_POST['etab'];
    $stmt = getDb()->prepare('UPDATE formation SET etbalissement=? WHERE idF=?');
    $stmt->execute(array($modif, $_POST['idF']));
    $chgt = "Modification(s) enregistrée(s)";
}
if (!empty($_POST['diplome'])) {
    $modif = $_POST['diplome'];
    $stmt = getDb()->prepare('UPDATE formation SET diplome=? WHERE idF=?');
    $stmt->execute(array($modif, $_POST['idF']));
    $chgt = "Modification(s) enregistrée(s)";
}
if (!empty($_POST['ville'])) {
    $modif = $_POST['ville'];
    $stmt = getDb()->prepare('UPDATE formation SET villeF=? WHERE idF=?');
    $stmt->execute(array($modif, $_POST['idF']));
    $chgt = "Modification(s) enregistrée(s)";
}
if (!empty($_POST['cp'])) {
    $modif = $_POST['cp'];
    $stmt = getDb()->prepare('UPDATE formation SET CPF=? WHERE idF=?');
    $stmt->execute(array($modif, $_POST['idF']));
    $chgt = "Modification(s) enregistrée(s)";
}
if (!empty($_POST['debut'])) {
    $modif = $_POST['debut'];
    $stmt = getDb()->prepare('UPDATE formation SET dateDebut=? WHERE idF=?');
    $stmt->execute(array($modif, $_POST['idF']));
    $chgt = "Modification(s) enregistrée(s)";
}
if (!empty($_POST['fin'])) {
    $modif = $_POST['fin'];
    $stmt = getDb()->prepare('UPDATE formation SET dateFin=? WHERE idF=?');
    $stmt->execute(array($modif, $_POST['idF']));
    $chgt = "Modification(s) enregistrée(s)";
}

?>

<!doctype html>
<html>

<?php
$pageTitle = "Modification d'une formation";
require_once "includes/head.php";
?>

<body>

    <?php require_once "includes/header.php"; ?>
    <div class="container">
        <div style="padding-top:60px;">
            <h2 class="text-center"><?= $pageTitle ?></h2>
        </div>
    </div>

    <?php if (isset($chgt)) { ?>
        <div class="alert alert-success">
            <strong>Succès !</strong> <?= $chgt ?>
        </div>
    <?php } ?>


    <div class="container">
        <div class="row justify-content-center">
            <?php $stmt = getDb()->prepare('select * from formation where idF=?');
            $stmt->execute(array($_POST['idF']));
            $ligne = $stmt->fetch(); ?>
            <!-- form classique avec les données actuelles en placholder -->
            <form action="modifForma.php" role="form" method="POST">
                <div class="form-group row my-2">
                    <label for="typeF" class="col-sm-2 col-form-label">Type de formation : </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="typeF" id="typeF" placeholder=<?php echo $ligne['typeF']?>>
                    </div>
                </div>
                <div class="form-group row my-2">
                    <label for="etab" class="col-sm-2 col-form-label">Etablissement : </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="etab" id="etab" placeholder=<?php echo $ligne['etablissement'] ?>>
                    </div>
                </div>
                <div class="form-group row my-2">
                    <label for="diplome" class="col-sm-2 col-form-label">Diplôme : </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="diplome" id="diplome" placeholder=<?php echo $ligne['diplome'] ?>>
                    </div>
                </div>
                <div class="form-group row my-2">
                    <label for="ville" class="col-sm-2 col-form-label">Ville : </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="ville" id="ville" placeholder=<?php echo $ligne['villeF'] ?>>
                    </div>
                </div>
                <div class="form-group row my-2">
                    <label for="cp" class="col-sm-2 col-form-label">Code Postal : </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="cp" id="cp" placeholder=<?php echo $ligne['CPF'] ?>>
                    </div>
                </div>
                <div class="form-group row my-2">
                    <label for="debut" class="col-sm-2 col-form-label">Date de début : <?php echo date('d/m/Y', strtotime($ligne['dateDebut'])) ?></label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" name="debut" id="debut">
                    </div>
                </div>
                <div class="form-group row my-2">
                    <label for="fin" class="col-sm-2 col-form-label">Date de fin : <?php echo date('d/m/Y', strtotime($ligne['dateFin'])) ?></label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" name="fin" id="fin">
                    </div>
                </div>
                <div class="form-group row justify-content-center">
                    <div class="col-sm-10 text-center">
                        <button type="reset" class=" col-md-3 btn btn-outline-primary">Effacer</button>
                        <input id="idF" name="idF" type="hidden" value="<?= $ligne['idF'] ?>">
                        <button type="submit" class=" col-md-3 btn btn-primary">Enregistrer</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php require_once "includes/footer.php"; ?>
</body>

</html>