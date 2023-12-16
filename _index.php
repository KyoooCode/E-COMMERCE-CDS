<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Produits</title>
</head>
<body>

<?php
$servername = "lakartxela.iutbayonne.univ-pau.fr:3306";
$username = "amoreno011_bd";
$password = "amoreno011_bd";
$dbname = "amoreno011_bd";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM PRODUIT";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'><tr><th>ID</th><th>Genre</th><th>Libellé</th><th>Artiste</th><th>Prix</th><th>Image</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["id"] . "</td><td>" . $row["genre"] . "</td><td>" . $row["libelle"] . "</td><td>" . $row["artiste"] . "</td><td>" . $row["prix"] . "</td><td><img src='Images/" . $row["chemin"] . "' alt='Image du produit' width='150' ></td></tr>";
    }

    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();
?>

</body>
</html>
