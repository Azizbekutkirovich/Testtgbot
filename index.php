<?php

require_once "Telegram.php";
// require_once "db.php";

$telegram = new Telegram('7721368494:AAGye3pqlYFFpe3epO4ODr_3TO5sk6dbvwg');

$data = $telegram->getData();
$message = $data['message'];
$chat_id = $message['chat']['id'];
$text = $message['text'];
$userId = $message['from']['id'];
$firstname = $message['from']['first_name'] ?? "";
$lastname = $message['from']['last_name'] ?? "";

if ($text == "/start") {
	$content = [
		"chat_id" => $chat_id,
		"text" => "Assalomu aleykum $lastname $firstname! Bu bot test rejimida"
	];
	$telegram->sendMessage($content);
}