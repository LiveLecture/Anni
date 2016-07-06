<?php
	require_once("inc/check_dozent.php");
	require_once("Mapper/DozentManager.php");

	require_once("Mapper/ErrorHandler.php");
	$errorHandler = new ErrorHandler();

	if(!isset($_POST["passwort_alt"]) || !isset($_POST["passwort_neu"]) || !isset($_POST["passwort_wiederholt"])) {
		$errorHandler->storeError("fehler", "Es wurden nicht alle POST Felder angegeben. Bitte wenden Sie sich an den Administrator.");
		header("Location: fehler.php");
		exit();
	}

	$passwort_alt = htmlspecialchars($_POST["passwort_alt"], ENT_QUOTES, "UTF-8");
	$passwort_neu = htmlspecialchars($_POST["passwort_neu"], ENT_QUOTES, "UTF-8");
	$passwort_wiederholt = htmlspecialchars($_POST["passwort_wiederholt"], ENT_QUOTES, "UTF-8");

	if(!empty($passwort_neu) && !empty($passwort_alt) && !empty($passwort_wiederholt)) {
		if(!password_verify($passwort_alt, $dozent->hash)) {
			$errorHandler->storeError("dozentprofil", "Das eingegebene Passwort ist falsch.");
			header("Location: dozentProfil_form.php");
			exit();
		}

		if($passwort_neu <> $passwort_wiederholt) {
			$errorHandler->storeError("dozentprofil", "Die beiden neuen Passwörter stimmen nicht überein.");
			header("Location: dozentProfil_form.php");
			exit();
		}

		$dozentManager = new DozentManager();
		$dozent->hash = $dozentManager->updatePasswort($dozent->id_dozent, $passwort_neu);
		$_SESSION["dozent"] = $dozent;

		header("Location: vorlesungsUebersicht.php");
	} else {
		$errorHandler->storeError("dozentprofil", "Sie müssen alle Felder ausfüllen.");
		header("Location: dozentProfil_form.php");
		exit();
	}
?>