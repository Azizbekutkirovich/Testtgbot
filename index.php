<?php

include "Telegram.php";

$telegram = new Telegram('7712252153:AAE9ZG7gCLWT3E3jJCnGOclp82-3OFjO2So');

$chat_id = $telegram->ChatID();
$text = $telegram->Text();
if ($text === "/start") {
	$content = array('chat_id' => $chat_id, 'text' => "Assalomu aleykum. Men dasturchi Safarov Azizbek tomonidan ishlab chiqilgan botman!");
	$telegram->sendMessage($content);
	$content = array('chat_id' => $chat_id, 'text' => "Sizga qanday yordam bera olaman?");
	$telegram->sendMessage($content);
}