<?php

$host = "host";
$user = "login";
$pass = "haslo";
$dbname = "remik";

$polacz = new Baza($host, $dbname, $user, $pass);
$pdo = $polacz ->polacz();