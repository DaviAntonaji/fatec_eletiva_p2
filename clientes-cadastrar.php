<?php
include("topo.php");
include("check_session.php");


$nome = "";
$email = "";
$telefone = "";
$acao = "Cadastrar";

$id = isset($_GET["id"]) ? $_GET["id"] : 0;
if ($id != 0) {
    if (!is_numeric($id) || is_nan($id)) {
        header("Location: clientes.php");
    }
    $stmt = $db->prepare("SELECT * FROM clientes WHERE cliente_id=:id");
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $cliente = $stmt->fetch();
    if ($cliente) {
        $nome = $cliente["cliente_nome"];
        $email = $cliente["cliente_email"];
        $telefone = $cliente["cliente_telefone"];
        $acao = "Editar";
    } else {
        header("Location: clientes.php");
    }
}

if ($_POST) {
    $id = isset($_POST["cliente_id"]) ? $_POST["cliente_id"] : 0;
    $nome = isset($_POST["nome"]) ? $_POST["nome"] : "";
    $telefone = isset($_POST["telefone"]) ? $_POST["telefone"] : "";
    $email = isset($_POST["email"]) ? $_POST["email"] : "";
    $user_id = $_SESSION["user_data"]["user_id"];
    if ($id == 0) {
        $stmt = $db->prepare("INSERT INTO clientes(cliente_nome, cliente_telefone, cliente_email,user_id) VALUES
        (:nome, :telefone, :email, :user_id)
        ");

        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":telefone", $telefone);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":user_id", $user_id);

        $mensagem = $stmt->execute() ? "ok" : "nok";
    } else {
        $stmt = $db->prepare("UPDATE clientes SET cliente_nome=:nome, cliente_telefone=:telefone, cliente_email=:email WHERE cliente_id=:id");

        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":telefone", $telefone);
        $stmt->bindParam(":email", $email);
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
                <li><a href="clientes.php">Clientes</a></li>
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
                                    <h2><?= $acao ?> clientes</h2>
                                    <hr>


                                    <form method="post">
                                        <input type="hidden" name="cliente_id" id="cliente_id" value="<?= $id ?>">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="nome">Nome</label>
                                                <input value="<?= $nome ?>" type="text" name="nome" id="nome" class="form-control" required>

                                            </div>
                                            <div class="col-md-6">
                                                <label for="telefone">Telefone</label>
                                                <input value="<?= $telefone ?>" type="text" name="telefone" id="telefone" class="form-control" required>

                                            </div>
                                            <div class="col-md-6">
                                                <label for="email">E-mail</label>
                                                <input value="<?= $email ?>" type="email" name="email" id="email" class="form-control" required>

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
            Swal.fire("Sucesso", "Cliente cadastrado com sucesso", "success");
        </script>
    <?php
    } else if ($mensagem == "okedit") {
    ?>
        <script>
            Swal.fire("Sucesso", "Cliente editado com sucesso", "success").then(() => window.location.href = "clientes.php");
        </script>
    <?php
    } else {
    ?>
        <script>
            Swal.fire("Ooops...", "Ocorreu um erro ao cadastrar o cliente, contate um administrador", "error");
        </script>
<?php
    }
}

?>


</body>

</html>