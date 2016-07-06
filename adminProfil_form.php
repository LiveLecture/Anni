<?php

	require_once("inc/check_admin.php");
	require_once("Mapper/ErrorHandler.php");

	$errorHandler = new ErrorHandler();
	$error = $errorHandler->getError("adminprofil");
?>

<!DOCTYPE html>
<html>

	<?php include("inc/head.php"); ?>

	<body>

		<?php include("inc/navbar_loggedin_admin.php"); ?>

		<?php include("inc/fehlermeldung.php"); ?>

		<div class="container panel hauptbereich">
			<h1 class="panel-heading text-center">
				Mein Profil
			</h1>
			<form class="panel-body form-horizontal" role="form" action="adminProfil_do.php" method="post">

				<div class="form-group">
					<label class="control-label col-sm-3" for="login">Passwort alt:</label>
					<div class="col-sm-6">
						<input type="password" name="passwort_alt" class="form-control"
							   placeholder="Altes Passwort">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3" for="login">Passwort neu:</label>
					<div class="col-sm-6">
						<input type="password" name="passwort_neu" class="form-control"
							   placeholder="Neues Passwort">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3" for="login">Passwort bestätigen:</label>
					<div class="col-sm-6">
						<input type="password" name="passwort_wiederholt" class="form-control"
							   placeholder="Wiederholtes Passwort">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-8 col-sm-2">
						<button type="submit" class="btn btn-default">Ändern</button>
					</div>
				</div>

			</form>

		</div>

		<?php include("inc/footer.php") ?>
	</body>
</html>