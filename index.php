<?php

require_once "Telegram.php";
require_once "db.php";


// $query = $pdo->prepare("INSERT INTO test2 (user_id, phone_Number) VALUES (?, ?)");
// $query->execute([5667777776, "+998933152370"]);

$telegram = new Telegram('7712252153:AAE9ZG7gCLWT3E3jJCnGOclp82-3OFjO2So');

$data = $telegram->getData();
$message = $data['message'];
$chat_id = $message['chat']['id'];
$text = $message['text'];

switch ($text) {
	case "/start":
		start();
		break;
	case "🛈 Batafsil ma'lumot":
		detail();
		break;
	case "📄 Rezyume":
		rezyume();
		break;
	case "📞 Bog'lanish uchun":
		contact();
		break;
	case "🤖 Bot zakaz qilish":
		zakazBot();
		break;
	case "🔙 Ortga qaytish":
		start();
		break;
	default:
		if ((!empty($message['entities']) && $message['entities'][0]['type'] === "phone_number") || !empty($message['contact'])) {
			$userId = $message['from']['id'];
			$phoneNumber = $message['contact']['phone_number'] ?? $message['text'];
			if (!isZakaz($userId)) {
				$query = $pdo->prepare("INSERT INTO test2 (user_id, phone_Number) VALUES (?, ?)");
				$query->execute([$userId, $phoneNumber]);
				$telegram->sendMessage([
					"chat_id" => $chat_id,
					"text" => "Tez orada siz bilan bog'lanishadi!"
				]);
			} else {
				$query = $pdo->prepare("UPDATE test2 SET phone_Number = ? WHERE user_id = ?");
				$query->execute([$phoneNumber, $userId]);
				$telegram->sendMessage([
					"chat_id" => $chat_id,
					"text" => "Tez orada siz bilan bog'lanishadi!"
				]);
			}
		}
		break;
}

function start() {
	global $chat_id, $telegram, $message;
	$first_name = $message['chat']['first_name'] ?? "";
	$last_name = $message['chat']['last_name'] ?? "";  
	$option = array(
	    array($telegram->buildKeyboardButton("🛈 Batafsil ma'lumot"), $telegram->buildKeyboardButton("📄 Rezyume")),
	    array($telegram->buildKeyboardButton("📞 Bog'lanish uchun"), $telegram->buildKeyboardButton("🤖 Bot zakaz qilish")));
    $keyb = $telegram->buildKeyBoard($option, true, true);
	$content = array('chat_id' => $chat_id, 'text' => "Assalomu aleykum $last_name $first_name. Men dasturchi Safarov Azizbek haqida ma'lumot bera olaman!");
	$telegram->sendMessage($content);
	$content = array('chat_id' => $chat_id, "reply_markup" => $keyb, 'text' => "Qanday ma'lumot kerak?");
	$telegram->sendMessage($content);
}

function detail() {
	global $chat_id, $telegram;
	$option = [
		[$telegram->buildKeyboardButton("🔙 Ortga qaytish")]
	];
	$keyb = $telegram->buildKeyBoard($option, true, true);
	$content = array('chat_id' => $chat_id, 'text' => "Batafsil ma'lumot uchun havola: <a href='https://telegra.ph/Biz-haqimizda-05-06'>Havola</a>", "parse_mode" => "html", "reply_markup" => $keyb);
	$telegram->sendMessage($content);
}

function contact() {
	global $chat_id, $telegram;
	$content = array('chat_id' => $chat_id, 'text' => "
		📍 Адрес: Toshkent shahar Yangi hayot tumani Ibrat 2-tor ko'cha 38

	 	📞 Телефон: +998(93)315-23-70

	 	✉ Email: azizbek250607@gmail.com

	 	🐙 GitHub: https://github.com/Azizbekutkirovich/");
	$telegram->sendMessage($content);
}

function zakazBot() {
	global $chat_id, $telegram;
	$option = [
		[$telegram->buildKeyboardButton("Raqam qoldirish", true)]
	];
	$keyb = $telegram->buildKeyBoard($option, true, true);
	$content = array("chat_id" => $chat_id, "text" => "Telefon raqamingizni yozing", "reply_markup" => $keyb);
	$telegram->sendMessage($content);
}

function rezyume() {
	global $chat_id, $telegram;
	$content = array("chat_id" => $chat_id, "text" => "Rezyume tez orada qo'shiladi!");
	$telegram->sendMessage($content);
}

function isZakaz($userId) {
	global $pdo;
	$query = $pdo->prepare("SELECT * FROM test2 WHERE user_id = ?");
	$query->execute([$userId]);
	$row = $query->fetch(PDO::FETCH_ASSOC);
	return $row !== false;
}