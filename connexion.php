<?php
    session_start();

    if(isset($_SESSION['login']) && isset($_SESSION['pwd'])) {
        header('location: gestion.php');
        die;
    }

?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Connexion</title>
</head>
<body>
  <h2>Connexion</h2>
  <form action="verification.php" method="post">
    <label for="username">Nom d'utilisateur:</label>
    <input type="text" id="username" name="username" required><br>

    <label for="password">Mot de passe:</label>
    <input type="password" id="password" name="password" required><br>

    <input type="submit" value="Se connecter">
  </form>
  <p><br><a href="index.php">Annuler</a></p>
</body>
</html>
