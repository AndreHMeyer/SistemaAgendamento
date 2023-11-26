<?php

session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: index.html');
    exit;
}
$user = "root";
$conexao = new PDO("mysql:host=localhost;dbname=sistemaagendamento", $user);
$id_profissional = isset($_REQUEST['id_profissional']) ? $_REQUEST['id_profissional'] : "";

$queryConsultas = "SELECT observacao, DataInicio, DataFim FROM consulta WHERE idProfissional = " . $id_profissional;

$exeConsultas = $conexao->prepare($queryConsultas);
$exeConsultas->execute();
$events = [];
while ($rowConsultas = $exeConsultas->fetch(PDO::FETCH_ASSOC)) {
    // $data = $rowConsultas['data'];
    // $observacao = $rowConsultas['observacao'];
    extract($rowConsultas);
    $events[] = ['title' => utf8_encode($observacao), 'start' => $DataInicio, 'end' => $DataFim];
}


?>

<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='utf-8' />
    <title>Remember Med</title>
    <link rel="icon" href="img/logo.png">
    <link rel="stylesheet" href="includes/bootstrap-4.0.0/bootstrap-4.0.0/dist/css/bootstrap.css" />
    <link rel="stylesheet" href="includes/icons-main/font/bootstrap-icons.css" />
    <script src="includes/jquery-3.7.1.js"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/index.global.min.js'></script>
    <script src='fullcalendar-6.1.9/packages/core/locales/pt-br.global.min.js'></script>
    <script src='https://unpkg.com/tooltip.js/dist/umd/tooltip.min.js'></script>
    <script src='https://unpkg.com/popper.js/dist/umd/popper.min.js'></script>
    <style>
        body {
            margin: 40px 10px;
            padding: 0;
            font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
            font-size: 14px;
        }

        #calendar {
            padding-left: 90px;
            padding-top: 90px;
            width: 80%;
        }
    </style>
    <script>
        $(function() {
            $("#nav-head").load("navbar_head.html");
        });
        $(function() {
            $("#nav-lateral").load("navbar_lateral.php");
        });
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                eventDidMount: function(info) {
                    var tooltip = new Tooltip(info.el, {
                        title: info.event.extendedProps.description,
                        placement: 'top',
                        trigger: 'hover',
                        container: 'body'
                    });
                },
                locale: 'pt-br',
                contentHeight: "auto",
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                //   initialDate: '2023-01-12',
                navLinks: true, // can click day/week names to navigate views
                selectable: true,
                selectMirror: true,
                //select: function(arg) {
                //    var title = prompt('Event Title:');
                //    if (title) {
                //        calendar.addEvent({
                //            title: title,
                //            start: arg.start,
                //            end: arg.end,
                //            allDay: arg.allDay
                //        })
                //    }
                //    calendar.unselect()
                //},
                //eventClick: function(arg) {
                //    if (confirm('Are you sure you want to delete this event?')) {
                //        arg.event.remove()
                //    }
                //},
                editable: true,
                dayMaxEvents: true, // allow "more" link when too many events
                events: <?= json_encode($events); ?>,

            });

            calendar.render();
        });
    </script>
</head>

<body>
<div id="nav-head">
</div>
<div id="nav-lateral">
</div>
<div id='calendar'></div>
</body>

</html>