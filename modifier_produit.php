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

        // Rediriger vers la page d'affichage des informations du produit
        header("Location: modifier_produit_info.html?id_modifier=$id_modifier&genre=$genre_modif&libelle=$libelle_modif&artiste=$artiste_modif&prix=$prix_modif");
        exit();
    }
}

// Vérifier si le formulaire de suppression a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["supprimer"])) {
    $id_supprimer = $_POST["id_supprimer"];

    // Supprimer le produit de la base de données
    $sql_delete = "DELETE FROM PRODUIT WHERE id=$id_supprimer";

    if ($conn->query($sql_delete) === TRUE) {
        echo "Produit supprimé avec succès !";
    } else {
        echo "Erreur lors de la suppression du produit : " . $conn->error;
    }
}

// Afficher la liste des produits avec les liens "Modifier" et "Supprimer"
$sql = "SELECT * FROM PRODUIT";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'><tr><th>ID</th><th>Genre</th><th>Libellé</th><th>Artiste</th><th>Prix</th><th>Image</th><th>Modifier</th><th>Supprimer</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["id"] . "</td><td>" . $row["genre"] . "</td><td>" . $row["libelle"] . "</td><td>" . $row["artiste"] . "</td><td>" . $row["prix"] . "</td><td><img src='Images/" . $row["chemin"] . "' alt='Image du produit' width='150'></td><td><a href='modifier_produit_info.html?id_modifier=" . $row["id"] . "'>Modifier</a></td><td><form method='post'><input type='hidden' name='id_supprimer' value='" . $row["id"] . "'><input type='submit' name='supprimer' value='Supprimer'></form></td></tr>";
    }

    echo "</table>";
} else {
    echo "0 results";
}

// Fermer la connexion à la base de données
$conn->close();
?>
