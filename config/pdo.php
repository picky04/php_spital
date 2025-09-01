<?php

require_once __DIR__ . "/config.php";

//$env = 'live';
$env = 'local';

try {
    $pdo = new PDO(
        'mysql:host=' . $config[$env]['db_host'] . ';port=' . $config[$env]['db_port'] . ';dbname=' . $config[$env]['db_name'],
        $config[$env]['db_user'],
        $config[$env]['db_password']
    );

    // Setăm modul de raportare a erorilor
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    // Dacă apare o eroare la conexiune, o afișăm
    die("Conexiune eșuată: " . $e->getMessage());
}
?>
