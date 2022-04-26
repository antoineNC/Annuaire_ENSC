<?php
require_once "includes/functions.php";
session_start();

?>

<!DOCTYPE html>
<html>
<?php if ($_SESSION['type'] == 1) { //type élève
    $pageTitle = "Espace élève - Recherche";
} else {
    $pageTitle = "Espace gestionnaire - Recherche";
}
require_once "includes/head.php";
?>

<body>
    <?php require_once "includes/header.php"; ?>
    <div class="container">
        <div style="padding-top:60px;">
            <h2 class="text-center"><?= $pageTitle ?></h2>
        </div>
        </br>
        <!-- PARTIE GESTIONNAIRE : peut tout voir -->
        <?php if ($_SESSION['type'] == 0) { ?>
            <div id="accordion">
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h5 class="mb-0 text-center">
                            <button class="col-md-12 btn btn-light" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Par informations personnelles
                            </button>
                        </h5>
                    </div>
                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                            <!-- table bootstrap -->
                            <table class="table" data-toggle="table" data-search="true" data-show-columns="false" data-pagination="true">
                                <thead>
                                    <tr>
                                        <th data-sortable="true" data-field="nom">Nom</th>
                                        <th data-sortable="true" data-field="prenom">Prénom</th>
                                        <th data-sortable="true" data-field="mail">E-mail</th>
                                        <th data-sortable="true" data-field="tel">Téléphone</th>
                                        <th data-sortable="true" data-field="ville">Ville</th>
                                        <th data-sortable="true" data-field="cp">Code Postal</th>
                                        <th data-sortable="true" data-field="promo">Promotion</th>
                                        <th>Voir profil</th>
                                    </tr>
                                </thead>
                                <tbody text-center>
                                    <?php $search = getDb()->prepare('select * from infos_perso,compte where infos_perso.idMail=compte.idMail and typeC=1');
                                    $search->execute(array());
                                    while ($ligne = $search->fetch()) { ?>
                                        <tr>
                                            <td><?php echo $ligne['nom'] ?></td>
                                            <td><?php echo $ligne['prenom'] ?></td>
                                            <td><?php echo $ligne['mail'] ?></td>
                                            <td><?php echo $ligne['telephone'] ?></td>
                                            <td><?php echo $ligne['ville'] ?></td>
                                            <td><?php echo $ligne['CPPerso'] ?></td>
                                            <td><?php echo $ligne['promotion'] ?></td>
                                            <td class="text-center">
                                                <!-- visualiser un profil entier -->
                                                <form action="eleve.php" role="form" method="get">
                                                    <input id="visu" name="visu" type="hidden" value="<?= $ligne['idMail'] ?>">
                                                    <button type="submit" class="btn btn-outline-secondary"><i class="fas fa-eye"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingTwo">
                        <h5 class="mb-0 text-center">
                            <button class="col-md-12 btn btn-light" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                Par formation
                            </button>
                        </h5>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                        <div class="card-body">
                            <table class="table" data-toggle="table" data-search="true" data-show-columns="false" data-pagination="true">
                                <thead>
                                    <tr>
                                        <th data-sortable="true" data-field="type">Type</th>
                                        <th data-sortable="true" data-field="etab">Etablissement</th>
                                        <th data-sortable="true" data-field="diplome">Diplôme</th>
                                        <th data-sortable="true" data-field="debut">Début</th>
                                        <th data-sortable="true" data-field="fin">Fin</th>
                                        <th data-sortable="true" data-field="ville">Ville</th>
                                        <th data-sortable="true" data-field="cpf">Code Postal</th>
                                        <th>Voir profil</th>
                                    </tr>
                                </thead>
                                <tbody text-center>
                                    <?php $search = getDb()->prepare('select * from formation,compte where formation.idMail=compte.idMail');
                                    $search->execute(array());
                                    while ($ligne = $search->fetch()) { ?>
                                        <tr>
                                            <td><?php echo $ligne['typeF'] ?></td>
                                            <td><?php echo $ligne['etablissement'] ?></td>
                                            <td><?php echo $ligne['diplome'] ?></td>
                                            <td><?php echo date('d/m/Y', strtotime($ligne['dateDebut'])) ?></td>
                                            <td><?php echo date('d/m/Y', strtotime($ligne['dateFin'])) ?></td>
                                            <td><?php echo $ligne['villeF'] ?></td>
                                            <td><?php echo $ligne['CPF'] ?></td>
                                            <td class="text-center">
                                                <!-- visualiser un profil entier -->
                                                <form action="eleve.php" role="form" method="get">
                                                    <input id="visu" name="visu" type="hidden" value="<?= $ligne['idMail'] ?>">
                                                    <button type="submit" class="btn btn-outline-secondary"><i class="fas fa-eye"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingThree">
                        <h5 class="mb-0 text-center">
                            <button class="col-md-12 btn btn-light" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                Par expérience professionnelle
                            </button>
                        </h5>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                        <div class="card-body">
                            <table class="table" data-toggle="table" data-search="true" data-show-columns="false" data-pagination="true">
                                <thead>
                                    <tr>
                                        <th data-sortable="true" data-field="type">Type</th>
                                        <th data-sortable="true" data-field="etab">Organisme</th>
                                        <th data-sortable="true" data-field="secteur">Secteur</th>
                                        <th data-sortable="true" data-field="poste">Poste</th>
                                        <th data-sortable="true" data-field="salaire">Salaire</th>
                                        <th data-sortable="true" data-field="debut">Début</th>
                                        <th data-sortable="true" data-field="fin">Fin</th>
                                        <th data-sortable="true" data-field="ville">Ville</th>
                                        <th data-sortable="true" data-field="cpp">Code Postal</th>
                                        <th>Voir profil</th>
                                    </tr>
                                </thead>
                                <tbody text-center>
                                    <?php $search = getDb()->prepare('select * from exp_pro,compte where exp_pro.idMail=compte.idMail');
                                    $search->execute(array());
                                    while ($ligne = $search->fetch()) { ?>
                                        <tr>
                                            <td><?php echo $ligne['typePro'] ?></td>
                                            <td><?php echo $ligne['organisme'] ?></td>
                                            <td><?php echo $ligne['secteur_act'] ?></td>
                                            <td><?php echo $ligne['poste'] ?></td>
                                            <td><?php echo $ligne['salaire'] ?></td>
                                            <td><?php echo date('d/m/Y', strtotime($ligne['dateDebPro'])) ?></td>
                                            <td><?php if ($ligne['dateFinPro'] != "0000-00-00") {
                                                    echo date('d/m/Y', strtotime($ligne['dateFinPro']));
                                                } ?></td>
                                            <td><?php echo $ligne['villePro'] ?></td>
                                            <td><?php echo $ligne['CPPro'] ?></td>
                                            <td class="text-center">
                                                <!-- visualiser un profil entier -->
                                                <form action="eleve.php" role="form" method="get">
                                                    <input id="visu" name="visu" type="hidden" value="<?= $ligne['idMail'] ?>">
                                                    <button type="submit" class="btn btn-outline-secondary"><i class="fas fa-eye"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- PARTIE ELEVE : ne peut pas tout voir -->
        <?php } else if ($_SESSION['type'] == 1) { ?>
            <div id="accordion">
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h5 class="mb-0 text-center">
                            <button class="col-md-12 btn btn-light" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Par informations personnelles
                            </button>
                        </h5>
                    </div>
                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                            <table class="table" data-toggle="table" data-search="true" data-show-columns="false" data-pagination="true">
                                <thead>
                                    <tr>
                                        <th data-sortable="true" data-field="nom">Nom</th>
                                        <th data-sortable="true" data-field="prenom">Prénom</th>
                                        <th data-sortable="true" data-field="mail">E-mail</th>
                                        <th data-sortable="true" data-field="tel">Téléphone</th>
                                        <th data-sortable="true" data-field="ville">Ville</th>
                                        <th data-sortable="true" data-field="cp">Code Postal</th>
                                        <th data-sortable="true" data-field="promo">Promotion</th>
                                        <th>Voir profil</th>
                                    </tr>
                                </thead>
                                <tbody text-center>
                                    <?php $search = getDb()->prepare('select * from infos_perso,compte where infos_perso.idMail=compte.idMail and typeC=1');
                                    $search->execute(array());
                                    while ($ligne = $search->fetch()) { ?>
                                        <tr>
                                            <td><?php echo $ligne['nom'] ?></td>
                                            <td><?php echo $ligne['prenom'] ?></td>
                                            <td><?php if ($ligne['mail'][0] != '#') { //vérification de la donnée cachée
                                                    echo $ligne['mail'];
                                                } ?></td>
                                            <td><?php if ($ligne['telephone'][0] != '#') { //idem
                                                    echo $ligne['telephone'];
                                                } ?></td>
                                            <td><?php if ($ligne['ville'][0] != '#') { //idem
                                                    echo $ligne['ville'];
                                                } ?></td>
                                            <td><?php if ($ligne['ville'][0] != '#') { //idem (le code postal va de paire avec la ville)
                                                    echo $ligne['CPPerso'];
                                                } ?></td>
                                            <td><?php echo $ligne['promotion'] ?></td>
                                            <td class="text-center">
                                                <!-- visualiser un profil entier -->
                                                <form action="eleve.php" role="form" method="get">
                                                    <input id="visu" name="visu" type="hidden" value="<?= $ligne['idMail'] ?>">
                                                    <button type="submit" class="btn btn-outline-secondary"><i class="fas fa-eye"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingTwo">
                        <h5 class="mb-0 text-center">
                            <button class="col-md-12 btn btn-light" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                Par formation
                            </button>
                        </h5>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                        <div class="card-body">
                            <table class="table" data-toggle="table" data-search="true" data-show-columns="false" data-pagination="true">
                                <thead>
                                    <tr>
                                        <th data-sortable="true" data-field="type">Type</th>
                                        <th data-sortable="true" data-field="etab">Etablissement</th>
                                        <th data-sortable="true" data-field="diplome">Diplôme</th>
                                        <th data-sortable="true" data-field="debut">Début</th>
                                        <th data-sortable="true" data-field="fin">Fin</th>
                                        <th data-sortable="true" data-field="ville">Ville</th>
                                        <th data-sortable="true" data-field="cpf">Code Postal</th>
                                        <th>Voir profil</th>
                                    </tr>
                                </thead>
                                <tbody text-center>
                                    <?php $search = getDb()->prepare('select * from formation,compte where formation.idMail=compte.idMail');
                                    $search->execute(array());
                                    while ($ligne = $search->fetch()) { ?>
                                        <tr>
                                            <td><?php echo $ligne['typeF'] ?></td>
                                            <td><?php echo $ligne['etablissement'] ?></td>
                                            <td><?php echo $ligne['diplome'] ?></td>
                                            <td><?php echo date('d/m/Y', strtotime($ligne['dateDebut'])) ?></td>
                                            <td><?php echo date('d/m/Y', strtotime($ligne['dateFin'])) ?></td>
                                            <td><?php echo $ligne['villeF'] ?></td>
                                            <td><?php echo $ligne['CPF'] ?></td>
                                            <td class="text-center">
                                                <!-- visualiser un profil entier -->
                                                <form action="eleve.php" role="form" method="get">
                                                    <input id="visu" name="visu" type="hidden" value="<?= $ligne['idMail'] ?>">
                                                    <button type="submit" class="btn btn-outline-secondary"><i class="fas fa-eye"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingThree">
                        <h5 class="mb-0 text-center">
                            <button class="col-md-12 btn btn-light" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                Par expérience professionnelle
                            </button>
                        </h5>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                        <div class="card-body">
                            <table class="table" data-toggle="table" data-search="true" data-show-columns="false" data-pagination="true">
                                <thead>
                                    <tr>
                                        <th data-sortable="true" data-field="type">Type</th>
                                        <th data-sortable="true" data-field="etab">Organisme</th>
                                        <th data-sortable="true" data-field="secteur">Secteur</th>
                                        <th data-sortable="true" data-field="poste">Poste</th>
                                        <th data-sortable="true" data-field="salaire">Salaire</th>
                                        <th data-sortable="true" data-field="debut">Début</th>
                                        <th data-sortable="true" data-field="fin">Fin</th>
                                        <th data-sortable="true" data-field="ville">Ville</th>
                                        <th data-sortable="true" data-field="cpp">Code Postal</th>
                                        <th>Voir profil</th>
                                    </tr>
                                </thead>
                                <tbody text-center>
                                    <?php $search = getDb()->prepare('select * from exp_pro,compte where exp_pro.idMail=compte.idMail');
                                    $search->execute(array());
                                    while ($ligne = $search->fetch()) { ?>
                                        <tr>
                                            <td><?php echo $ligne['typePro'] ?></td>
                                            <td><?php echo $ligne['organisme'] ?></td>
                                            <td><?php echo $ligne['secteur_act'] ?></td>
                                            <td><?php echo $ligne['poste'] ?></td>
                                            <td><?php echo $ligne['salaire'] ?></td>
                                            <td><?php echo date('d/m/Y', strtotime($ligne['dateDebPro'])) ?></td>
                                            <td><?php if ($ligne['dateFinPro'] != "0000-00-00") {
                                                    echo date('d/m/Y', strtotime($ligne['dateFinPro']));
                                                } ?></td>
                                            <td><?php echo $ligne['villePro'] ?></td>
                                            <td><?php echo $ligne['CPPro'] ?></td>
                                            <td class="text-center">
                                            <!-- visualiser un profil entier -->
                                                <form action="eleve.php" role="form" method="get">
                                                    <input id="visu" name="visu" type="hidden" value="<?= $ligne['idMail'] ?>">
                                                    <button type="submit" class="btn btn-outline-secondary"><i class="fas fa-eye"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>


</body>

</html>