<?php
	require_once("inc/check_admin.php");

	require_once("Mapper/AdminManager.php");
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
		if(!password_verify($passwort_alt, $admin->hash)) {
			$errorHandler->storeError("adminprofil", "Das eingegebene Passwort ist falsch.");
			header("Location: adminProfil_form.php");
			exit();
		}

		if($passwort_neu <> $passwort_wiederholt) {
			$errorHandler->storeError("adminprofil", "Die beiden neuen Passwörter stimmen nicht überein.");
			header("Location: adminProfil_form.php");
			exit();
		}

		$adminManager = new AdminManager();
		$admin->hash = $adminManager->updatePasswort($admin->id_admin, $passwort_neu);
		$_SESSION["admin"] = $admin;

		header("Location: dozentUebersicht.php");
	} else {
		$errorHandler->storeError("adminprofil", "Sie müssen alle Felder ausfüllen.");
		header("Location: adminProfil_form.php");
		exit();
	}
?>