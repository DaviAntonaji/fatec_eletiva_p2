<?php
include("Conexao.php");
session_start();
$login = $_POST["login"];
$senha = $_POST["senha"];

$stmt = $db->prepare(
    "Select * from users where user_email =:email AND user_password=md5(:senha)" 
);
$stmt->bindParam(":email", $login   );
$stmt->bindParam(":senha", $senha);

$stmt->execute();

$data = $stmt->fetch();
if ($data) 
{
    $_SESSION["user_data"] = $data;
    echo "ok";
    
}
else
{
    echo "Login ou senha invalidos";

    
}

?>