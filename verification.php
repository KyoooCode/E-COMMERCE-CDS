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
        die("Connection failed: " . $conn->connect_error);
    }

    // Prévenir les attaques par injection SQL
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    // Requête pour vérifier les identifiants dans la base de données
    $sql = "SELECT * FROM UTILISATEUR WHERE login = '$username' AND mdp = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Si les identifiants correspondent, rediriger vers la page de gestion
        header("Location: gestion.html");
        exit();
    } else {
        // Si les identifiants ne correspondent pas, rediriger vers la page d'erreur
        header("Location: IdIncorrects.html");
        exit();
    }

    // Fermer la connexion à la base de données
    $conn->close();
}
?>
