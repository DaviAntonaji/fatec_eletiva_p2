<?php
include("topo.php");
include("check_session.php");
?>
<link href='lib/fullcalendar/main.css' rel='stylesheet' />

<div class="boxed">

    <div id="content-container">
        <div id="page-head">

            <div id="page-title">
                <h1 class="page-header text-overflow">Creative Corretora</h1>
            </div>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pli-home"></i></a></li>
                <li><a href="#">Agenda</a></li>
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
                                    <h2>Agenda</h2>
                                    <small>Para adicionar um compromisso, clique em alguma parte da agenda<br>
                                        Para editar algum compromisso, clique sobre ele.
                                    </small>
                                    <div id='calendar'></div>
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

<script src="lib/fullcalendar/main.min.js"></script>
<script src='lib/fullcalendar/core/locales/pt-br.js'></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'timeGridWeek',
            locale: "pt-br",
            dateClick: function(info) {
                window.location.href = `agenda-cadastrar.php?data=${info.dateStr}`;
            },
            eventClick: function(info) {
                const id = info.event.id;
                window.location.href = `agenda-editar.php?id=${id}`;

            }

        });
        calendar.render();
        $.get("recuperar-visitas.php", (data) => {
            data.forEach((el) => {
                let event = {
                    id: el.visita_id,
                    title: `${el.cliente_nome}, ${el.imovel_logradouro}, ${el.imovel_numero}`,
                    start: el.data_horario,
                    end: el.data_horario,
                }
                calendar.addEvent(event)
            })
        })
    });
</script>



</body>

</html>