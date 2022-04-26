<?php
require_once "includes/functions.php";
session_start();
$chgt = "";
$error = "";

//vérification de chaque input

if (!empty($_POST['typePro'])) {
    $modif = $_POST['typePro'];
    $stmt = getDb()->prepare('UPDATE exp_pro SET typePro=? WHERE idPro=?');
    $stmt->execute(array($modif, $_POST['idPro']));
    $chgt = "Modification(s) enregistrée(s)";
}
if (!empty($_POST['orga'])) {
    $modif = $_POST['orga'];
    $stmt = getDb()->prepare('UPDATE exp_pro SET organisme=? WHERE idPro=?');
    $stmt->execute(array($modif, $_POST['idPro']));
    $chgt = "Modification(s) enregistrée(s)";
}
if (!empty($_POST['secteur'])) {
    $modif = $_POST['secteur'];
    $stmt = getDb()->prepare('UPDATE exp_pro SET secteur_act=? WHERE idPro=?');
    $stmt->execute(array($modif, $_POST['idPro']));
    $chgt = "Modification(s) enregistrée(s)";
}
if (!empty($_POST['poste'])) {
    $modif = $_POST['poste'];
    $stmt = getDb()->prepare('UPDATE exp_pro SET poste=? WHERE idPro=?');
    $stmt->execute(array($modif, $_POST['idPro']));
    $chgt = "Modification(s) enregistrée(s)";
}
if (!empty($_POST['salaire'])) {
    $modif = $_POST['salaire'];
    $stmt = getDb()->prepare('UPDATE exp_pro SET salaire_act=? WHERE idPro=?');
    $stmt->execute(array($modif, $_POST['idPro']));
    $chgt = "Modification(s) enregistrée(s)";
}
if (!empty($_POST['ville'])) {
    $modif = $_POST['ville'];
    $stmt = getDb()->prepare('UPDATE exp_pro SET villePro=? WHERE idPro=?');
    $stmt->execute(array($modif, $_POST['idPro']));
    $chgt = "Modification(s) enregistrée(s)";
}
if (!empty($_POST['cp'])) {
    $modif = $_POST['cp'];
    $stmt = getDb()->prepare('UPDATE exp_pro SET CPPro=? WHERE idPro=?');
    $stmt->execute(array($modif, $_POST['idPro']));
    $chgt = "Modification(s) enregistrée(s)";
}
if (!empty($_POST['debut'])) {
    $modif = $_POST['debut'];
    $stmt = getDb()->prepare('UPDATE exp_pro SET dateDebPro=? WHERE idPro=?');
    $stmt->execute(array($modif, $_POST['idPro']));
    $chgt = "Modification(s) enregistrée(s)";
}


if (!empty($_POST['fin'])) {
    if (!empty($_POST['actuel'] or $ligne['actiActuel'] == 0)) { //si l'utilisateur a coché la case ou si la case avait déjà été cochée
        $error = "Vous devez indiquer une date de fin OU préciser que c'est votre activité actuelle.";
    } else {
        $modif = $_POST['fin'];
        $stmt = getDb()->prepare('UPDATE exp_pro SET dateFinPro=? WHERE idPro=?');
        $stmt->execute(array($modif, $_POST['idPro']));
        $chgt = "Modification(s) enregistrée(s)";
    }
}
if (empty($_POST['actuel'])) { //l'utilisateur ne peut pas changer une activité en "actuelle", uniquement l'inverse
    $actu = getDb()->prepare('select * from exp_pro WHERE idPro=?');
    $actu->execute(array($_POST['idPro']));
    $ligne = $actu->fetch();
    if ($ligne['dateFinPro'] == '0000-00-00') { //date non indiquée
        $error = "Vous devez indiquer une date de fin OU préciser que c'est votre activité actuelle.";
    } else {
        if ($ligne['actiActuel'] == 0) { //cette condition ne sert qu'à afficher le message de modification le cas échéant
            $modif = 1;
            $stmt = getDb()->prepare('UPDATE exp_pro SET actiActuel=? WHERE idPro=?');
            $stmt->execute(array($modif, $_POST['idPro']));
            $chgt = "Modification(s) enregistrée(s)";
        }
    }
}
if (!empty($_POST['descri'])) {
    $modif = $_POST['descri'];
    $stmt = getDb()->prepare('UPDATE exp_pro SET description=? WHERE idPro=?');
    $stmt->execute(array($modif, $_POST['idPro']));
    $chgt = "Modification(s) enregistrée(s)";
}


?>

<!doctype html>
<html>

<?php
$pageTitle = "Modification d'une expérience professionnelle";
require_once "includes/head.php";
?>

<body>

    <?php require_once "includes/header.php"; ?>
    <div class="container">
        <div style="padding-top:60px;">
            <h2 class="text-center"><?= $pageTitle ?></h2>
        </div>
    </div>

    <?php if ($chgt != "") { ?>
        <div class="alert alert-success">
            <strong>Succès !</strong> <?= $chgt ?>
        </div>
    <?php }
    if ($error != "") { ?>
        <div class="alert alert-secondary">
            <strong>Attention !</strong> <?= $error ?>
        </div>
    <?php } ?>

    <div class="container">
        <div class="row justify-content-center">
            <?php $stmt = getDb()->prepare('select * from exp_pro where idPro=?');
            $stmt->execute(array($_POST['idPro']));
            $ligne = $stmt->fetch(); ?>
            <form action="modifExp.php" role="form" method="POST">
                <div class="form-group row my-2">
                    <label for="typePro" class="col-sm-2 col-form-label">Type de d'activité : </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="typePro" id="typePro" placeholder=<?php echo $ligne['typePro'] ?>>
                    </div>
                </div>
                <div class="form-group row my-2">
                    <label for="orga" class="col-sm-2 col-form-label">Organisme : </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="orga" id="orga" placeholder=<?php echo $ligne['organisme']; ?>>
                    </div>
                </div>
                <div class="form-group row my-2">
                    <label for="secteur" class="col-sm-2 col-form-label">Secteur d'activité : </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="secteur" id="secteur" placeholder=<?php echo $ligne['secteur_act'] ?>>
                    </div>
                </div>
                <div class="form-group row my-2">
                    <label for="poste" class="col-sm-2 col-form-label">Poste : </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="poste" id="poste" placeholder=<?php echo $ligne['poste'] ?>>
                    </div>
                </div>
                <div class="form-group row my-2">
                    <label for="salaire" class="col-sm-2 col-form-label">Salaire : (en euros)</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="salaire" id="salaire" placeholder=<?php echo $ligne['salaire'] . ' euros' ?>>
                    </div>
                </div>
                <div class="form-group row my-2">
                    <label for="ville" class="col-sm-2 col-form-label">Ville : </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="ville" id="ville" placeholder=<?php echo $ligne['villePro'] ?>>
                    </div>
                </div>
                <div class="form-group row my-2">
                    <label for="cp" class="col-sm-2 col-form-label">Code Postal : </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="cp" id="cp" placeholder=<?php echo $ligne['CPPro'] ?>>
                    </div>
                </div>
                <div class="form-group row my-2">
                    <label for="debut" class="col-sm-2 col-form-label">Date de début : <?php echo date('d/m/Y', strtotime($ligne['dateDebPro'])) ?></label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" name="debut" id="debut">
                    </div>
                </div>
                <div class="form-group row my-2">
                    <label for="fin" class="col-sm-2 col-form-label">Date de fin : <?php if ($ligne['dateFinPro'] != "0000-00-00") {
                                                                                        echo date('d/m/Y', strtotime($ligne['dateFinPro']));
                                                                                    } ?></label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" name="fin" id="fin">
                    </div>
                </div>
                <div class="form-group row my-2">
                    <label class="col-sm-2 col-form-label" for="actuel">Activité actuelle : </label>
                    <div class="col-sm-10 align-items-center">
                        <?php if ($ligne['actiActuel']) { ?>
                            <input class="form-check-input mx-1 my-2" type="checkbox" id="actuel" name="actuel">
                        <?php } else { ?>
                            <input class="form-check-input mx-1 my-2" type="checkbox" id="actuel" name="actuel" checked>
                        <?php } ?>
                    </div>
                </div>
                <div class="form-group row my-2">
                    <label for="descri" class="col-sm-2 col-form-label">Description : </label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="descri" name="descri" rows="3" placeholder=><?php echo $ligne['description'] ?></textarea>
                    </div>
                </div>
                <div class="form-group row justify-content-center">
                    <div class="col-sm-10 text-center">
                        <button type="reset" class=" col-md-3 btn btn-outline-primary">Effacer</button>
                        <input id="idPro" name="idPro" type="hidden" value="<?= $ligne['idPro'] ?>">
                        <button type="submit" class=" col-md-3 btn btn-primary">Enregistrer</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php require_once "includes/footer.php"; ?>
</body>

</html>