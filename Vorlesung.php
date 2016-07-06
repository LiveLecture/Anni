<?php

	class Vorlesung {

		public $kursnummer;
		public $name;
		public $studiengang;
		public $semester;
		public $ects;
		public $id_dozent;

		function __construct($data = null) {
			if(is_array($data)) {
				$this->kursnummer = $data['kursnummer'];
				$this->name = $data ['name'];
				$this->studiengang = $data['studiengang'];
				$this->semester = $data['semester'];
				$this->ects = $data['ects'];
				$this->id_dozent = $data['id_dozent'];
			}
		}
	}

?>