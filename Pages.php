<?php

require_once "Functions.php";

class Pages extends Functions
{
	private $telegram;
	private $data;
	private $chat_id;
	private $user_id;

	public function __construct(Telegram $telegram) {
		parent::__construct();
		$this->telegram = $telegram;
		$this->data = $telegram->getData();
		$this->chat_id = $this->data['message']['chat']['id'];
		$this->user_id = $this->data['message']['from']['id'];
	}

	public function start() {
		$firstname = $this->data['message']['from']['first_name'];
		$lastname = $this->data['message']['from']['last_name'];
		$this->telegram->sendMessage([
			"chat_id" => $this->chat_id,
			"text" => "Assalomu aleykum $lastname $firstname! Bu bot test rejimida"
		]);
		$this->home();
	}

	public function home() {
		$this->setPage($this->user_id, "home");
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
		$this->setPage($this->user_id, "button1");
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

	public function chooseButtons() {
		$this->telegram->sendMessage([
			"chat_id" -> $this->chat_id,
			"text" => "⚠️ Noto‘g‘ri buyruq. Tugmalardan foydalaning."
		]);
	}
}