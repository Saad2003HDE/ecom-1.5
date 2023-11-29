<?php
// Démarre la session PHP pour utiliser les variables de session
session_start();

// Vérifie si la requête est de type POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Stocke le nombre d'adresses dans la variable de session
    $_SESSION['num_addresses'] = $_POST['num_addresses'];
    // Redirige l'utilisateur vers la page de confirmation
    header("Location: confirmation.php");
    // Termine l'exécution du script
    exit();
}

// Initialise la variable $num_addresses avec la valeur stockée dans la session ou 0 si elle n'existe pas
$num_addresses = isset($_SESSION['num_addresses']) ? $_SESSION['num_addresses'] : 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Saisie des adresses</title>
</head>
<body>
    <div class="container">
        <!-- Titre de la page -->
        <h2>Saisie des adresses</h2>

        <!-- Formulaire pour la saisie des adresses -->
        <form action="confirmation.php" method="post">

            <!-- Boucle pour générer le formulaire en fonction du nombre d'adresses -->
            <?php for ($i = 1; $i <= $num_addresses; $i++) : ?>
                <div class="address-form">
                    <!-- Titre de la section d'adresse -->
                    <h3>Adresse <?php echo $i; ?></h3>

                    <!-- Champ de saisie pour la rue -->
                    <label for="street_<?php echo $i; ?>">Rue :</label>
                    <input type="text" name="street_<?php echo $i; ?>" maxlength="50" required>

                    <!-- Champ de saisie pour le numéro de rue -->
                    <label for="street_nb_<?php echo $i; ?>">Numéro :</label>
                    <input type="number" name="street_nb_<?php echo $i; ?>" required>

                    <!-- Sélection du type d'adresse -->
                    <label for="type_<?php echo $i; ?>">Type :</label>
                    <select name="type_<?php echo $i; ?>">
                        <option value="livraison">Livraison</option>
                        <option value="facturation">Facturation</option>
                        <option value="autre">Autre</option>
                    </select>

                    <!-- Sélection de la ville -->
                    <label for="city_<?php echo $i; ?>">Ville :</label>
                    <select name="city_<?php echo $i; ?>">
                        <option value="Montreal">Montreal</option>
                        <option value="Laval">Laval</option>
                    </select>

                    <!-- Champ de saisie pour le code postal -->
                    <label for="zipcode_<?php echo $i; ?>">Code postal :</label>
                    <input type="text" name="zipcode_<?php echo $i; ?>" maxlength="6" required>
                </div>
            <?php endfor; ?>

            <!-- Bouton de soumission du formulaire -->
            <button type="submit">Continuer</button>
        </form>
    </div>
</body>
</html>
