<?php

require_once __DIR__ . "/config.php";

try {
    $pdo = new PDO(
        'mysql:host=' . $config['db_host'] . ';dbname=' . $config['db_name'],
        $config['db_user'],
        $config['db_password']
    );

    // Setăm modul de raportare a erorilor
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    // Dacă apare o eroare la conexiune, o afișăm
    die("Conexiune eșuată: " . $e->getMessage());
}
?>
