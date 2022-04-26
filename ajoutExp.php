<?php
require_once "includes/functions.php";
session_start();

if ((empty($_POST['actuel']) and empty($_POST['fin'])) or (!empty($_POST['actuel']) and !empty($_POST['fin']))) {
    //on ne peut pas choisir une date de fin et indiquer c'est une activité actuelle en même temps
    $error = "Vous devez indiquer une date de fin ou bien préciser que c'est votre activité actuelle.";
} else {

    $typeP = $_POST['typePro'];
    $dateD = $_POST['debut'];
    $dateF = $_POST['fin'];
    $orga = $_POST['orga'];
    $secteur = $_POST['secteur'];
    $ville = $_POST['ville'];
    $CP = $_POST['cp'];
    $poste = $_POST['poste'];
    $salaire = $_POST['salaire'];
    $actuel = $_POST['actuel'];
    $descri = $_POST['descri'];

    //création d'un identifiant unique pour la table exp_pro
    $idPro = 1;
    $verif_idPro = getDb()->prepare('select * from exp_pro where idPro=?');
    $verif_idPro->execute(array($idPro));
    while ($verif_idPro->rowCount() == 1) {
        $idPro++;
        $verif_idPro = getDb()->prepare('select * from exp_pro where idPro=?');
        $verif_idPro->execute(array($idPro));
    }

    $stmt = getDb()->prepare('INSERT INTO exp_pro(idPro,dateDebPro,dateFinPro,villePro,CPPro,typePro,salaire,description,secteur_act,organisme,poste,actiActuel,idMail) values(:idPro,:debut,:fin,:ville,:cp,:typePro,:salaire,:descri,:secteur,:orga,:poste,:actuel,:idMail)');
    $stmt->execute(array(
        ':idPro'=>$idPro,
        ':debut'=>$dateD,
        ':fin'=>$dateF,
        ':ville'=>$ville,
        ':cp'=>$CP,
        ':typePro'=>$typeP,
        ':salaire'=>$salaire,
        ':descri'=>$descri,
        ':secteur'=>$secteur,
        ':orga'=>$orga,
        ':poste'=>$poste,
        ':actuel'=>$actuel,
        ':idMail'=>$_SESSION['login'],
    ));
    $chgt = "Expérience professionelle ajoutée";
}
?>

<!doctype html>
<html>

<?php
$pageTitle = "Ajout d'une Expérience professionnelle";
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
            </div>
        <?php }
        if (isset($error)) { ?>
            <div class="alert alert-secondary">
                <strong>Attention !</strong> <?= $error ?>
            </div>
        <?php } ?>
        <!-- form des plus classique -->
        <form action="ajoutExp.php" role="form" method="POST">
            <div class="form-group row my-2">
                <label for="typePro" class="col-sm-2 col-form-label">Type d'expérience : </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="typePro" id="typePro" placeholder="Entrez le type d'expérience" required autofocus>
                </div>
            </div>
            <div class="form-group row my-2">
                <label for="orga" class="col-sm-2 col-form-label">Organisme : </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="orga" id="orga" placeholder="Entrez le nom de l'organisme" required>
                </div>
            </div>
            <div class="form-group row my-2">
                <label for="secteur" class="col-sm-2 col-form-label">Secteur d'activité : </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="secteur" id="secteur" placeholder="Entrez le secteur d'activité">
                </div>
            </div>
            <div class="form-group row my-2">
                <label for="poste" class="col-sm-2 col-form-label">Poste : </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="poste" id="poste" placeholder="Entrez le poste occupé">
                </div>
            </div>
            <div class="form-group row my-2">
                <label for="Salaire" class="col-sm-2 col-form-label">Revenu : (en euros)</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="salaire" id="salaire" placeholder="Entrez le revenu perçu">
                </div>
            </div>
            <div class="form-group row my-2">
                <label for="ville" class="col-sm-2 col-form-label">Ville : </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="ville" id="ville" placeholder="Entrez la ville" required>
                </div>
            </div>
            <div class="form-group row my-2">
                <label for="CP" class="col-sm-2 col-form-label">Code postal : </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="cp" id="CP" placeholder="Entrez le code postal de la ville">
                </div>
            </div>
            <div class="form-group row my-2">
                <label for="debut" class="col-sm-2 col-form-label">Début : </label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" name="debut" id="debut" placeholder="Date de début" required>
                </div>
            </div>
            <div class="form-group row my-2">
                <label for="fin" class="col-sm-2 col-form-label">Fin : </label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" name="fin" id="fin" placeholder="Date de fin">
                </div>
            </div>
            <div class="form-group row my-2 align-items-center">
                <label class="col-sm-2 col-form-label" for="actuel">Activité actuelle : </label>
                <div class="col-sm-10">
                    <input class="form-check-input" type="checkbox" id="actuel" name="actuel">
                </div>
            </div>
            <div class="form-group row my-2">
                <label for="descri" class="col-sm-2 col-form-label">Description : </label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="descri" name="descri" rows="3"></textarea>
                </div>
            </div>
            <div class="form-group row justify-content-center">
                <div class="col-sm-10 text-center">
                    <button type="submit" class=" col-md-3 btn btn-primary">Enregistrer</button>
                </div>
            </div>
        </form>
    </div>
    <?php require_once "includes/footer.php"; ?>
</body>

</html>