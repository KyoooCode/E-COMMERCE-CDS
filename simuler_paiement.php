<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["commander"])) {

    $mois_expiration = $_POST['mois_expiration'];
    $annee_expiration = $_POST['annee_expiration'];

    // Simulation du paiement
    $current_date = date("Y-m");
    $date_expiration = $annee_expiration . "-" . str_pad($mois_expiration, 2, '0', STR_PAD_LEFT);

    if (strtotime($date_expiration) < strtotime($current_date)) {
        echo "Carte expirée."; 
        print "<br><a href='paiement.php'>Réessayer</a> ";
        print "<br><a href='index.php'>Liste de tous les Produits</a> ";
        print "<br><a href='panier.php'>Panier</a>";
    } else {
        echo "Paiement réussi.";
        print "<br><a href='index.php'>Liste de tous les Produits</a> ";
        // Réinitialiser le panier
        $_SESSION['panier'] = array();
    }
} else {
    header("Location: index.php");
    exit();
}
?>