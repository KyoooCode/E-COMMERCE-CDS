<?php

session_start();

if(!(isset($_SESSION['login']) && isset($_SESSION['pwd']))) {
    header('location: connexion.php');
    die;
}

print "<br><a href='gestion.php'>Annuler</a>";

// Connexion à la base de données
$servername = "lakartxela.iutbayonne.univ-pau.fr:3306";
$dbUsername = "amoreno011_bd";
$dbPassword = "amoreno011_bd";
$dbName = "amoreno011_bd";

$conn = new mysqli($servername, $dbUsername, $dbPassword, $dbName);

if ($conn->connect_error) {
    die("Connexion impossible: " . $conn->connect_error);
}

// Afficher la liste des produits avec les colonnes "Modifier" et "Supprimer"
$sql = "SELECT * FROM PRODUIT";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'><tr><th>ID</th><th>Genre</th><th>Libellé</th><th>Artiste</th><th>Prix</th><th>Image</th><th>Modifier</th><th>Supprimer</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["id"] . "</td><td>" . $row["genre"] . "</td><td>" . $row["libelle"] . "</td><td>" . $row["artiste"] . "</td><td>" . $row["prix"] . "</td><td><img src='Images/" . $row["chemin"] . "' alt='Image du produit' width='150'></td>";
        echo "<td><form method='post' action='modification.php'><input type='hidden' name='id_modifier' value='" . $row["id"] . "'><input type='submit' value='Modifier'></form></td>";
        echo "<td><form method='post' action='suppression.php'><input type='hidden' name='id_supprimer' value='" . $row["id"] . "'><input type='submit' value='Supprimer'></form></td></tr>";
    }

    echo "</table>";
} else {
    echo "0 results";
}

// Fermer la connexion à la base de données
$conn->close();
?>
