<!doctype html>
<html>

<?php
$pageTitle = "Bienvenue sur l'annuaire des ancien.ne.s élèves de l'ENSC !";
require_once "includes/head.php";
?>

<body>

    <?php require_once "includes/header.php"; //navbar ?>

    <div class="container">

        <div style="padding-top:60px;">
            <h2 class="text-center"><?= $pageTitle ?></h2>
        </div>

        <p align="center">
            <img src="images/beaupatio1.jpg" alt="beaupatio" height="70%" width="..." class="m-5"/>
        </p>

        <div class="row mb-3">
            <div class="col-5">
                <h4><strong> Quel est le but de cet annuaire ? </strong></h4>
            </div>
            <div class="col-4">
                <h4> <strong> Comment ça marche ? </h4> </strong>
            </div>
            <div class="col-3">
                <h4><strong> Des questions ? </strong></h4>
            </div>
        </div>

        <div class="row">
            <div class="col-4 md-2">
                <h5>
                    <ul>
                        <li> Créer un espace dedié exclusivement aux anciens et aux anciennes de l'ENSC </li> </br>
                        <li> Faciliter la recherche de stage et/ou d'emploi </li>
                </h5>
                </ul>
            </div>
            <div class="col-4">
                <h5>
                    <ul>
                        <li> Inscris-toi en remplissant le formulaire</li> </br>
                        <li> Attends la confirmation d'un.e de nos gestionnaires </li> </br>
                        <li> Une fois connecté.e, tu pourras nourrir ton profil avec tes informations et checker les profils des autres ancien.ne.s ! </li>
                </h5>
                </ul>
            </div>
            <div class="col-4">
                <h5> Hésite pas à nous contacter si tu retrouves des problèmes ou si tu as des doutes ! </br> </br>
                    <a href="mailto:ashernandez@ensc.fr"> ashernandez@ensc.fr </a></br>
                    </br> <a href="mailto:aneyracontr@ensc.fr"> aneyracontr@ensc.fr </a>
                </h5>
            </div>
        </div>
    </div>
    <?php require_once "includes/footer.php"; //pied de page ?>
</body>

</html>