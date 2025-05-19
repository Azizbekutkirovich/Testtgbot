<?php

require_once "Telegram.php";
require_once "Pages.php";

$telegram = new Telegram('7721368494:AAGye3pqlYFFpe3epO4ODr_3TO5sk6dbvwg');
$data = $telegram->getData();
$text = $data['message']['text'];
$telegram_id = $data['message']['from']['id'];
$pages = new Pages($telegram);
// $data = $telegram->getData();
// $message = $data['message'];
// $chat_id = $message['chat']['id'];
// $text = $message['text'];
// $userId = $message['from']['id'];
// $firstname = $message['from']['first_name'] ?? "";
// $lastname = $message['from']['last_name'] ?? "";

// $arr_pages = [
// 	"home" => [
// 		"ℹ️ Button 1" => "button1",
// 		"ℹ️ Button 2" => "button2"
// 	],
// 	"button1" => [
// 		"Value 1" => "getPhoneNumber",
// 		"Value 2" => "getPhoneNumber",
// 		"Value 3" => [
// 			"method" => "getPhoneNumber",
// 			"arg" => "Value 3"
// 		]
// 	],
// ];

$bot_pages = [
	"home" => [
		"ℹ️ Button 1" => [
			"method" => "button1",
			"arg" => ""
		],
		"ℹ️ Button 2" => [
			"method" => "button2",
			"arg" => ""
		]
	],
	"button1" => [
		"Value 1" => [
			"method" => "getPhoneNumber",
			"arg" => "value1"
		],
		"Value 2" => [
			"method" => "getPhoneNumber",
			"arg" => "value2"
		],
		"Value 3" => [
			"method" => "getPhoneNumber",
			"arg" => "value3"
		]
	]
];

if ($text == "/start") {
	$pages->start();
} else {
	$userPage = $pages->getPage($telegram_id);
	if (array_key_exists($text, $bot_pages[$userPage]) && !empty($bot_pages[$userPage][$text]['arg'])) {
		$pages->{$bot_pages[$userPage][$text]['method']}($bot_pages[$userPage][$text]['arg']);
	} else if (array_key_exists($text, $bot_pages[$userPage])) {
		$pages->{$bot_pages[$userPage][$text]['method']}();
	} else if ($text === "🔙 Ortga qaytish") {
		$pages->back($userPage);
	} else {
		$pages->chooseButtons();
	}
}