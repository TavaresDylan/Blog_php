<?php
// Connexion à une bdd
$pdo = NEW PDO('mysql:host=172.17.0.3;dbname=blog;','userblog','blogpwd');

$sql= "SELECT * FROM post LIMIT 10 OFFSET 10";
$statement = $pdo->prepare($sql);
$statement->execute(); 
$test = $statement->fetchAll();
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
            <?php foreach ($test as $value) { 
                $num += 1;
                echo "<article>";
                echo "<h2><a href=''>".$value["id"]."- ".$value["name"]."</a></h2>";
                echo "<p>".$value["content"]."</p>" ;
                echo "</article>";
            } 
            ?>      
        </article>
    </section>

<section class="pagination">
    <ul>
        <li><a href=""><</a></li>
        <li><a href="home.php">1</a></li>
        <li><a href="page_2.php">2</a></li>
        <li><a href="page_3.php">3</a></li>
        <li><a href="page_4.php">4</a></li>
        <li><a href="page_5.php">5</a></li>
        <li><a href="">></a></li>
    </ul>
</section>

</body>
</html>
