<?php

include "Telegram.php";

$telegram = new Telegram('7712252153:AAE9ZG7gCLWT3E3jJCnGOclp82-3OFjO2So');

$chat_id = $telegram->ChatID();
$text = $telegram->Text();
if ($text === "/start") {
	$option = array(
    array($telegram->buildKeyboardButton("🛈 Batafsil ma'lumot"), $telegram->buildKeyBoardButton("📄 Rezyume")),
    array($telegram->buildKeyboardButton("📞 Bog'lanish uchun"), $telegram->buildKeyBoardButton("🤖 Bot zakaz qilish")));
    $keyb = $telegram->buildKeyBoard($option, $onetime = true, $resize = true);
	$content = array('chat_id' => $chat_id, 'text' => "Assalomu aleykum. Men dasturchi Safarov Azizbek haqida ma'lumot bera olaman!");
	$telegram->sendMessage($content);
	$content = array('chat_id' => $chat_id, "reply_markup" => $keyb, 'text' => "Qanday ma'lumot kerak?");
	$telegram->sendMessage($content);
}