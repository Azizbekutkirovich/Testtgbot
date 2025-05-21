<?php

require_once "db.php";

class Functions
{
	private $db;

	public function __construct() {
		global $pdo;
		$this->db = $pdo;
	}

	public function addNewUser($telegram_id, $username) {
		$query = $this->db->prepare("INSERT IGNORE INTO users (telegram_id, username) VALUES (?, ?)");
		$query->execute([$telegram_id, $username]);
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

	public function getProducts() {
		$query = $this->db->query("SELECT * FROM products");
		$data = $query->fetchAll(PDO::FETCH_ASSOC);
		return $data;
	}

	public function back($page) {
		switch ($page) {
			case "detail":
			case "zakaz":
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
}