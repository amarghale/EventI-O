<?php
require_once('bdd.php');

$search = filter_input(INPUT_POST, "search");
if ($search == NULL) {
    include("index.php");
    exit();
} else {
    $query = "SELECT * FROM events WHERE events.title LIKE '%" . $search . "%'";
    $statement = $bdd->prepare($query);
    $statement->execute();
    $results = $statement->fetchAll();
    $statement->closeCursor();
}


?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        foreach ($results as $result):
            echo $result['title'];
        echo $result['venue'];
        echo $result['lecturer'];
        echo $result['start'];
        echo $result['end'];
        endforeach;
        ?>
    </body>
</html>
