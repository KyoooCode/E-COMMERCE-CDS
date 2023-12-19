<?php
    session_start();

    if(isset($_SESSION['login']) && isset($_SESSION['pwd'])) {
        header('location: gestion.php');
        die;
    }

    // Initialiser le panier s'il n'existe pas encore dans la session
    if (!isset($_SESSION['panier'])) {
        $_SESSION['panier'] = array();
    }

    // Vérifier si le formulaire "Ajouter au Panier" a été soumis
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id_produit"])) {
        $id_produit = $_POST["id_produit"];

        // Ajouter le produit au panier (stocké dans la variable de session)
        if (!in_array($id_produit, $_SESSION['panier'])) {
            $_SESSION['panier'][] = $id_produit;
        }
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tous les Produits</title>
</head>
<body>

<h1>Tous les Produits</h1>
<p><a href="connexion.php">Connexion</a></p>
<p><a href="panier.php">Panier</a></p>
<?php
$servername = "lakartxela.iutbayonne.univ-pau.fr:3306";
$username = "amoreno011_bd";
$password = "amoreno011_bd";
$dbname = "amoreno011_bd";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connexion impossible: " . $conn->connect_error);
}

$sql = "SELECT id, genre, libelle, artiste, prix, chemin FROM PRODUIT";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'><tr><th>Genre</th><th>Libellé</th><th>Artiste</th><th>Prix</th><th>Image</th><th>Ajouter au Panier</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["genre"] . "</td><td>" . $row["libelle"] . "</td><td>" . $row["artiste"] . "</td><td>" . $row["prix"] . "</td><td><img src='Images/" . $row["chemin"] . "' alt='Image du produit' width='150'></td><td>";
        echo "<form action='' method='post'>";
        echo "<input type='hidden' name='id_produit' value='" . $row["id"] . "'>";
        echo "<input type='submit' value='Ajouter'></form></td></tr>";
    }

    echo "</table>";
} else {
    echo "Aucun produit disponible.";
}

$conn->close();
?>

</body>
</html>
