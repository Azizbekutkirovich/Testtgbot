<?php

require_once "Functions.php";

class Pages extends Functions
{
	private $telegram;
	private $data;
	private $chat_id;
	private $telegram_id;

	public function __construct(Telegram $telegram) {
		parent::__construct();
		$this->telegram = $telegram;
		$this->data = $telegram->getData();
		$this->chat_id = $this->data['message']['chat']['id'];
		$this->telegram_id = $this->data['message']['from']['id'];
	}

	public function start() {
		$this->addNewUser($this->telegram_id);
		$firstname = $this->data['message']['from']['first_name'];
		$lastname = $this->data['message']['from']['last_name'];
		$this->telegram->sendMessage([
			"chat_id" => $this->chat_id,
			"text" => "Assalomu aleykum $lastname $firstname! Bu bot test rejimida"
		]);
		$this->home();
	}

	public function home() {
		$this->setPage($this->telegram_id, "home");
		$options = [
			[$this->telegram->buildKeyboardButton("ℹ️ Button 1"), $this->telegram->buildKeyboardButton("ℹ️ Button 2")]
		];
		$keyb = $this->telegram->buildKeyBoard($options, true, true);
		$this->telegram->sendMessage([
			"chat_id" => $this->chat_id,
			"text" => "Pastdagi tugmalardan birini tanlang!",
			"reply_markup" => $keyb
		]);
	}

	public function button1() {
		$this->setPage($this->telegram_id, "button1");
		$options = [
			[$this->telegram->buildKeyboardButton("Value 1")],
			[$this->telegram->buildKeyboardButton("Value 2")],
			[$this->telegram->buildKeyboardButton("Value 3")],
			[$this->telegram->buildKeyboardButton("🔙 Ortga qaytish")]
		];
		$keyb = $this->telegram->buildKeyBoard($options, true, true);
		$this->telegram->sendMessage([
			"chat_id" => $this->chat_id,
			"text" => "Quyidagilardan birini tanlang!",
			"reply_markup" => $keyb
		]);
	}

	public function button2() {

	}

	public function getPhoneNumber($value) {
		$this->setPage($this->telegram_id, "getPhoneNumber");
		$this->saveUserValue($this->telegram_id, $value);
		$options = [
			[$this->telegram->buildKeyboardButton("Raqam qoldirish", true)],
			[$this->telegram->buildKeyboardButton("🔙 Ortga qaytish")]
		];
		$keyb = $this->telegram->buildKeyBoard($options, true, true);
		$this->telegram->sendMessage([
			"chat_id" => $this->chat_id,
			"text" => "Telefon raqamingizni yozing",
			"reply_markup" => $keyb
		]);	
	}

	public function userPhoneNumber() {
		if ($this->isPhoneNumber()) {
			$phone_number = $this->data['message']['contact']['phone_number'] ?? $this->data['message']['text'];
			
		}
	}

	public function chooseButtons() {
		$this->telegram->sendMessage([
			"chat_id" => $this->chat_id,
			"text" => "⚠️ Noto‘g‘ri buyruq. Tugmalardan foydalaning."
		]);
	}

	private function isPhoneNumber() {
		if ((!empty($this->data['message']['entities']) && $this->data['message']['entities'][0]['type'] === "phone_number") || !empty($this->data['message']['contact'])) {
			return true;
		} else {
			return false;
		}
	}
}