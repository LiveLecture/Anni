<?php

	require_once("dataManager.php");
	require_once("vorlesung.php");

	require_once("dozent.php");

	class VorlesungManager extends DataManager {

		protected $pdo;

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

				$err = $stmt->errorInfo();
				if($err[2] !== null) {
					echo "File " . __FILE__ .", line: " . __LINE__ . "<br>";
					print_r($err);
					exit();
				}

			} catch(PDOException $e) {
				echo("Fehler! Bitten wenden Sie sich an den Administrator...<br>" . $e->getMessage() . "<br>");
				die();
			}
			if(!$vorlesung) $vorlesung = null;

			return $vorlesung;
		}


		public function findAll($id_dozent) {
			try {
				$stmt = $this->pdo->prepare('SELECT * FROM Vorlesung WHERE id_dozent = :dozent');
				$stmt->bindParam(':dozent', $id_dozent);
				$stmt->execute();
				$stmt->setFetchMode(PDO::FETCH_CLASS, 'Vorlesung');
				$result = $stmt->fetchAll();

				$err = $stmt->errorInfo();
				if($err[2] !== null) {
					echo "File " . __FILE__ .", line: " . __LINE__ . "<br>";
					print_r($err);
					exit();
				}

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

				$err = $stmt->errorInfo();
				if($err[2] !== null) {
					echo "File " . __FILE__ .", line: " . __LINE__ . "<br>";
					print_r($err);
					exit();
				}

				return $result;
			} catch(PDOException $e) {
				echo("Fehler! Bitte wenden Sie sich an den Administrator...<br>" . $e->getMessage() . "<br>");
				die ();
			}
		}

		public function create(Vorlesung $vorlesung, Dozent $dozent) {
			try {
				$stmt = $this->pdo->prepare('
              INSERT INTO Vorlesung (id_dozent, name, kursnummer, studiengang, ects, semester)
              VALUES (:id_dozent, :name, :kursnummer, :studiengang, :ects, :semester)
            ');

				$stmt->bindParam(':id_dozent', $dozent->id_dozent);
				$stmt->bindParam(':kursnummer', $vorlesung->kursnummer);
				$stmt->bindParam(':name', $vorlesung->name);
				$stmt->bindParam(':studiengang', $vorlesung->studiengang);
				$stmt->bindParam(':semester', $vorlesung->semester);
				$stmt->bindParam(':ects', $vorlesung->ects);
				$result = $stmt->execute();

				$err = $stmt->errorInfo();
				if($err[2] !== null) {
					echo "File " . __FILE__ .", line: " . __LINE__ . "<br>";
					print_r($err);
					exit();
				}

				return $result;
			} catch(PDOException $e) {
				echo("Fehler! Bitten wenden Sie sich an den Administrator...<br>" . $e->getMessage() . "<br>");
				die();
			}
		}

		public function save(Vorlesung $vorlesung) {
			if(isset($vorlesung->kursnummer)) {
				$this->update($vorlesung);

				return $vorlesung;
			}

			try {
				$stmt = $this->pdo->prepare('
              INSERT INTO Vorlesung
                (name, studiengang, semester, ects)
              VALUES
                (:name , :beschreibung, :studiengang, :semester, :etcs)
            ');
				$stmt->bindParam(':name', $vorlesung->name);
				$stmt->bindParam(':studiengang', $vorlesung->studiengang);
				$stmt->bindParam(':semester', $vorlesung->semester);
				$stmt->bindParam(':ects', $vorlesung->ects);
				$stmt->execute();

				$vorlesung->kursnummer = $this->pdo->lastInsertId();

				$err = $stmt->errorInfo();
				if($err[2] !== null) {
					echo "File " . __FILE__ .", line: " . __LINE__ . "<br>";
					print_r($err);
					exit();
				}
			} catch(PDOException $e) {
				echo("Fehler! Bitten wenden Sie sich an den Administrator...<br>" . $e->getMessage() . "<br>");
				die();
			}

			return $vorlesung;
		}

		private function update(Vorlesung $vorlesung) {
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

				$err = $stmt->errorInfo();
				if($err[2] !== null) {
					echo "File " . __FILE__ .", line: " . __LINE__ . "<br>";
					print_r($err);
					exit();
				}
			} catch(PDOException $e) {
				echo("Fehler! Bitten wenden Sie sich an den Administrator...<br>" . $e->getMessage() . "<br>");
				die();
			}

			return $vorlesung;
		}

		public function delete(Vorlesung $vorlesung) {
			try {
				$stmt = $this->pdo->prepare('
              DELETE FROM Vorlesung WHERE kursnummer= :kursnummer
            ');
				$stmt->bindParam(':kursnummer', $vorlesung->kursnummer);
				$stmt->execute();

				$err = $stmt->errorInfo();
				if($err[2] !== null) {
					echo "File " . __FILE__ .", line: " . __LINE__ . "<br>";
					print_r($err);
					exit();
				}
			} catch(PDOException $e) {
				echo("Fehler! Bitten wenden Sie sich an den Administrator...<br>" . $e->getMessage() . "<br>");
				die();
			}
		}


	}

?>