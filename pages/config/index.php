<!-- index.php -->
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
    <title>Nombre d'adresses</title>
</head>
<body>
    <!-- Conteneur principal de la page -->
    <div class="container">
        
        <!-- Titre principal de la page -->
        <h2>Combien d'adresses souhaitez-vous saisir ?</h2>
        
        <!-- Formulaire pour saisir le nombre d'adresses -->
        <form action="saisie_adresses.php" method="post">
            
            <!-- Champ de saisie pour le nombre d'adresses avec une contrainte de saisie obligatoire -->
            <input type="number" name="num_addresses" required>
            
            <!-- Bouton de soumission du formulaire -->
            <button type="submit">Continuer</button>
        </form>
    </div>
</body>
</html>
