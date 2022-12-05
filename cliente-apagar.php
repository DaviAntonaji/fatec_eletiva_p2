<?php
include "check_session.php";
include "conexao.php";
$id = isset($_GET["id"]) ? $_GET["id"] : 0;

if(!is_numeric($id) || is_nan($id)) {
    echo "invalid";
}


$stmt = $db->prepare("DELETE FROM clientes WHERE cliente_id=:id");
$stmt->bindParam(":id", $id);
$stmt->execute();
echo "ok";