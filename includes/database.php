<?php
//debuguear($configDB['cliente']['namedb']);
$db = mysqli_connect(
    $_ENV['DB_HOST'] ?? '',
    $_ENV['DB_USER'] ?? '', 
    $_ENV['DB_PASS'] ?? '', 
    $_ENV['DB_NAME'] ?? '' //$selectDB['namedb']
);

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT); // Activar modo de excepciones para mysqli
mysqli_set_charset($db, "utf8");

if (!$db) {
    echo "Error: No se pudo conectar a MySQL.";
    echo "errno de depuración: " . mysqli_connect_errno();
    echo "error de depuración: " . mysqli_connect_error();
    exit;
}
