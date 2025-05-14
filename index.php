<?php

require_once "Telegram.php";
require_once "Pages.php";

$telegram = new Telegram('7721368494:AAGye3pqlYFFpe3epO4ODr_3TO5sk6dbvwg');
$data = $telegram->getData();
$text = $data['message']['text'];
$user_id = $data['message']['from']['id'];
$pages = new Pages($telegram);
// $data = $telegram->getData();
// $message = $data['message'];
// $chat_id = $message['chat']['id'];
// $text = $message['text'];
// $userId = $message['from']['id'];
// $firstname = $message['from']['first_name'] ?? "";
// $lastname = $message['from']['last_name'] ?? "";

if ($text == "/start") {
	$pages->home();
}

$page = $pages->getPage($user_id);
switch($page) {
	case "home":
		if ($text === "ℹ️ Button 1") {
			$pages->button1();
		} else if ($text === "ℹ️ Button 2") {
			$pages->button2();
		} else {
			$telegram->sendMessage([
				"chat_id" => $data['message']['chat']['id'],
				"text" => "Iltimos pastdagi tugmalardan birini tanlang!"
			]);
		}
		break;
}