<?php

$host = "mysql.railway.internal";
$port = 3306;
$db_name = "railway";
$user = "root";
$password = "sBiQquNTTEiJeLsqogEtVIqBfZCIjCnO";

try {
	$pdo = new PDO("mysql:host=$host;port=$port;dbname=$db_name;charset=utf8mb4", $user, $password);
	
} catch (PDOException $e) {
	echo "Xatolik: ".$e->getMessage();
	exit;
}