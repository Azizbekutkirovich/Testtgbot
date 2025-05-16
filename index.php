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

$arr_pages = [
	"home" => [
		"ℹ️ Button 1" => "button1",
		"ℹ️ Button 2" => "button2"
	],
	"button1" => [
		"Value 1" => "zakaz",
		"Value 2" => "zakaz",
		"Value 3" => "zakaz"
	]
];

if ($text == "/start") {
	$pages->start();
} else {
	$userPage = $pages->getPage($user_id);
	if (isset($arr_pages[$userPage][$text])) {
		$pages->{$arr_pages[$userPage][$text]}();
	} else {
		$pages->chooseButtons();
	}
}