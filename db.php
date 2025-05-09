<?php

$url = getenv('MYSQL_URL');

if (!$url) {
    die("MYSQL_URL environment variable aniqlanmadi!");
}

$parts = parse_url($url);
$host = $parts['host'];
$port = $parts['port'];
$user = $parts['user'];
$pass = $parts['pass'];
$db   = ltrim($parts['path'], '/');

$conn = mysqli_connect($host, $user, $pass, $db, $port);

if (!$conn) {
    die("MySQL ulanishda xatolik: " . mysqli_connect_error());
}