<?php
require_once("inc/admin_check.php");

require_once("mapper/dozentManager.php");
require_once("mapper/vorlesungManager.php");
require_once("mapper/votingManager.php");


$dozentManager = new DozentManager();
$liste = $dozentManager->findallDozent();

$vorlesungManager = new VorlesungManager();
$votingManager = new VotingManager();

?>

<!DOCTYPE html>
<html>

<?php include("inc/head.php"); ?>

<body>

<?php include("inc/navbar_loggedin_admin.php"); ?>

<div class="container panel hauptbereich seite-fuellen">

    <h1 class="page-header">Dozenten</h1>

    <div class="panel-body">


        <table class="table table-hover table-inhalt-mittig">
            <thead>
            <th>Dozent-ID</th>
            <th>Vorname</th>
            <th>Nachname</th>
            <th>Anzahl Vorlesungen</th>
            <th>Löschen</th>
            </thead>

            <tbody>

            <?php
            foreach ($liste as $dozent) {
                echo "<tr>";
                echo "<td>$dozent->id_dozent</td>";
                echo "<td>$dozent->vorname</td>";
                echo "<td>$dozent->nachname</td>";
                echo "<td>" . sizeof($vorlesungManager->findAll($dozent->id_dozent)) . "</td>";
                echo "<td>
                    <a href='dozentdelete_do.php?id_dozent=$dozent->id_dozent' class='glyphicon glyphicon-trash'></a>
                 </td>";
            }
            ?>
            </tbody>
        </table>
        <a href="dozentcreate_form.php" class="btn btn-default col-sm-offset-10 col-sm-2">Neuen Dozent anlegen</a>
    </div>

</div>

<?php require_once("inc/footer.php") ?>

</body>
</html>
