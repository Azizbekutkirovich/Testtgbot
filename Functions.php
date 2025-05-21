<?php

require_once "db.php";

class Functions
{
	private $db;

	public function __construct() {
		global $pdo;
		$this->db = $pdo;
	}

	public function addNewUser($telegram_id) {
		$query = $this->db->prepare("INSERT IGNORE INTO users (telegram_id) VALUES (?)");
		$query->execute([$telegram_id]);
	}

	public function setPage($telegram_id, $page) {
		$user_id = $this->getUserId($telegram_id);
		$query = $this->db->prepare("
	        INSERT INTO userPage (user_id, page)
	        VALUES (?, ?)
	        ON DUPLICATE KEY UPDATE page = VALUES(page)
	    ");
	    $query->execute([$user_id, $page]);
	}

	public function getPage($telegram_id) {
		$user_id = $this->getUserId($telegram_id);
		$query = $this->db->prepare("SELECT page FROM userPage WHERE user_id = ?");
		$query->execute([$user_id]);
		$data = $query->fetch(PDO::FETCH_ASSOC);
		return $data['page'];
	}

	public function back($page) {
		switch ($page) {
			case "detail":
			case "button2":
				$this->home();
				break;
			case "getPhoneNumber":
				$this->button1();
				break;
		}
	}

	private function getUserId($telegram_id) {
		$query = $this->db->prepare("SELECT id FROM users WHERE telegram_id = ?");
		$query->execute([$telegram_id]);
		$data = $query->fetch(PDO::FETCH_ASSOC);
		return $data['id'];
	}

	public function saveUserValue($telegram_id, $value) {
		$user_id = $this->getUserId($telegram_id);
		$query = $this->db->prepare("INSERT INTO userValue (user_id, value)
	        VALUES (?, ?)
	        ON DUPLICATE KEY UPDATE value = VALUES(value)");
		$query->execute([$user_id, $value]);
	}
}