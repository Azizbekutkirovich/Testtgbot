<?php

include "Telegram.php";

$telegram = new Telegram('7712252153:AAE9ZG7gCLWT3E3jJCnGOclp82-3OFjO2So');

$chat_id = $telegram->ChatID();
$text = $telegram->Text();
if ($text === "/start") {
	$option = array( 
    //First row
    array($telegram->buildKeyboardButton("Button 1"), $telegram->buildKeyboardButton("Button 2")), 
    //Second row
    array($telegram->buildKeyboardButton("Button 3"), $telegram->buildKeyboardButton("Button 4"), $telegram->buildKeyboardButton("Button 5")), 
    //Third row
    array($telegram->buildKeyboardButton("Button 6")) );
    $keyb = $telegram->buildKeyBoard($option, $onetime=false);
	$content = array('chat_id' => $chat_id, 'text' => "Assalomu aleykum. Men dasturchi Safarov Azizbek tomonidan ishlab chiqilgan botman!");
	$telegram->sendMessage($content);
	$content = array('chat_id' => $chat_id, "reply_markup" => $keyb, 'text' => "Sizga qanday yordam bera olaman?");
	$telegram->sendMessage($content);
}