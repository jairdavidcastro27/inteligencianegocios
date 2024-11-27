<?php
$host = 'sql10.freemysqlhosting.net';
$db = 'sql10747752';
$user = 'sql10747752';
$password = 'Py5xvjLnF2';

try {
    $conn = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>