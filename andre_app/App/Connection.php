<?php

namespace App;

use PDO;

class Connection {

	public static function getDb() {
		try {

			$conn = new \PDO(
				"mysql:host=localhost:3306;dbname=bd_andre",
				"root",
				"" 
			);

			
			return $conn;

		} catch (\PDOException $e) {
			$e->errorInfo;
		}
	}

	
}

?>