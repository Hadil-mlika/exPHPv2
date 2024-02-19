<?php
// Connexion à la base de données (à adapter avec vos informations)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "planning";

$conn = new mysqli($servername, $username, $password, $dbname, 3307);

// Vérifier la connexion à la base de données
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Récupérer les données du formulaire
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$numero_telephone = $_POST['numero_telephone'];
$date_rendezvous = $_POST['date_rendezvous'];
$email = $_POST['email'];


// 1ère instruction d'insertion dans la table utilisateurs
$sql1 = "INSERT INTO utilisateurs (nom, prenom, email, telephone) VALUES ('$nom', '$prenom', '$email', '$numero_telephone')";

if ($conn->query($sql1) === TRUE) {
    // Récupérer l'id_utilisateur de l'utilisateur nouvellement ajouté
    $id_utilisateur = $conn->insert_id;

    // 2ème instruction d'insertion dans la table rendez_vous
    $sql2 = "INSERT INTO rendezvous (ID_Utilisateur, DateRendezVous	) VALUES ('$id_utilisateur', '$date_rendezvous')";

    if ($conn->query($sql2) === TRUE) {
        echo "Rendez-vous ajouté avec succès!";
    } else {
        echo "Erreur lors de l'insertion dans la table rendez_vous: " . $conn->error;
    }
} else {
    echo "Erreur lors de l'insertion dans la table utilisateurs: " . $conn->error;
}

// Fermer la connexion à la base de données
$conn->close();
