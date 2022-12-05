<?php
include("topo.php");
include("check_session.php");

if ($_POST) {

    $senhaatual = isset($_POST["senhaatual"]) ? $_POST["senhaatual"] : "";
    $senha = isset($_POST["senha"]) ? $_POST["senha"] : "";
    $senha2 = isset($_POST["senha2"]) ? $_POST["senha2"] : "";
    if ($senha == $senha2) {
        $stmt = $db->prepare("SELECT * FROM users WHERE user_id=:id AND user_password=md5(:senha)");
        $id = $_SESSION["user_data"]["user_id"];
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":senha", $senhaatual);
        $stmt->execute();
        $correct = $stmt->fetch();
        if ($correct) {
            $stmt = $db->prepare("UPDATE users SET user_password=md5(:senha) WHERE user_id=:id");
            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":senha", $senha);
            $msg = $stmt->execute() ? "OK" : "Erro ao atualizar senha!";
        } else {
            $msg = "Senha atual incorreta!";
        }
    } else {
        $msg = "Senhas divergentes!";
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
                <li><a href="#"><i class="pli-home"></i></a></li>
                <li><a href="#">Alterar senha</a></li>
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

                                    <h2>Alterar senha</h2>

                                    <form method="post">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="senha">Senha atual</label>
                                                <input type="password" name="senhaatual" id="senhaatual" class="form-control" required>

                                            </div>
                                            <div class="col-md-12">
                                                <label for="senha">Nova senha</label>
                                                <input type="password" name="senha" id="senha" class="form-control" required>

                                            </div>
                                            <div class="col-md-12">
                                                <label for="senha">Confirma nova Senha </label>
                                                <input type="password" name="senha2" id="senha2" class="form-control" required>
                                            </div>
                                            <div class="col-md-12">
                                                <input type="submit" name="submit" id="submit" value="Alterar" class="btn btn-primary">
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

<?php
                                    if (isset($msg)) {
                                        if ($msg == 'OK') {
                                    ?>
                                    <script>
                                        Swal.fire("Sucesso!", "Senha atualizada com sucesso", "success");
                                    </script>
                                        <?php

                                        } else {
                                        ?>
                                        <script>
                                        Swal.fire( "Ooops...", "<?=$msg?>", "error");
                                    </script>
                                    <?php
                                        }
                                    }
                                    ?>



</body>

</html>