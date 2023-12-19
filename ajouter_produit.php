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
    <title>Ajouter un Produit</title>
</head>
<body>

<h2>Formulaire pour Ajouter un Produit</h2>

<form action="traitement_ajout_produit.php" method="post" enctype="multipart/form-data">
    <label for="genre">Genre :</label>
    <input type="text" id="genre" name="genre" required><br>

    <label for="libelle">Libellé :</label>
    <input type="text" id="libelle" name="libelle" required><br>

    <label for="artiste">Artiste :</label>
    <input type="text" id="artiste" name="artiste" required><br>

    <label for="prix">Prix :</label>
    <input type="text" id="prix" name="prix" required><br>

    <label for="image">Image :</label>
    <input type="file" id="image" name="image" accept="image/*" required><br>

    <input type="submit" value="Ajouter">
</form>
<p><a href="gestion.php">Annuler</a></p>
</body>
</html>
