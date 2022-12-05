<?php
try {

    $DB_USER = "root";
    $DB_PASS = "";
    $DB_HOST = "localhost";
    $DB_NAME = "agenda_corretores";
    $DB_PORT = 3306;

    $db = new PDO("mysql:host=$DB_HOST:$DB_PORT;dbname=$DB_NAME", $DB_USER, $DB_PASS);
} catch (PDOException $e) {
    print "Erro de conexão com o banco de dados!: " . $e->getMessage() . "<br/>";
    die();
}
