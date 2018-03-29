<html>

<head>
    <meta charset="UTF-8">
    <title>Checkpoint1</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<body>


    <?php 

    
//require_once $_SERVER['DOCUMENT_ROOT'] . '/home/guio12/Code/checkpoint1/php_0218_checkpoint1_Strasbourg_eleves/src';

require 'connect.php';
require 'functions.php';


$pdo = new PDO(DSN, USER, PASS);


?>

    <div class="container">
        <h2>Tableau checkpoint</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Civilité</th>
                    <th>NOM Prénom</th>

                </tr>
            </thead>
            <tbody>
                <?php
        $querySelect = "SELECT * from contact inner join civility on civility.id = civility_id order by lastname";
    $res = $pdo->query($querySelect);
    $resAll = $res->fetchAll();
    foreach ($resAll as $data)

{
 
  echo "<tr><td>".$data['civility']."</td>";
        echo "<td>". fullname($data['lastname'], $data['firstname'])."</td>";
  
}
        ?>

            </tbody>
        </table>
    </div>
</body>

</html>
