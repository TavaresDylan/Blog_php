<?php
// Connexion à une bdd
$pdo = NEW PDO('mysql:host=172.17.0.3;dbname=blog;','userblog','blogpwd');

$pagination = $pdo->query('SELECT count(id) FROM post')->fetch()[0]/10;

if(null !== $_GET['page'] && intval($_GET['page']) > 0 && $_GET['page'] <=$pagination){
    $start = 10 * $_GET['page'] -10;
}
else{
    if(null !== $_GET['page']  && !intval($_GET['page']) || $_GET['page'] > $pagination){
        $message = 'Page introuvable';
    }
    $start = 0;
}
$query= "SELECT * FROM post ORDER BY id LIMIT 10 OFFSET {$start}";
$query = $pdo->prepare($query);
$query->execute();
?>


<!DOCTYPE html>
<html lang="fr">
<head>
<link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Articles sql</title>
</head>
<body>
    <h1>Hello World !</h1>
    <section>
            <?php foreach ($query as $value) { 
                echo "<article>";
                echo "<h2><a href=''>".$value["id"]."- ".$value["name"]."</a></h2>";
                echo "<p>".$value["content"]."</p>" ;
                echo "</article>";
            } 
            ?>      
        </article>
    </section>

<section class="pagination">
    <p>
        <a href="/">1</a>
        <?php for($i = 2; $i <= $pagination; $i++): ?>
            <a href="/?page=<?= $i ?>"><?= $i ?></a>
        <?php endfor ?>
    </p>
</section>




</body>
</html>
