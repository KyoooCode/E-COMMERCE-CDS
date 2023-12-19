<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les identifiants du formulaire
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Connexion à la base de données
    $servername = "lakartxela.iutbayonne.univ-pau.fr:3306";
    $dbUsername = "amoreno011_bd";
    $dbPassword = "amoreno011_bd";
    $dbName = "amoreno011_bd";

    $conn = new mysqli($servername, $dbUsername, $dbPassword, $dbName);

    if ($conn->connect_error) {
        die("Connexion impossible: " . $conn->connect_error);
    }

    // Requête pour vérifier les identifiants dans la base de données
    $sql = "SELECT * FROM UTILISATEUR WHERE login = '$username' AND mdp = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Si les identifiants correspondent, rediriger vers la page de gestion
        session_start();
        $_SESSION['login'] = $username;
        $_SESSION['pwd'] = $password;
        header("Location: gestion.php");
        exit();
    } else {
        // Si les identifiants ne correspondent pas, rediriger vers une page d'erreur
        print("Identifiant ou mot de passe incorrect(s)");
        print "<br><a href='connexion.php'>Réessayer</a>";
        print "<br><a href='index.php'>Annuler</a>";
    }

    // Fermer la connexion à la base de données
    $conn->close();
}
?>
