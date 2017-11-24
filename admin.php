<?php
require_once('bdd.php');


$sql = "SELECT id, title, start, end, color FROM events ";

$req = $bdd->prepare($sql);
$req->execute();

$events = $req->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Event I/O</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href='css/fullcalendar.css' rel='stylesheet' />
        <style>
            body
            {
                padding-top: 70px;
            }
            #calendar 
            {
                max-width: 800px;
            }
            .col-centered
            {
                float: none;
                margin: 0 auto;
            }
        </style>
    </head>

    <body>
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">HOME</a>
                </div>       
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="login.php">Login</a>
                        </li>
                        <li>
                            <a href="#">About</a>
                        </li>
                    </ul>
                </div>          
            </div>       
        </nav>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1>EVENT INSIDE/OUT</h1>
                    <p class="lead">Organise your Day!</p>
                    <div id="calendar" class="col-centered">
                    </div>
                </div>

            </div>

            <script src="js/jquery.js"></script>
            <script src="js/bootstrap.min.js"></script>     
            <script src='js/moment.min.js'></script>
            <script src='js/fullcalendar.min.js'></script>
            <script>
                $(document).ready(function () {
                    $('#calendar').fullCalendar({
                        header: {
                            left: 'prev,next today',
                            center: 'title',
                            right: 'month,basicWeek,basicDay'
                        },
                        defaultDate: new Date(),
                        editable: true,
                        eventLimit: true,
                        selectable: true,
                        selectHelper: true,
                        select: function (start, end) {

                            $('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
                            $('#ModalAdd #end').val(moment(end).format('YYYY-MM-DD HH:mm:ss'));
                            $('#ModalAdd').modal('show');
                        },
                        eventRender: function (event, element) {
                            element.bind('dblclick', function () {
                                $('#ModalEdit #id').val(event.id);
                                $('#ModalEdit #title').val(event.title);
                                $('#ModalEdit #color').val(event.color);
                                $('#ModalEdit').modal('show');
                            });
                        },
                        events: [
<?php
foreach ($events as $event):

    $start = explode(" ", $event['start']);
    $end = explode(" ", $event['end']);
    if ($start[1] == '00:00:00') {
        $start = $start[0];
    } else {
        $start = $event['start'];
    }
    if ($end[1] == '00:00:00') {
        $end = $end[0];
    } else {
        $end = $event['end'];
    }
    ?>
                                {
                                    id: '<?php echo $event['id']; ?>',
                                    title: '<?php echo $event['title']; ?>',
                                    start: '<?php echo $start; ?>',
                                    end: '<?php echo $end; ?>',
                                    color: '<?php echo $event['color']; ?>',
                                },
<?php endforeach; ?>
                        ]
                    });

                    function edit(event) {
                        start = event.start.format('YYYY-MM-DD HH:mm:ss');
                        if (event.end) {
                            end = event.end.format('YYYY-MM-DD HH:mm:ss');
                        } else {
                            end = start;
                        }

                        id = event.id;

                        Event = [];
                        Event[0] = id;
                        Event[1] = start;
                        Event[2] = end;
                    }
                });
            </script>

    </body>

</html>
