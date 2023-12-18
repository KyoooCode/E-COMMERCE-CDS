<?php
    session_start();

    if(!(isset($_SESSION['login']) && isset($_SESSION['pwd']))) {
        header('location: index.php');
        die;
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion</title>
</head>
<body>

<h2>Page de Gestion</h2>

<!-- Liens hypertextes pour les actions -->
<a href="deconnexion.php">Deconnexion</a><br>
<a href="ajouter_produit.html">Ajouter un Produit</a><br>
<a href="modifier_produit.php">Modifier un Produit</a><br>

</body>
</html>
