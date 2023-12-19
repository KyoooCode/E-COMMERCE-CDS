<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["passer_commande"])) {
    $panier = $_SESSION['panier'];
} else {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paiement</title>
</head>
<body>

<h1>Paiement</h1>
<p><a href="panier.php">Annuler</a></p>
<?php
// Afficher les produits du panier
echo "<h2>Produits à Payer</h2>";
echo "<table border='1'><tr><th>Produit ID</th><th>Genre</th><th>Libellé</th><th>Artiste</th><th>Prix</th></tr>";

$servername = "lakartxela.iutbayonne.univ-pau.fr:3306";
$username = "amoreno011_bd";
$password = "amoreno011_bd";
$dbname = "amoreno011_bd";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connexion impossible: " . $conn->connect_error);
}

$total = 0;  // Nouvelle variable pour le total

foreach ($panier as $id_produit) {
    $sql_select = "SELECT * FROM PRODUIT WHERE id = $id_produit";
    $result_select = $conn->query($sql_select);

    if ($result_select->num_rows > 0) {
        $row = $result_select->fetch_assoc();
        echo "<tr><td>$id_produit</td><td>" . $row["genre"] . "</td><td>" . $row["libelle"] . "</td><td>" . $row["artiste"] . "</td><td>" . $row["prix"] . " €</td></tr>";
        $total += $row["prix"];  // Ajouter le prix du produit au total
    }
}

echo "<tr><td colspan='4' align='right'><b>Total</b></td><td><b>" . $total . " €</b></td></tr>";
echo "</table>";

// Formulaire de paiement simulé
echo "<h2>Formulaire de Paiement</h2>";
echo "<form action='simuler_paiement.php' method='post'>";
echo "<label for='nom'>Nom:</label><br>";
echo "<input type='text' id='nom' name='nom' required><br>";
echo "<label for='prenom'>Prénom:</label><br>";
echo "<input type='text' id='prenom' name='prenom' required><br>";
echo "<label for='rue'>Nom de Rue:</label><br>";
echo "<input type='text' id='rue' name='rue' required><br>";
echo "<label for='numero'>Numéro:</label><br>";
echo "<input type='text' id='numero' name='numero' required><br>";
echo "<label for='ville'>Ville:</label><br>";
echo "<input type='text' id='ville' name='ville' required><br>";
echo "<label for='code_postal'>Code Postal:</label><br>";
echo "<input type='text' id='code_postal' name='code_postal' required><br>";
echo "<label for='pays'>Pays:</label><br>";
echo "<input type='text' id='pays' name='pays' required><br>";
echo "<label for='numero_carte'>Numéro de Carte:</label><br>";
echo "<input type='text' id='numero_carte' name='numero_carte' required><br>";
echo "<label for='numero_cvc'>Numéro CVC:</label><br>";
echo "<input type='text' id='numero_cvc' name='numero_cvc' required><br>";
echo "<label for='date_expiration'>Date d'Expiration:</label><br>";
echo "<select id='mois_expiration' name='mois_expiration' required>";
for ($mois = 1; $mois <= 12; $mois++) {
    echo "<option value='$mois'>$mois</option>";
}
echo "</select>";
echo "<select id='annee_expiration' name='annee_expiration' required>";
$annee_actuelle = date("Y");
for ($annee = $annee_actuelle; $annee <= $annee_actuelle + 10; $annee++) {
    echo "<option value='$annee'>$annee</option>";
}
echo "</select><br>";
echo "<input type='submit' name='commander' value='Passer la Commande'>";
echo "</form>";

$conn->close();
?>

</body>
</html>
