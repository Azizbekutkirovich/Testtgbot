<?php

include "Telegram.php";

$telegram = new Telegram('7712252153:AAE9ZG7gCLWT3E3jJCnGOclp82-3OFjO2So');

$chat_id = $telegram->ChatID();
$text = $telegram->Text();
if ($text === "/start") {
	$text = "Assalomu aleykum. Men dasturchi Safarov Azizbek tomonidan ishlab chiqilgan botman! Sizga qanday yordam bera olaman?";
}
$content = array('chat_id' => $chat_id, 'text' => $text);
$telegram->sendMessage($content);