<?php
require_once "includes/functions.php";
session_start();

if (!empty($_POST['typeF'])) {
    $typeF = $_POST['typeF'];
    $dateD = $_POST['debut'];
    $dateF = $_POST['fin'];
    $etab = $_POST['etab'];
    $diplome = $_POST['diplome'];
    $ville = $_POST['ville'];
    $CP = $_POST['cp'];

    //création d'unid unique pour la table formation
    $idF = 1;
    $verif_idF = getDb()->prepare('select * from infos_perso where idPerso=?');
    $verif_idF->execute(array($idF));
    while ($verif_idF->rowCount() == 1) {
        $idF++;
        $verif_idF = getDb()->prepare('select * from infos_perso where idPerso=?');
        $verif_idF->execute(array($idF));
    }

    $stmt = getDb()->prepare('INSERT INTO formation(idF,typeF,dateDebut,dateFin,etablissement,diplome,villeF,CPF,idMail) values(:idF,:typeF,:dateDebut,:dateFin,:etablissement,:diplome,:villeF,:CPF,:idMail)');
    $stmt->execute(array(
        ':idF' => $idF,
        ':typeF' => $typeF,
        ':dateDebut' => $dateD,
        ':dateFin' => $dateF,
        ':etablissement' => $etab,
        ':diplome' => $diplome,
        ':villeF' => $ville,
        ':CPF' => $CP,
        ':idMail' => $_SESSION['login'],
    ));
    $chgt = "Formation ajoutée";
}
?>

<!doctype html>
<html>

<?php
$pageTitle = "Ajout d'une formation";
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
        <?php } ?>
            <!-- un form tout à fait classique -->
        <form action="ajoutForma.php" role="form" method="POST">
            <div class="form-group row my-2">
                <label for="typeF" class="col-sm-2 col-form-label">Type de formation : </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="typeF" id="typeF" placeholder='Entrez le type de formation' required autofocus>
                </div>
            </div>
            <div class="form-group row my-2">
                <label for="etab" class="col-sm-2 col-form-label">Etablissement : </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="etab" id="etab" placeholder="Entrez l'établissement de votre formation" required>
                </div>
            </div>
            <div class="form-group row my-2">
                <label for="diplome" class="col-sm-2 col-form-label">Diplôme : </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="diplome" id="diplome" placeholder="Entrez le diplôme de la formation">
                </div>
            </div>
            <div class="form-group row my-2">
                <label for="ville" class="col-sm-2 col-form-label">Ville : </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="ville" id="ville" placeholder="Entrez la ville de la formation" required>
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
                    <input type="date" class="form-control" name="debut" id="debut" placeholder="Date de début de la formation" required>
                </div>
            </div>
            <div class="form-group row my-2">
                <label for="fin" class="col-sm-2 col-form-label">Fin : </label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" name="fin" id="fin" placeholder="Date de fin de la formation" required>
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