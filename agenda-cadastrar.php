<?php
include("topo.php");
include("check_session.php");
$data = isset($_GET["data"]) ? $_GET["data"] : "";
if ($data != "") {
    $data = substr($data, 0, -6);
}

if($_POST) {
    $dataInput = $_POST["data"];
    $datetime = date("Y-m-d H:i:s", strtotime($dataInput));
    $cliente = $_POST["cliente"];    
    $imovel = $_POST["imovel"];    
    $user_id = $_SESSION["user_data"]["user_id"];

    $stmt = $db->prepare("INSERT INTO visitas VALUES (NULL, :user, :cliente, :imovel, :datah)");
    $stmt->bindParam(":user", $user_id);
    $stmt->bindParam(":cliente", $cliente);
    $stmt->bindParam(":imovel", $imovel);
    $stmt->bindParam(":datah", $datetime);

    if($stmt->execute()) {
        header("Location: painel.php");
    }else {
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
                <li><a href="#">Cadastrar compromisso</a></li>
            </ol>


        </div>


        <div id="page-content">



            <hr class="new-section-sm bord-no">
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1">
                    <div class="panel panel-body">
                        <div class="panel-body">



                            <h2>Cadastrar compromisso</h2>

                            <form method="post">
                                
                            <label for="data">Data e hora</label>
                            <input type="datetime-local" value="<?= $data ?>" name="data" id="data" class="form-control" required>


                                <label for="cliente">Cliente</label>
                                <select id="cliente" name="cliente" class="form-control" required>
                                    <?php

                                    $stmt = $db->prepare("SELECT * FROM clientes WHERE user_id=:user_id");
                                    $stmt->bindParam(":user_id", $_SESSION["user_data"]["user_id"]);
                                    $stmt->execute();

                                    foreach ($stmt->fetchAll() as $row) {
                                    ?>
                                        <option value="<?= $row["cliente_id"] ?>"><?= $row["cliente_nome"] ?></option>
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
                                        <option value="<?= $row["imovel_id"] ?>"><?= $row["imovel_logradouro"] ?>, <?= $row["imovel_numero"] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <input type="submit" value="Cadastrar" class="btn btn-primary form-control" style='margin-top:10px;'>


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