<?php
include("topo.php");
include("check_session.php");
?>
<style>
    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        padding: 12px 8px;
        z-index: 999;
    }

    .dropdown:hover .dropdown-content {
        display: flex;
        gap: 16px;
        flex-direction: row;
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
                <li><a href="#">Imóveis</a></li>
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
                                    <h2>Imóveis</h2>

                                </div>
                                <div class="col-md-6 text-right">
                                    <a href="imoveis-cadastrar.php" class="btn btn-primary">Cadastrar</a>
                                </div>
                            </div>

                            <table id="demo-dt-basic" class="table table-striped table-bordered" cellspacing="0" width="100%">

                                <thead>
                                    <tr>
                                        <th>Logradouro</th>
                                        <th>Bairro</th>
                                        <th>Cidade</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    $stmt = $db->prepare("SELECT * FROM imoveis WHERE user_id=:user_id");
                                    $stmt->bindParam(":user_id", $_SESSION["user_data"]["user_id"]);
                                    $stmt->execute();

                                    foreach ($stmt->fetchAll() as $row) {
                                    ?>
                                        <tr>
                                            <td><?= $row["imovel_logradouro"] ?>, <?= $row["imovel_numero"] ?></td>
                                            <td><?= $row["imovel_bairro"] ?></td>
                                            <td><?= $row["imovel_cidade"] ?> - <?= $row["imovel_uf"] ?></td>
                                            <td class="text-center">
                                                <div class="dropdown text-center">
                                                    <button class="btn btn-primary">
                                                        <i class="pli-list-view icon-lg"></i>
                                                    </button>

                                                    <div class="dropdown-content">
                                                        <a href="imoveis-cadastrar.php?id=<?= $row["imovel_id"] ?>" class="btn btn-success form-control">Editar</a>
                                                        <button class="btn btn-danger form-control" onclick="Apagar(<?= $row['imovel_id'] ?>)">Apagar</button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>

                                    <?php
                                    }
                                    ?>

                                </tbody>
                            </table>





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
    function Apagar(id) {
        Swal.fire({
            title: 'Deseja realmente apagar este cliente?',
            text: "Essa ação é irreversivel",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim'
        }).then((result) => {
            if (result.isConfirmed) {
                $.get(`imovel-valida-agenda.php?id=${id}`, function(data) {
                    try {
                        const quantidade = parseInt(data);
                        if (quantidade > 0) {
                            Swal.fire("Ooops...", "Este imovel já foi utilizado em um agendamento, portanto não pode ser apagado", "error")
                        } else {
                            // Ajax delete
                            $.get(`imovel-apagar.php?id=${id}`, function(data) {
                                if (data == "ok") {
                                    Swal.fire("Sucesso!", "Imovel apagado com sucesso!", "success").then(() => window.location.reload());

                                } else {
                                    Swal.fire("Ooops...", "Falha ao apagar imovel", "error");
                                }
                            });
                        }
                    } catch {
                        Swal.fire("Ooops...", "Falha ao apagar imovel", "error");
                    }
                });
            }
        })

    }
</script>


</body>

</html>