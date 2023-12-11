<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Récupérer les identifiants du formulaire
  $username = $_POST["username"];
  $password = $_POST["password"];

  // Charger le fichier JSON
  $jsonFile = file_get_contents("utilisateurs.json");
  $users = json_decode($jsonFile, true);

  // Vérifier les identifiants
  foreach ($users["admins"] as $user) {
    if ($user["username"] === $username && $user["password"] === $password) {
      header("Location: bienvenue.html");
      exit();
    }
  }

  // Si les identifiants ne correspondent pas, afficher un message
  header("Location: IdIncorrects.html");
  exit();

}
?>
