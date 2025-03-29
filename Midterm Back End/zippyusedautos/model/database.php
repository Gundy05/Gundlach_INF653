<?php
$dsn = 'mysql:host=localhost;dbname=zippyusedautos';
$username = 'root';
$password = '';
try {
    $db = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    echo 'Database Error: ' . $e->getMessage();
    exit();
}
?>
