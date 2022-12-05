<?php
include("topo.php");
include("check_session.php");


$logradouro = "";
$bairro = "";
$numero = "";
$cidade = "";
$uf = "";

$acao = "Cadastrar";

$id = isset($_GET["id"]) ? $_GET["id"] : 0;
if ($id != 0) {
    if (!is_numeric($id) || is_nan($id)) {
        header("Location: imoveis.php");
    }
    $stmt = $db->prepare("SELECT * FROM imoveis WHERE imovel_id=:id");
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $cliente = $stmt->fetch();
    if ($cliente) {
        $logradouro = $cliente["imovel_logradouro"];
        $bairro = $cliente["imovel_bairro"];
        $cidade = $cliente["imovel_cidade"];
        $numero = $cliente["imovel_numero"];
        $uf = $cliente["imovel_uf"];
        $acao = "Editar";
    } else {
        header("Location: imoveis.php");
    }
}

if ($_POST) {
    $id = isset($_POST["imovel_id"]) ? $_POST["imovel_id"] : 0;

    $logradouro = isset($_POST["logradouro"]) ? $_POST["logradouro"] : "";
    $bairro = isset($_POST["bairro"]) ? $_POST["bairro"] : "";
    $numero = isset($_POST["numero"]) ? $_POST["numero"] : "";
    $cidade = isset($_POST["cidade"]) ? $_POST["cidade"] : "";
    $uf = isset($_POST["uf"]) ? $_POST["uf"] : "";
    $user_id = $_SESSION["user_data"]["user_id"];
    
    if ($id == 0) {
        $stmt = $db->prepare("INSERT INTO imoveis VALUES
        (NULL, :user_id, :logradouro, :bairro, :numero, :cidade, :uf)
        ");

        $stmt->bindParam(":logradouro", $logradouro);
        $stmt->bindParam(":bairro", $bairro);
        $stmt->bindParam(":numero", $numero);
        $stmt->bindParam(":cidade", $cidade);
        $stmt->bindParam(":uf", $uf);
        $stmt->bindParam(":user_id", $user_id);

        $mensagem = $stmt->execute() ? "ok" : "nok";
    } else {
        $stmt = $db->prepare("UPDATE imoveis 
        SET imovel_logradouro=:logradouro,
            imovel_bairro=:bairro,
            imovel_numero=:numero,
            imovel_cidade=:cidade,
            imovel_uf=:uf
        WHERE imovel_id=:id");

        $stmt->bindParam(":logradouro", $logradouro);
        $stmt->bindParam(":bairro", $bairro);
        $stmt->bindParam(":numero", $numero);
        $stmt->bindParam(":cidade", $cidade);
        $stmt->bindParam(":uf", $uf);
        $stmt->bindParam(":id", $id);

        $mensagem = $stmt->execute() ? "okedit" : "nok";

    }
}

?>

<style>
    input {
        margin-bottom: 15px;
    }
</style>
<div class="boxed">

    <div id="content-container">
        <div id="page-head">

            <div id="page-title">
                <h1 class="page-header text-overflow">Creative Corretora</h1>
            </div>
            <ol class="breadcrumb">
                <li><a href="painel.php"><i class="pli-home"></i></a></li>
                <li><a href="imoveis.php">Imoveis</a></li>
                <li><a href="#"><?= $acao ?></a></li>
            </ol>


        </div>


        <div id="page-content">



            <hr class="new-section-sm bord-no">
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1">
                    <div class="panel panel-body">
                        <div class="panel-body">



                            <div class="panel">

                                <div class="panel-body">
                                    <h2><?= $acao ?> imóveis</h2>

                                    <hr>

                                    <form method="post">
                                        <input type="hidden" name="imovel_id" id="imovel_id" value="<?= $id ?>">
                                        <div class="row">
                                            <div class="col-md-9">
                                                <label for="logradouro">Logradouro</label>
                                                <input value="<?= $logradouro ?>" type="text" name="logradouro" id="logradouro" class="form-control" required>

                                            </div>
                                            <div class="col-md-3">
                                                <label for="numero">Número</label>
                                                <input value="<?= $numero ?>" type="text" name="numero" id="numero" class="form-control" required>

                                            </div>
                                            <div class="col-md-4">
                                                <label for="email">Bairro</label>
                                                <input value="<?= $bairro ?>" type="text" name="bairro" id="bairro" class="form-control" required>

                                            </div>

                                            <div class="col-md-4">
                                            <label for="uf">UF</label>

                                                <select class="form-control" id="uf" name="uf" required>
                                                    <option value="AC" <?php if($uf == "AC") echo "selected"; ?>>Acre</option>
                                                    <option value="AL" <?php if($uf == "AL") echo "selected"; ?>>Alagoas</option>
                                                    <option value="AP" <?php if($uf == "AP") echo "selected"; ?>>Amapá</option>
                                                    <option value="AM" <?php if($uf == "AM") echo "selected"; ?>>Amazonas</option>
                                                    <option value="BA" <?php if($uf == "BA") echo "selected"; ?>>Bahia</option>
                                                    <option value="CE" <?php if($uf == "CE") echo "selected"; ?>>Ceará</option>
                                                    <option value="DF" <?php if($uf == "DR") echo "selected"; ?>>Distrito Federal</option>
                                                    <option value="ES" <?php if($uf == "ES") echo "selected"; ?>>Espírito Santo</option>
                                                    <option value="GO" <?php if($uf == "GO") echo "selected"; ?>>Goiás</option>
                                                    <option value="MA" <?php if($uf == "MA") echo "selected"; ?>>Maranhão</option>
                                                    <option value="MT" <?php if($uf == "MT") echo "selected"; ?>>Mato Grosso</option>
                                                    <option value="MS" <?php if($uf == "MS") echo "selected"; ?>>Mato Grosso do Sul</option>
                                                    <option value="MG" <?php if($uf == "MG") echo "selected"; ?>>Minas Gerais</option>
                                                    <option value="PA" <?php if($uf == "PA") echo "selected"; ?>>Pará</option>
                                                    <option value="PB" <?php if($uf == "PB") echo "selected"; ?>>Paraíba</option>
                                                    <option value="PR" <?php if($uf == "PR") echo "selected"; ?>>Paraná</option>
                                                    <option value="PE" <?php if($uf == "PE") echo "selected"; ?>>Pernambuco</option>
                                                    <option value="PI" <?php if($uf == "PI") echo "selected"; ?>>Piauí</option>
                                                    <option value="RJ" <?php if($uf == "RJ") echo "selected"; ?>>Rio de Janeiro</option>
                                                    <option value="RN" <?php if($uf == "RN") echo "selected"; ?>>Rio Grande do Norte</option>
                                                    <option value="RS" <?php if($uf == "RS") echo "selected"; ?>>Rio Grande do Sul</option>
                                                    <option value="RO" <?php if($uf == "RO") echo "selected"; ?>>Rondônia</option>
                                                    <option value="RR" <?php if($uf == "RR") echo "selected"; ?>>Roraima</option>
                                                    <option value="SC" <?php if($uf == "SC") echo "selected"; ?>>Santa Catarina</option>
                                                    <option value="SP" <?php if($uf == "SP") echo "selected"; ?>>São Paulo</option>
                                                    <option value="SE" <?php if($uf == "SE") echo "selected"; ?>>Sergipe</option>
                                                    <option value="TO" <?php if($uf == "TO") echo "selected"; ?>>Tocantins</option>
                                                </select>

                                            </div>

                                            <div class="col-md-4">
                                                <label for="email">Cidade</label>
                                                <input value="<?= $cidade ?>" type="text" name="cidade" id="cidade" class="form-control" required>

                                            </div>
                                            <div class="col-md-12">
                                                <input type="submit" value="<?= $acao ?>" class="btn btn-primary form-control">
                                            </div>
                                        </div>


                                    </form>


                                </div>
                            </div>





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

<script>
    $("#telefone").mask("(00) 00000-0000");
</script>

<?php

if (isset($mensagem)) {
    if ($mensagem == "ok") {


?>
        <script>
            Swal.fire("Sucesso", "Imóvel cadastrado com sucesso", "success");
        </script>
    <?php
    } else if ($mensagem == "okedit") {
    ?>
        <script>
            Swal.fire("Sucesso", "Imóvel editado com sucesso", "success").then(() => window.location.href = "imoveis.php");
        </script>
    <?php
    } else {
    ?>
        <script>
            Swal.fire("Ooops...", "Ocorreu um erro ao cadastrar o imóvel, contate um administrador", "error");
        </script>
<?php
    }
}

?>


</body>

</html>