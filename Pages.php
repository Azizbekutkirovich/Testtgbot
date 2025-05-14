<?php

class Pages
{
	private $telegram;
	private $data;
	private $chat_id;

	public function __construct(Telegram $telegram) {
		$this->telegram = $telegram;
		$this->data = $telegram->getData();
		$this->chat_id = $this->data['message']['chat']['id'];
	}

	public function home() {
		$options = [
			[$this->telegram->buildKeyboardButton("Button 1"), $this->telegram->buildKeyboardButton("Button 2")]
		];
		$keyb = $this->telegram->buildKeyboard($options, true, true);
		$firstname = $this->data['message']['from']['first_name'];
		$lastname = $this->data['message']['from']['last_name'];
		$this->telegram->sendMessage([
			"chat_id" => $chat_id,
			"text" => "Assalomu aleykum $lastname $firstname! Bu bot test rejimida" 
		]);
	}
}