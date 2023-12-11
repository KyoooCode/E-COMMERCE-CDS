<?php

$json_file = "articles.json";
$articles = file_get_contents($json_file);
$liste_articles = json_decode($articles, true);

// Vérifier si la conversion a réussi
if ($liste_articles === null) {
    die('Erreur de décodage JSON');
}

// Parcourir les CDs et générer les liens avec les cartes
foreach ($liste_articles['cds'] as $cd) {
    echo '<a href="page_produit.php?id=' . $cd['id'] . '" class="cd-link">';
    echo '<div class="cd-card">';
    echo '<img src="Images/' . $cd['image'] . '" alt="' . $cd['title'] . '">';
    echo '<h3>' . $cd['title'] . '</h3>';
    echo '<p>Genre: ' . $cd['genre'] . '</p>';
    echo '<p>Artist: ' . $cd['artist'] . '</p>';
    echo '<p>Price: $' . $cd['price'] . '</p>';
    echo '</div>';
    echo '</a>';
    echo '<br>';
    echo '<br>';
    echo '<br>';
    echo '<br>';
}
?>
