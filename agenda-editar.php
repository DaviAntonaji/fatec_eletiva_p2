<?php
include("topo.php");
include("check_session.php");
$id = isset($_GET["id"]) ? $_GET["id"] : "";
if ($id == "") {
    header("Location: painel.php");
}
if (!is_numeric($id)) {
    header("Location: painel.php");
}

$stmt = $db->prepare("SELECT * FROM visitas WHERE visita_id=:id");
$stmt->bindParam(":id", $id);
$stmt->execute();
$dados = $stmt->fetch();


if ($_POST) {
    $dataInput = $_POST["data"];
    $datetime = date("Y-m-d H:i:s", strtotime($dataInput));
    $cliente = $_POST["cliente"];
    $imovel = $_POST["imovel"];
    $user_id = $_SESSION["user_data"]["user_id"];

    $stmt = $db->prepare(" UPDATE visitas SET cliente_id=:cliente, imovel_id=:imovel, data_horario=:datah WHERE visita_id=:id");
    $stmt->bindParam(":cliente", $cliente);
    $stmt->bindParam(":imovel", $imovel);
    $stmt->bindParam(":datah", $datetime);
    $stmt->bindParam(":id", $id);

    if ($stmt->execute()) {
        header("Location: painel.php");
    } else {
        $msg = "Falha ao cadastrar";
    }
}

?>


<div class="boxed">

    <div id="content-container">
        <div id="page-head">

            <div id="page-title">
                <h1 class="page-header text-overflow">Creative Corretora</h1>
            </div>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pli-home"></i></a></li>
                <li><a href="painel.php">Agenda</a></li>
                <li><a href="#">Editar compromisso</a></li>
            </ol>


        </div>


        <div id="page-content">



            <hr class="new-section-sm bord-no">
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1">
                    <div class="panel panel-body">
                        <div class="panel-body">



                            <div class="row">
                                <div class="col-md-6">
                                <h2>Editar compromisso</h2>
                                </div>
                                <div class="col-md-6 text-right">

                                    <a href="agenda-excluir.php?id=<?=$id?>" class="btn btn-danger btn-lg">Excluir</a>

                                </div>
                            </div>

                            <form method="post">

                                <label for="data">Data e hora</label>
                                <input type="datetime-local" value="<?= $dados["data_horario"] ?>" name="data" id="data" class="form-control" required>


                                <label for="cliente">Cliente</label>
                                <select id="cliente" name="cliente" class="form-control" required
                                
                                >
                                    <?php

                                    $stmt = $db->prepare("SELECT * FROM clientes WHERE user_id=:user_id");
                                    $stmt->bindParam(":user_id", $_SESSION["user_data"]["user_id"]);
                                    $stmt->execute();

                                    foreach ($stmt->fetchAll() as $row) {
                                    ?>
                                        <option value="<?= $row["cliente_id"] ?>"
                                <?php if($row["cliente_id"] == $dados["cliente_id"]) { echo "selected"; } ?>
                                        
                                        ><?= $row["cliente_nome"] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>


                                <label for="imovel">Imóvel</label>
                                <select id="imovel" name="imovel" class="form-control" required>
                                    <?php

                                    $stmt = $db->prepare("SELECT * FROM imoveis WHERE user_id=:user_id");
                                    $stmt->bindParam(":user_id", $_SESSION["user_data"]["user_id"]);
                                    $stmt->execute();

                                    foreach ($stmt->fetchAll() as $row) {
                                    ?>
                                        <option value="<?= $row["imovel_id"] ?>"
                                        <?php if($row["imovel_id"] == $dados["imovel_id"]) { echo "selected"; } ?>
                                        ><?= $row["imovel_logradouro"] ?>, <?= $row["imovel_numero"] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <input type="submit" value="Atualizar" class="btn btn-primary form-control" style='margin-top:10px;'>


                            </form>

                        </div>
                    </div>
                </div>
            </div>



        </div>


    </div>

    <?php
    include("menu.php");
    ?>


</div>


<?php
include("rodape.php");
?>

</div>




<script src="js/jquery.min.js"></script>


<script src="js/bootstrap.min.js"></script>


<script src="js/nifty.min.js"></script>


<script src="plugins/datatables/media/js/jquery.dataTables.js"></script>
<script src="plugins/datatables/media/js/dataTables.bootstrap.js"></script>
<script src="plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>


<script src="js/demo/tables-datatables.js"></script>

<script src="plugins/bootbox/bootbox.min.js"></script>


<script src="js/jquery.mask.js"></script>



</body>

</html>