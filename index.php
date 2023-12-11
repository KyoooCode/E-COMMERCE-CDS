<?php

$json_file = "articles.json";
$articles = file_get_contents($json_file);
$liste_articles = json_decode($articles, true);

// Vérifier si la conversion a réussi
if ($articles === null) {
    die('Erreur de décodage JSON');
}

// Parcourir les CDs
foreach ($liste_articles['cds'] as $cd) {
    echo "ID: {$cd['id']}<br>";
    echo "Genre: {$cd['genre']}<br>";
    echo "Title: {$cd['title']}<br>";
    echo "Artist: {$cd['artist']}<br>";
    echo "Price: {$cd['price']}<br>";
    echo "Image: {$cd['image']}<br>";
    echo "<hr>";
}
?>