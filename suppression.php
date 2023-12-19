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

// Vérifier si le formulaire de suppression a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id_supprimer"])) {
    $id_supprimer = $_POST["id_supprimer"];

    // Récupérer le nom du fichier image pour le supprimer du dossier
    $sql_select_image = "SELECT chemin FROM PRODUIT WHERE id = $id_supprimer";
    $result_select_image = $conn->query($sql_select_image);

    if ($result_select_image->num_rows > 0) {
        $row_image = $result_select_image->fetch_assoc();
        $image_path = $row_image["chemin"];

        // Supprimer l'image du dossier
        $full_path = "Images/" . $image_path;
        if (file_exists($full_path)) {
            unlink($full_path);
        }
    }

    // Supprimer le produit de la base de données
    $sql_delete = "DELETE FROM PRODUIT WHERE id=$id_supprimer";

    if ($conn->query($sql_delete) === TRUE) {
        echo "Produit supprimé avec succès !";
    } else {
        echo "Erreur lors de la suppression du produit : " . $conn->error;
    }
    print "<br><a href='gestion.php'>Retourner à la page de gestion</a>";
    print "<br><a href='ajouter_produit.php'>Ajouter un produit</a>";
    print "<br><a href='modifier_produit.php'>Modifier ou supprimer un autre produit</a>";
    print "<br><a href='deconnexion.php'>Se déconnecter</a>";
}

// Fermer la connexion à la base de données
$conn->close();
?>
