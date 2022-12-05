<?php
include "check_session.php";
include "conexao.php";

header("Content-Type: application/json");

$user_id = $_SESSION["user_data"]["user_id"];

$visitas = [];

$stmt = $db->prepare("SELECT * FROM visitas v INNER JOIN imoveis i ON i.imovel_id = v.imovel_id INNER JOIN clientes c ON c.cliente_id = v.cliente_id WHERE v.user_id=:id");
$stmt->bindParam(":id", $user_id);
$stmt->execute();

foreach($stmt->fetchAll() as $row) {
    array_push($visitas, array(
        "visita_id" => $row["visita_id"],
        "data_horario" => $row['data_horario'],
        "imovel_logradouro" => $row['imovel_logradouro'],
        "imovel_bairro" => $row['imovel_bairro'],
        "imovel_numero" => $row['imovel_numero'],
        "imovel_cidade" => $row['imovel_cidade'],
        "imovel_uf" => $row['imovel_uf'],
        "cliente_nome" => $row['cliente_nome'],
        "cliente_telefone" => $row['cliente_telefone'],
        "cliente_email" => $row['cliente_email']
    ));
}
echo json_encode($visitas);