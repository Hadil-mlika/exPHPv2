<?php

// Connexion à la base de données (à adapter avec vos informations)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "planning";

$conn = new mysqli($servername, $username, $password, $dbname, 3307);


// Récupérer les données du formulaire
$email = $_POST['email'];
$mot_de_passe = $_POST['mot_de_passe'];

// Vérifier les informations d'identification du médecin
$sql = "SELECT * FROM medecins WHERE email = '$email' AND MotDePasse = '$mot_de_passe'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Authentification réussie, rediriger vers la page des rendez-vous du médecin
    echo "authentifcation succedded";
    header("Location: rendezvous_medecin.php");
    exit();
} else {
    // Authentification échouée, afficher un message d'erreur (vous pouvez rediriger vers une page d'erreur si nécessaire)
    echo "Erreur: Email ou mot de passe incorrect.";
}

// Fermer la connexion à la base de données
$conn->close();
