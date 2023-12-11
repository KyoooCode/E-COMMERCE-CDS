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
    print("p");
    print("<a href=''>{$cd['genre']}<br></a>");
    print("<a href=''>{$cd['title']}<br></a>");
    print("<a href=''>{$cd['artist']}<br></a>");
    print("<a href=''>{$cd['genre']}<br></a>");
    print("<a href=''>{$cd['price']}<br></a>");
}
?>