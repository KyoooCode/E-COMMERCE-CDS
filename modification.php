<?php
// Connexion à la base de données
$servername = "lakartxela.iutbayonne.univ-pau.fr:3306";
$dbUsername = "amoreno011_bd";
$dbPassword = "amoreno011_bd";
$dbName = "amoreno011_bd";

$conn = new mysqli($servername, $dbUsername, $dbPassword, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialiser les variables
$id_modifier = $genre_modif = $libelle_modif = $artiste_modif = $prix_modif = "";

// Vérifier si le formulaire de modification a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id_modifier"])) {
    $id_modifier = $_POST["id_modifier"];

    // Récupérer les données du produit à modifier
    $sql_select = "SELECT * FROM PRODUIT WHERE id = $id_modifier";
    $result_select = $conn->query($sql_select);

    if ($result_select->num_rows > 0) {
        $row = $result_select->fetch_assoc();
        $genre_modif = $row["genre"];
        $libelle_modif = $row["libelle"];
        $artiste_modif = $row["artiste"];
        $prix_modif = $row["prix"];
    }
}

// Fermer la connexion à la base de données
$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Produit</title>
</head>
<body>

<h2>Modifier un Produit</h2>
<form action="modification_process.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id_modifier" value="<?php echo $id_modifier; ?>">
    
    <label for="genre">Genre :</label>
    <input type="text" id="genre" name="genre" value="<?php echo $genre_modif; ?>"><br>

    <label for="libelle">Libellé :</label>
    <input type="text" id="libelle" name="libelle" value="<?php echo $libelle_modif; ?>"><br>

    <label for="artiste">Artiste :</label>
    <input type="text" id="artiste" name="artiste" value="<?php echo $artiste_modif; ?>"><br>

    <label for="prix">Prix :</label>
    <input type="text" id="prix" name="prix" value="<?php echo $prix_modif; ?>"><br>

    <label for="image">Nouvelle Image :</label>
    <input type="file" id="image" name="image"><br>

    <?php
    // Afficher l'image actuelle avec une largeur de 150 pixels
    echo "<label>Image Actuelle :</label>";
    echo "<img src='Images/" . $row["chemin"] . "' alt='Image actuelle du produit' width='150'><br>";
    ?>

    <input type="submit" value="Modifier">
</form>

</body>
</html>
