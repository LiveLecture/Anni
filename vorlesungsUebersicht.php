<?php
	require_once("inc/check_dozent.php");

	require_once("Mapper/DozentManager.php");
	require_once("Mapper/VorlesungManager.php");

	$vorlesungManager = new VorlesungManager();
	$liste = $vorlesungManager->findAll($dozent->id_dozent);
?>

<!DOCTYPE html>
<html>

	<?php include("inc/head.php"); ?>

	<body>

		<?php include("inc/navbar_loggedin_dozent.php"); ?>

		<div class="container panel hauptbereich seite-fuellen">

			<h1 class="panel-heading">Vorlesungsverzeichnis</h1>
			<div class="panel-body">
				<table class="table table-hover table-inhalt-mittig">
					<thead>
						<tr>
							<th class="col-sm-2">Kursnummer</th>
							<th class="col-sm-2">Name</th>
							<th class="col-sm-2">Studiengang</th>
							<th class="col-sm-2">Semester</th>
							<th class="col-sm-2">ECTS</th>
							<th class="col-sm-1">Editieren</th>
							<th class="col-sm-1">Löschen</th>
						</tr>
					</thead>

					<tbody>

						<?php
							foreach($liste as $vorlesung) {
								?>
								<tr>
									<td>
										<a href='votingUebersicht.php?kursnummer=<?php echo $vorlesung->kursnummer ?>'
										   class='btn btn-xs btn-default'><?php echo $vorlesung->kursnummer ?></a>&nbsp;
									</td>
									<td title="<?php echo $vorlesung->name ?>"><?php echo $vorlesung->name ?></td>
									<td><?php echo $vorlesung->studiengang ?></td>
									<td><?php echo $vorlesung->semester ?></td>
									<td><?php echo $vorlesung->ects ?> </td>
									<td>
										<a href='vorlesungEdit_form.php?kursnummer=<?php echo $vorlesung->kursnummer ?>'
										   class='glyphicon glyphicon-pencil'></a>
									</td>
									<td class="col-sm-1">
										<a href='vorlesungDelete_do.php?kursnummer=<?php echo $vorlesung->kursnummer ?>'
										   class='glyphicon glyphicon-trash'></a>
									</td>
								</tr>
								<?php
							}
						?>
					</tbody>
				</table>
				<a href="vorlesungCreate_form.php" class="btn btn-default col-sm-offset-10 col-sm-2">neue Vorlesung</a>
			</div>
		</div>

		<?php include('inc/footer.php') ?>

	</body>
</html>
