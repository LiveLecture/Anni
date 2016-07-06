<?php
	require_once("inc/check_admin.php");

	require_once("Mapper/DozentManager.php");
	require_once("Mapper/VorlesungManager.php");
	require_once("Mapper/VotingManager.php");


	$dozentManager = new DozentManager();
	$liste = $dozentManager->findAll();

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
						<tr>
							<th class="col-sm-2">Dozent-ID</th>
							<th class="col-sm-2">Login</th>
							<th class="col-sm-2">Vorname</th>
							<th class="col-sm-2">Nachname</th>
							<th class="col-sm-2">Anzahl Vorlesungen</th>
							<th class="col-sm-1">Editieren</th>
							<th class="col-sm-1">Löschen</th>
						</tr>
					</thead>

					<tbody>

						<?php
							foreach($liste as $dozent) {
						?>
						<tr>
							<td><?php echo $dozent->id_dozent ?></td>
							<td><?php echo $dozent->login ?></td>
							<td><?php echo $dozent->vorname ?></td>
							<td><?php echo $dozent->nachname ?></td>
							<td><?php echo sizeof($vorlesungManager->findAll($dozent->id_dozent)) ?></td>
							<td>
								<a href='dozentEdit_form.php?id_dozent=<?php echo $dozent->id_dozent ?>'
								   class='glyphicon glyphicon-pencil'></a>
							</td>
							<td>
								<a href='dozentDelete_do.php?id_dozent=<?php echo $dozent->id_dozent ?>'
								   class='glyphicon glyphicon-trash'></a>
							</td>
							<?php
								}
							?>
						</tr>
					</tbody>
				</table>
				<a href="dozentCreate_form.php" class="btn btn-default col-sm-offset-10 col-sm-2">Neuen Dozent
																								  anlegen</a>
			</div>

		</div>

		<?php require_once("inc/footer.php") ?>

	</body>
</html>
