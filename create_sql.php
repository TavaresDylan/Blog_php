<?php
require_once 'vendor/autoload.php';

// Connexion à une bdd
$pdo = NEW PDO('mysql:host=172.17.0.3;dbname=blog;','userblog','blogpwd');

// Executions dans la bdd :
// Désactive la vérification de clés étrangères
$pdo->exec('SET FOREIGN_KEY_CHECKS = 0');
// Vide la table post_category
$pdo->exec('TRUNCATE TABLE post_categoty');
// Vide la table post
$pdo->exec('TRUNCATE TABLE post');
// Vide la table category
$pdo->exec('TRUNCATE TABLE category');
// Vide la table user
$pdo->exec('TRUNCATE TABLE user');
// Active la vérification de clés étrangères
$pdo->exec('SET FOREIGN_KEY_CHECKS = 1');

// Créer une instance de la librairie faker
$faker = Faker\Factory::create('fr-FR');

$posts = [];
$categories = [];

// Boucle déterminant le nombre d'articles
for ($i=0; $i < 50; $i++){
    $pdo->exec("INSERT INTO post SET
        name='{$faker->sentence()}',                        /* Créer une phrase avec faker */
        slug='{$faker->slug}',                              /* Créer un slug avec faker */
        content='{$faker->paragraph(rand(3,15), true)}',    /* Créer un paragraphe avec faker */
        created_at='{$faker->date} {$faker->time}'");       /* Créer une date et une heure avec faker */
    $posts[] = $pdo->lastInsertId();
}

foreach($posts as $post){
    $randomCategories = $faker->randomElements($categories, rand(0, count($categories)));
    foreach($randomCategories as $category){
    $pdo->exec("INSERT INTO post_category SET
        post_id={$post},
        category_id={$category}");
    }
}

for ($i=0; $i <50; $i++){
    // Insert dans la table category
    $pdo->exec("INSERT INTO category SET
    name='{$faker->sentence($nbWords = 3, $variableNbWords = false)}',/* La colonne Name contiendra une ligne d'une phrase de 3 mots */
    slug='{$faker->slug}'");/* La colonne Slug contiendra une ligne "slug" */
}

for ($i=0; $i <50; $i++){
    // On déclare la variable $password qui prendra un mdp différent à chaque itération
    $password = password_hash($faker->password, PASSWORD_BCRYPT);
    // Insert dans la table user
    $pdo->exec("INSERT INTO user SET
    username='{$faker->username}',
    password='$password'");
}