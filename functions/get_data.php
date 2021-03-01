<?php
	require '../include/config.php';

	function loadJobtypes(){
		$db = new DbConnect;
		$conn = $db->connect();

		$stmt = $conn->prepare("SELECT * FROM job_types");
		$stmt->execute();
		$types = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $types;
	}
?>