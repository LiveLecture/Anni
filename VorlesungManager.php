<?php

	require_once("Mapper/DataManager.php");
	require_once("Mapper/VotingManager.php");

	require_once("Mapper/Vorlesung.php");
	require_once("Mapper/Dozent.php");

	class VorlesungManager extends DataManager {

		public function __construct($connection = null) {
			parent::__construct($connection);
		}

		public function __destruct() {
			parent::__destruct();
		}

		public function findBykursnummer($kursnummer) {
			try {
				$stmt = $this->pdo->prepare('SELECT * FROM Vorlesung WHERE kursnummer = :kursnummer');
				$stmt->bindParam(':kursnummer', $kursnummer);
				$stmt->execute();
				$stmt->setFetchMode(PDO::FETCH_CLASS, 'Vorlesung');

				$vorlesung = $stmt->fetch();
				return $vorlesung;
			} catch(PDOException $e) {
				echo("Fehler! Bitten wenden Sie sich an den Administrator...<br>" . $e->getMessage() . "<br>");
				die();
			}
		}


		public function findAll($id_dozent) {
			try {
				$stmt = $this->pdo->prepare('SELECT * FROM Vorlesung WHERE id_dozent = :dozent');
				$stmt->bindParam(':dozent', $id_dozent);
				$stmt->execute();
				$stmt->setFetchMode(PDO::FETCH_CLASS, 'Vorlesung');

				$result = $stmt->fetchAll();
				return $result;
			} catch(PDOException $e) {
				echo("Fehler! Bitten wenden Sie sich an den Administrator...<br>" . $e->getMessage() . "<br>");
				die();
			}

		}

		public function show($id_dozent) {
			try {
				$stmt = $this->pdo->prepare('SELECT kursnummer,name FROM Vorlesung WHERE id_dozent = :dozent');
				$stmt->bindParam(':dozent', $id_dozent);
				$stmt->execute();
				$stmt->setFetchMode(PDO::FETCH_CLASS, 'Vorlesung');

				$result = $stmt->fetch();
				return $result;
			} catch(PDOException $e) {
				echo("Fehler! Bitte wenden Sie sich an den Administrator...<br>" . $e->getMessage() . "<br>");
				die ();
			}
		}

		public function create(Vorlesung $vorlesung) {
			try {
				$stmt = $this->pdo->prepare('
              INSERT INTO Vorlesung (id_dozent, name, kursnummer, studiengang, ects, semester)
              VALUES (:id_dozent, :name, :kursnummer, :studiengang, :ects, :semester)
            ');

				$stmt->bindParam(':id_dozent', $vorlesung->id_dozent);
				$stmt->bindParam(':kursnummer', $vorlesung->kursnummer);
				$stmt->bindParam(':name', $vorlesung->name);
				$stmt->bindParam(':studiengang', $vorlesung->studiengang);
				$stmt->bindParam(':semester', $vorlesung->semester);
				$stmt->bindParam(':ects', $vorlesung->ects);

				$result = $stmt->execute();
				return $result;
			} catch(PDOException $e) {
				echo("Fehler! Bitten wenden Sie sich an den Administrator...<br>" . $e->getMessage() . "<br>");
				die();
			}
		}

		public function update(Vorlesung $vorlesung) {
			try {
				$stmt = $this->pdo->prepare('
              UPDATE Vorlesung
              SET name = :name,
                  studiengang = :studiengang,
                  semester = :semester,
                  ects= :ects
              WHERE kursnummer = :kursnummer
            ');
				$stmt->bindParam(':kursnummer', $vorlesung->kursnummer);
				$stmt->bindParam(':name', $vorlesung->name);
				$stmt->bindParam(':studiengang', $vorlesung->studiengang);
				$stmt->bindParam(':semester', $vorlesung->semester);
				$stmt->bindParam(':ects', $vorlesung->ects);
				$stmt->execute();
			} catch(PDOException $e) {
				echo("Fehler! Bitten wenden Sie sich an den Administrator...<br>" . $e->getMessage() . "<br>");
				die();
			}
		}

		public function delete(Vorlesung $vorlesung) {
			if($vorlesung == null) return;

			$votingManager = new VotingManager();
			$votings = $votingManager->findAll($vorlesung->kursnummer);
			foreach($votings as $voting) {
				$votingManager->delete($voting);
			}

			try {
				$stmt = $this->pdo->prepare('
              DELETE FROM Vorlesung WHERE kursnummer= :kursnummer
            ');
				$stmt->bindParam(':kursnummer', $vorlesung->kursnummer);
				$stmt->execute();
			} catch(PDOException $e) {
				echo("Fehler! Bitten wenden Sie sich an den Administrator...<br>" . $e->getMessage() . "<br>");
				die();
			}
		}
	}

?>