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
    $genre_modif = $_POST["genre"];
    $libelle_modif = $_POST["libelle"];
    $artiste_modif = $_POST["artiste"];
    $prix_modif = $_POST["prix"];

    // Récupérer le nom de l'ancienne image
    $sql_select_old_image = "SELECT chemin FROM PRODUIT WHERE id = $id_modifier";
    $result_select_old_image = $conn->query($sql_select_old_image);

    if ($result_select_old_image->num_rows > 0) {
        $row_old_image = $result_select_old_image->fetch_assoc();
        $old_image_path = $row_old_image["chemin"];

        // Supprimer l'ancienne image du dossier /Images
        if (file_exists("Images/" . $old_image_path)) {
            unlink("Images/" . $old_image_path);
        }
    }

    // Télécharger la nouvelle image
    if ($_FILES["image"]["error"] == 0) {
        $new_image_path = "Images/" . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], $new_image_path);

        // Effectuer la mise à jour dans la base de données avec la nouvelle image
        $sql_update = "UPDATE PRODUIT SET genre='$genre_modif', libelle='$libelle_modif', artiste='$artiste_modif', prix=$prix_modif, chemin='" . basename($_FILES["image"]["name"]) . "' WHERE id=$id_modifier";
    } else {
        // Effectuer la mise à jour dans la base de données sans changer l'image
        $sql_update = "UPDATE PRODUIT SET genre='$genre_modif', libelle='$libelle_modif', artiste='$artiste_modif', prix=$prix_modif WHERE id=$id_modifier";
    }

    if ($conn->query($sql_update) === TRUE) {
        echo "Produit modifié avec succès !";
        echo "<br><a href='gestion.php'>Aller à la page de gestion</a>";
        echo "<br><a href='ajouter_produit.php'>Ajouter un produit</a>";
        echo "<br><a href='modifier_produit.php'>Modifier un autre produit</a>";
        echo "<br><a href='deconnexion.php'>Se déconnecter</a>";
    } else {
        echo "Erreur lors de la modification du produit : " . $conn->error;
    }
}

// Fermer la connexion à la base de données
$conn->close();
?>
