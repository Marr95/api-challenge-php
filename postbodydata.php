<?php
if(!isset($_POST['temperature']) || !isset($_POST['heat'])) {
    header('HTTP/2 400 Bad Request');
    exit();
}

$conn = new PDO("mysql:host=192.168.44.122;dbname=challenge;charset=utf8", "marwan", "marwan");
if(!$conn) {
    header('HTTP/2 500 Internal Server Error');
    exit();
}

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$temperature = trim($_POST['temperature']);
$heat = trim($_POST['heat']);

try{
    $sql = $conn->prepare("INSERT INTO bodydata (temperature, heat) VALUES (?, ?)");
    if($sql->execute(array($temperature, $heat))) {
        header('HTTP/2 200 Ok');
    }
    else {
        header('HTTP/2 500 Internal Server Error');
    }
}
catch(Exception) {
    header('HTTP/2 500 Internal Server Error');
}