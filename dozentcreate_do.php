<?php
require_once "inc/admin_check.php";

require_once("mapper/dozentManager.php");
require_once("mapper/dozent.php");

$login = htmlspecialchars($_POST["login"], ENT_QUOTES, "UTF-8");
$vorname = htmlspecialchars($_POST["vorname"], ENT_QUOTES, "UTF-8");
$nachname = htmlspecialchars($_POST["nachname"], ENT_QUOTES, "UTF-8");
$hash = htmlspecialchars($_POST["hash"], ENT_QUOTES, "UTF-8");

if (!empty ($login) && !empty($vorname) && !empty($nachname) && !empty($hash)) {
    $dozentdaten = [
        "id_dozent" => $id_dozent,
        "login" => $login,
        "vorname" => $vorname,
        "nachname" => $nachname,
        "hash" => $hash,
    ];

    $dozent = new Dozent($dozentdaten);

    $dozentManager = new DozentManager();
    $dozentManager->create($dozent);

    header('Location: dozentuebersicht.php');
} else {
    echo "Error: Bitte alle Felder ausfüllen!<br/>";
}

