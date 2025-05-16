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
	$pages->start();
} else {
	$userPage = $pages->getPage($user_id);
	switch($userPage) {
		case "home":
			if ($text === "ℹ️ Button 1") {
				$pages->button1();
			} else if ($text === "ℹ️ Button 2") {
				$pages->button2();
			} else {
				$pages->chooseButtons();
			}
			break;
		case "button1":
			$nextPages = ["Value 1", "Value 2", "Value 3"];
			if (in_array($text, $nextPages)) {

			} else if ($text === "🔙 Ortga qaytish") {
				$pages->back($userPage);
			} else {
				$pages->chooseButtons();
			}
			break;
		case "button2":

	}
}