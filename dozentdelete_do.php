<?php

require_once("inc/admin_check.php");
require_once("mapper/dozentManager.php");


$id_dozent =(int)htmlspecialchars($_GET["id_dozent"], ENT_QUOTES, "UTF-8");

$dozentManager = new DozentManager();
$dozent =$dozentManager->findbyId($id_dozent)[0];
$dozentManager->delete($dozent);

header('Location: dozentuebersicht.php');



