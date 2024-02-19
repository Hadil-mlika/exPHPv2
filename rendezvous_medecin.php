<?php
// Inclure ici le code de vérification d'authentification pour s'assurer que le médecin est connecté
// Si le médecin n'est pas connecté, rediriger vers la page de connexion

// ... (code de vérification d'authentification)

// Connexion à la base de données (à adapter avec vos informations)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "planning";

$conn = new mysqli($servername, $username, $password, $dbname,3307);

// Vérifier la connexion à la base de données
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Récupérer la liste des rendez-vous depuis la base de données
$sqlRendezVous = "SELECT id_rendezvous, daterendezvous FROM rendezvous";
$resultRendezVous = $conn->query($sqlRendezVous);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>LES Rendez-vous </title>
    <style>
        form {
            max-width: 600px;
            margin: 0 auto;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
        }

        select {
            padding: 5px;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>

</head>
<body>
<h1>LES Rendez-vous</h1>

<!-- Afficher la liste des rendez-vous avec des boutons pour choisir "Accepter" ou "Refuser" -->
<form action="traitement_accepter_refuser.php" method="post">
    <ul>
        <?php
        while ($row = $resultRendezVous->fetch_assoc()) {
            echo "<li>";
            echo "<span class='date'>ID: {$row['id_rendezvous']} - Date: {$row['daterendezvous']} <br> <br></span>";
            echo "<select name='decision_{$row['id_rendezvous']}'>";
            echo "<option value='accepter'>Accepté</option>";
            echo "<option value='refuser'>Refusé</option>";
            echo "</select>";
            echo "</li>";
        }

        ?>
    </ul>

    <!-- Bouton global pour valider les décisions -->
    <button type="submit">Valider</button>
</form>



<?php
// Fermer la connexion à la base de données
$conn->close();
?>
</body>
</html>
