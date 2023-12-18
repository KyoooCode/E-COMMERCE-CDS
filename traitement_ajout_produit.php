<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $genre = $_POST["genre"];
    $libelle = $_POST["libelle"];
    $artiste = $_POST["artiste"];
    $prix = $_POST["prix"];

    // Connexion à la base de données
    $servername = "lakartxela.iutbayonne.univ-pau.fr:3306";
    $dbUsername = "amoreno011_bd";
    $dbPassword = "amoreno011_bd";
    $dbName = "amoreno011_bd";

    $conn = new mysqli($servername, $dbUsername, $dbPassword, $dbName);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Gestion de l'upload de l'image
    $targetDir = "Images/";
    $targetFile = $targetDir . basename($_FILES["image"]["name"]);

    // Si tout est ok, uploader le fichier
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
        echo "Le fichier " . basename($_FILES["image"]["name"]) . " a été téléchargé.";
        // Insérer le nouveau produit dans la base de données
        $chemin = basename($_FILES["image"]["name"]);
        $sql = "INSERT INTO PRODUIT (genre, libelle, artiste, prix, chemin) VALUES ('$genre', '$libelle', '$artiste', '$prix', '$chemin')";

        if ($conn->query($sql) === TRUE) {
            echo "Produit ajouté avec succès !";
            // Ajouter des liens vers la page gestion
            echo "<br><a href='gestion.html'>Aller à la page Gestion</a>";
            echo "<br><a href='ajouter_produit.html'>Ajouter un autre produit</a>";
            echo "<br><a href='modifier_produit.php'>Modifier un produit</a>";
            echo "<br><a href='index.php'>Se déconnecter</a>";
        } else {
            echo "Erreur lors de l'ajout du produit : " . $conn->error;
        }
    } else {
        echo "Erreur lors du téléchargement du fichier.";
    }

    // Fermer la connexion à la base de données
    $conn->close();
}
?>
