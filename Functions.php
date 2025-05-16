<?php

require_once "db.php";

class Functions
{
	private $db;

	public function __construct() {
		global $pdo;
		$this->db = $pdo;
	}

	public function setPage($user_id, $page) {
		 $query = $this->db->prepare("
	        INSERT INTO userPage (user_id, page)
	        VALUES (?, ?)
	        ON DUPLICATE KEY UPDATE page = VALUES(page)
	    ");
	    $query->execute([$user_id, $page]);
	}

	public function getPage($user_id) {
		$query = $this->db->prepare("SELECT page FROM userPage WHERE user_id = ?");
		$query->execute([$user_id]);
		$data = $query->fetch(PDO::FETCH_ASSOC);
		return $data['page'];
	}

	public function back($page) {
		switch ($page) {
			case "button1":
			case "button2":
				$this->home();
				break;
		}
	}
}