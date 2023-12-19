<?php
session_start();

// Vérifier si le formulaire "Vider le Panier" a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["vider_panier"])) {
    // Vider le panier en réinitialisant la variable de session
    $_SESSION['panier'] = array();
}

// Vérifier si le produit a été ajouté au panier
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id_produit"])) {
    $id_produit = $_POST["id_produit"];

    // Ajouter le produit au panier (stocké dans la variable de session)
    if (!in_array($id_produit, $_SESSION['panier'])) {
        $_SESSION['panier'][] = $id_produit;
    }
}

$servername = "lakartxela.iutbayonne.univ-pau.fr:3306";
$username = "amoreno011_bd";
$password = "amoreno011_bd";
$dbname = "amoreno011_bd";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connexion impossible: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panier</title>
</head>
<body>

<h1>Panier</h1>
<p><a href="index.php">Retourner à la Liste des Produits</a></p>

<?php
// Afficher le contenu du panier
echo "<h2>Contenu du Panier</h2>";

if (empty($_SESSION['panier'])) {
    echo "<p>Le panier est vide.</p>";
} else {
    echo "<table border='1'><tr><th>Image</th><th>Produit ID</th><th>Genre</th><th>Libellé</th><th>Artiste</th><th>Prix</th></tr>";

    $total = 0;  // Nouvelle variable pour le total

    foreach ($_SESSION['panier'] as $id_produit) {
        // Récupérer les informations du produit à partir de la base de données
        $sql_select = "SELECT * FROM PRODUIT WHERE id = $id_produit";
        $result_select = $conn->query($sql_select);

        if ($result_select->num_rows > 0) {
            $row = $result_select->fetch_assoc();
            echo "<tr><td><img src='Images/" . $row["chemin"] . "' alt='Image du produit' width='100'></td><td>$id_produit</td><td>" . $row["genre"] . "</td><td>" . $row["libelle"] . "</td><td>" . $row["artiste"] . "</td><td>" . $row["prix"] . " €</td></tr>";
            $total += $row["prix"];  // Ajouter le prix du produit au total
        }
    }

    echo "<tr><td colspan='5' align='right'><b>Total</b></td><td><b>" . $total . " €</b></td></tr>";
    echo "</table>";

    // Ajouter un formulaire "Passer la Commande" qui redirige vers la page de paiement avec les produits du panier
    echo "<h2>Passer la Commande</h2>";
    echo "<form action='paiement.php' method='post'>";
    echo "<input type='submit' name='passer_commande' value='Passer la Commande'>";
    echo "</form>";
}
?>

<form action="" method="post">
    <input type="submit" name="vider_panier" value="Vider le Panier">
</form>

<?php
$conn->close();
?>

</body>
</html>
