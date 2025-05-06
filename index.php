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
} else if ($text === "🛈 Batafsil ma'lumot") {
	$content = array('chat_id' => $chat_id, 'text' => "Batafsil ma'lumot uchun havola: <a href='https://telegra.ph/Biz-haqimizda-05-06'>Havola</a>", "parse_mode" => "html");
	$telegram->sendMessage($content);
} else if ($text === "📞 Bog'lanish uchun") {
	$content = array('chat_id' => $chat_id, 'text' => "
	📍 Адрес: Toshkent shahar Yangi hayot tumani Ibrat 2-tor ko'cha 38

 	📞 Телефон: +998(93)315-23-70

 	✉ Email: azizbek250607@gmail.com

 	🐙 GitHub: https://github.com/Azizbekutkirovich/");
	$telegram->sendMessage($content);
}