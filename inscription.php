<?php
require_once "includes/functions.php";

//vérification de l'entrée des données obligatoires
if (!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['telephone']) && !empty($_POST['password'])) {
    $lenom = $_POST['nom'];
    $leprenom = $_POST['prenom'];

    //création id unique pour la table infos_perso
    $id = 1;
    $verif_id = getDb()->prepare('select * from infos_perso where idPerso=?');
    $verif_id->execute(array($id));
    while ($verif_id->rowCount() == 1) {
        $id++;
        $verif_id = getDb()->prepare('select * from infos_perso where idPerso=?');
        $verif_id->execute(array($id));
    }

    $legenre = null; //au cas où l'utilisateur n'a pas voulu préciser son genre
    if (!empty($_POST['genre'])) {
        $legenre = $_POST['genre'];
    }

    $mail = $_POST['mail'];
    $letelephone = $_POST['telephone'];
    $laville = $_POST['ville'];
    $lecpPerso = $_POST['cpPerso'];
    $lapromotion = $_POST['promotion'];
    $lemdp = $_POST['password'];

    //création du login de l'utilisateur (format de l'école)
    $prenom = str_replace(' ', '', $leprenom);
    $nom = substr(str_replace(' ', '', $lenom), 0, 10);
    $idMail = strtolower($prenom[0]) . strtolower($nom);
    //rajout d'un chiffre au cas où l'identifiant "pnom" existe déjà
    $verif_idmail = getDb()->prepare('select * from compte where idMail=?');
    $verif_idmail->execute(array($idMail));
    $cpt = 0;
    while ($verif_idmail->rowCount() == 1) {
        $cpt++;
        $verif_idmail = getDb()->prepare('select * from compte where idMail=?');
        $verif_idmail->execute(array($idMail . $cpt));
    }
    if ($cpt > 0) {
        $idMail = $idMail . $cpt;
    }

    //insertion des valeurs entrée par l'utilisateur
    $compte = getDb()->prepare('INSERT into compte (idMail,typeC,mot_de_passe) values (:idMail,:typeC,:mot_de_passe)');
    $compte->execute(array(
        ':idMail' => $idMail,
        ':typeC' => 2, //ce type correspond à un élève dont l'inscription n'est pas validée
        ':mot_de_passe' => $lemdp
    ));
    $info_perso = getDb()->prepare('INSERT into infos_perso (idPerso,nom,prenom,genre,telephone,ville,CPPerso,promotion,idMail,mail) values (:id,:nom,:prenom,:genre,:telephone,:ville,:CPPerso,:promotion,:idMail,:mail)');
    $info_perso->execute(array(
        ':id' => $id,
        ':nom' => $lenom,
        ':prenom' => $leprenom,
        ':genre' => $legenre,
        ':telephone' => $letelephone,
        ':ville' => $laville,
        ':CPPerso' => $lecpPerso,
        ':promotion' => $lapromotion,
        ':idMail' => $idMail,
        ':mail' => $mail,
    ));

    $valide = "Votre inscription a été envoyée, en attente de validation.";
}

?>
<!doctype html>
<html>

<?php
$pageTitle = "Inscription";
require_once "includes/head.php";
?>

<body>
    <?php require_once "includes/header.php"; ?>
    <div class="container">
        <div style="padding-top:60px;">
            <h2 class="text-center"><?= $pageTitle ?></h2>
        </div>

        <?php if (isset($valide)) { ?>
            <div class="alert alert-success">
                <strong>Succès !</strong> <?= $valide ?>
            </div>
            <div class="alert alert-info">
                <strong>Important :</strong> Votre login est <strong><?= $idMail ?></strong>
            </div>
        <?php } ?>

        <div class="container">
            <div class="row text-black">
                <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 mx-auto form p-4">
                    <form class="form-signin form-horizontal" role="form" action="inscription.php" method="POST">
                        <div class="form-group text-center">
                            <label for="nom" style="padding-bottom:5px;">Nom :</label>
                            <input type="text" name="nom" class="form-control mb-2" placeholder="Entrez votre nom" required autofocus>
                        </div>

                        <div class="form-group text-center">
                            <label for="prenom" style="padding-bottom:5px;">Prénom : </label>
                            <input type="text" name="prenom" class="form-control" placeholder="Entrez votre prénom" required>
                        </div><br />

                        <div class="form-group">
                            Cochez votre genre : <br />

                            <input type="radio" name="genre" id="femme" value="Femme" /> Femme <label for="femme"> </label> <br />
                            <input type="radio" name="genre" id="homme" value="Homme" /> Homme <label for="homme"> </label> <br />
                            <input type="radio" name="genre" id="autre" value="Autre" /> Autre <label for="autre"> </label>
                        </div>

                        <div class="form-group text-center">
                            <label for="mail" style="padding-bottom:5px;">E-mail : </label>
                            <input type="email" name="mail" class="form-control mb-2" placeholder="Entrez votre mail" required>
                        </div>

                        <div class="form-group text-center">
                            <label for="telephone" style="padding-bottom:5px;">Téléphone : </label>
                            <input type="tel" pattern="[0-9]{10}" name="telephone" class="form-control mb-2" placeholder="Entrez votre téléphone (10 chiffres)" required>
                        </div>

                        <div class="form-group text-center">
                            <label for="ville" style="padding-bottom:5px;">Ville: </label>
                            <input type="text" name="ville" class="form-control mb-2" placeholder="Entrez votre ville de résidence " required>
                        </div>

                        <div class="form-group text-center">
                            <label for="codepostal" style="padding-bottom:5px;">Code Postal : </label>
                            <input type="text" pattern="[0-9]{5}" name="cpPerso" class="form-control mb-2" placeholder="Entrez le code postal ">
                        </div>

                        <div class="form-group text-center">
                            <label for="promotion" style="padding-bottom:5px;">Promotion : </label>
                            <input type="number" min="2007" max="2023" name="promotion" class="form-control mb-2" placeholder="Entrez la promotion de votre diplôme" required>
                        </div>

                        <div class="form-group text-center">
                            <label for="password" style="padding-bottom:5px;">Mot de passe : </label>
                            <input type="password" name="password" class="form-control mb-2" placeholder="Entrez votre mot de passe" required>
                        </div><br />

                        <div class="form-group row justify-content-center">
                            <button type="submit" class="btn btn-default btn-primary"><span class="glyphicon glyphicon-log-in"></span> S'inscrire</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php require_once "includes/footer.php"; ?>
    </div>

</body>

</html>