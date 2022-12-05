<?php

$nome = isset($_POST["nome"]) ? $_POST["nome"] : "";
$email = isset($_POST["email"]) ? $_POST["email"] : "";
$senha = isset($_POST["senha"]) ? $_POST["senha"] : "";
$confirmasenha = isset($_POST["confirmasenha"]) ? $_POST["confirmasenha"] : "";
$fotoPadrao = 'img/default_user.jpg';
include "Conexao.php";

$stmt = $db->prepare("INSERT INTO users VALUES (NULL, :username, :email, md5(:senha), 1, :foto)");
$stmt->bindParam(":username", $nome);
$stmt->bindParam(":email", $email);
$stmt->bindParam(":senha", $senha);
$stmt->bindParam(":foto", $fotoPadrao);
$stmt->execute();
echo 'ok';