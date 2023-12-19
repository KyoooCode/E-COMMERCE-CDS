<?php
    session_start();

    if(!(isset($_SESSION['login']) && isset($_SESSION['pwd']))) {
        header('location: connexion.php');
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
<a href="deconnexion.php">Déconnexion</a><br>
<a href="ajouter_produit.php">Ajouter un produit</a><br>
<a href="modifier_produit.php">Modifier ou supprimer un produit</a><br>

</body>
</html>
