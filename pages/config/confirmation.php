<?php
// Démarre la session PHP pour utiliser les variables de session
session_start();

// Vérifie si la requête est de type POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        // Établissement de la connexion à la base de données MySQL
        $bdd = new PDO("mysql:host=localhost;dbname=adress;charset=utf8", "root", "");
        
        // Configuration de PDO pour afficher les erreurs
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Boucle pour insérer chaque adresse dans la base de données
        for ($i = 1; $i <= $_SESSION['num_addresses']; $i++) {
            $street = $_POST["street_$i"];
            $street_nb = $_POST["street_nb_$i"];
            $type = $_POST["type_$i"];
            $city = $_POST["city_$i"];
            $zipcode = $_POST["zipcode_$i"];

            // Préparation de la requête SQL d'insertion
            $query = $bdd->prepare("INSERT INTO adresses (street, street_nb, type, city, zipcode) VALUES (?, ?, ?, ?, ?)");
            
            // Exécution de la requête avec les valeurs des adresses
            $query->execute([$street, $street_nb, $type, $city, $zipcode]);
        }

        // Redirection vers la page de confirmation finale
        header("Location: confirmation_finale.php");
        // Termine l'exécution du script
        exit();
    } catch (PDOException $e) {
        // Gestion des erreurs de la base de données
        die("Erreur : " . $e->getMessage());
    }
}

// Initialise la variable $num_addresses avec la valeur stockée dans la session ou 0 si elle n'existe pas
$num_addresses = isset($_SESSION['num_addresses']) ? $_SESSION['num_addresses'] : 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Définit l'encodage des caractères -->
    <meta charset="UTF-8">
    
    <!-- Permet une adaptation du contenu à la largeur de l'écran -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Lien vers la feuille de style externe -->
    <link rel="stylesheet" href="style.css">
    
    <!-- Titre de la page affiché dans l'onglet du navigateur -->
    <title>Confirmation des adresses</title>
</head>
<body>
    <!-- Conteneur principal de la page -->
    <div class="container">
        
        <!-- Titre principal de la page -->
        <h2>Confirmation des adresses</h2>
        
        <!-- Message indiquant que les adresses ont été saisies -->
        <p>Les adresses suivantes ont été saisies :</p>
        
        <!-- Boucle pour afficher les détails de chaque adresse saisie -->
        <?php for ($i = 1; $i <= $num_addresses; $i++) : ?>
            <div class="confirmation-address">
                <!-- Affiche le numéro et le titre de l'adresse -->
                <strong>Adresse <?php echo $i; ?>:</strong>
                <!-- Affichez ici les détails de l'adresse (rue, numéro, type, ville, code postal) -->
            </div>
        <?php endfor; ?>

        <!-- Message demandant la confirmation des informations -->
        <p>Confirmez-vous ces informations ?</p>
        
        <!-- Formulaire pour confirmer les informations ou les modifier -->
        <form action="confirmation.php" method="post">
            <!-- Bouton de confirmation -->
            <button type="submit">Confirmer</button>
            <!-- Lien pour revenir à la page de saisie d'adresses et modifier les informations -->
            <a href="saisie_adresses.php">Modifier les informations</a>
        </form>
    </div>
</body>
</html>

