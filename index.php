<?php

require_once "Telegram.php";
// require_once "db.php";

$telegram = new Telegram('7712252153:AAE9ZG7gCLWT3E3jJCnGOclp82-3OFjO2So');

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
		"text" => json_encode($data, JSON_PRETTY_PRINT)
	];
	$telegram->sendMessage($content);
}