<?php

require_once "Functions.php";

class Pages
{
	private $telegram;
	private $data;
	private $chat_id;
	private $functions;
	private $user_id;

	public function __construct(Telegram $telegram) {
		$this->telegram = $telegram;
		$this->data = $telegram->getData();
		$this->chat_id = $this->data['message']['chat']['id'];
		$this->functions = new Functions();
		$this->user_id = $this->data['message']['from']['id'];
	}

	public function home() {
		$options = [
			[$this->telegram->buildKeyboardButton("ℹ️ Button 1"), $this->telegram->buildKeyboardButton("ℹ️ Button 2")]
		];
		$this->functions->setPage($this->user_id, "home");
		$keyb = $this->telegram->buildKeyBoard($options, true, true);
		$firstname = $this->data['message']['from']['first_name'];
		$lastname = $this->data['message']['from']['last_name'];
		$this->telegram->sendMessage([
			"chat_id" => $this->chat_id,
			"text" => "Assalomu aleykum $lastname $firstname! Bu bot test rejimida",
			"reply_markup" => $keyb
		]);
	}

	public function button1() {

	}

	public function button2() {

	}
}