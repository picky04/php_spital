<?php
require_once __DIR__ . "/../config/pdo.php";
require_once __DIR__ . "/../app/controllers/AuthController.php";

$auth = new AuthController($pdo);
$auth->logout();

header("Location: login.php");
exit;
