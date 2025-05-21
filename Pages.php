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
		$this->addNewUser($this->telegram_id, $this->data['message']['from']['username']);
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
			[$this->telegram->buildKeyboardButton("ℹ️ Batafsil ma'lumot"), $this->telegram->buildKeyboardButton("🛒 Buyurtma berish")]
		];
		$keyb = $this->telegram->buildKeyBoard($options, true, true);
		$this->telegram->sendMessage([
			"chat_id" => $this->chat_id,
			"text" => "Pastdagi tugmalardan birini tanlang!",
			"reply_markup" => $keyb
		]);
	}

	public function detail() {
		$this->setPage($this->telegram_id, "detail");
		$options = [
			[$this->telegram->buildKeyboardButton("🔙 Ortga qaytish")]
		];
		$keyb = $this->telegram->buildKeyBoard($options, true, true);
		$this->telegram->sendMessage([
			"chat_id" => $this->chat_id,
			"text" => "📢 Diqqat! Bu bot ayni paytda test bosqichida. To‘liq versiya tez orada ishga tushadi.Siz bu bot orqali mahsulotlar buyurtma bera olasiz",
		]);
		$this->telegram->sendMessage([
			"chat_id" => $this->chat_id,
			"text" => "Ortga qaytish uchun ortga qaytish tugmasini bosing!",
			"reply_markup" => $keyb			
		]);
	}

	public function zakaz() {
		$this->setPage($this->telegram_id, "zakaz");
		$data = $this->getProducts();
		$options = [];
		foreach ($data as $d) {
			$name = $d['product_name'];
			$price = $d['price'];
			$options[] = [$this->telegram->buildKeyboardButton("$name $price")];
		}
		$keyb = $this->telegram->buildKeyBoard($options, true, true);
		$this->telegram->sendMessage([
			"chat_id" => $this->chat_id,
			"text" => "Mahsulotlardan birini tanlang va buyurtma berish uchun o'sha mahsulot ustiga bosing!",
			"reply_markup" => $keyb
		]);
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

	public function chooseButtons() {
		$this->telegram->sendMessage([
			"chat_id" => $this->chat_id,
			"text" => "⚠️ Noto‘g‘ri buyruq. Tugmalardan foydalaning."
		]);
	}
}