<?php
$engine = "mysql";
$host = "localhost";
$port = 3306;
$dbname = "no";
$username = "root";
$password = "root";

$pdo = new PDO("$engine:host=$host:$port;dbname=$dbname", $username, $password);

