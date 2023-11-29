<?php
// Démarrage de la session pour gérer les variables de session
session_start();

// Vérification si la requête est de type POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Connexion à la base de données avec PDO
        $bdd = new PDO("mysql:host=localhost;dbname=membre;charset=utf8", "root", "");
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Récupération des données du formulaire
        $username = htmlspecialchars($_POST['username']);
        $password = $_POST['password'];

        // Préparation d'une requête SQL avec des paramètres pour vérifier les identifiants
        $query = $bdd->prepare("SELECT * FROM utilisateurs WHERE username = :username");

        // Liaison des paramètres
        $query->bindParam(':username', $username, PDO::PARAM_STR);

        // Exécution de la requête
        $query->execute();

        // Vérification des résultats
        $user = $query->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            // Identifiants corrects, rediriger vers le tableau de bord par exemple
            $_SESSION['user_id'] = $user['id'];
            header("Location: dashboard.php");
            exit();
        } else {
            // Identifiants incorrects, afficher un message d'erreur
            $error_message = "Identifiants incorrects. Veuillez réessayer.";
        }

    } catch (PDOException $e) {
        die("Erreur : " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Définit l'encodage des caractères -->
    <meta charset="UTF-8">
    
    <!-- Permet une adaptation du contenu à la largeur de l'écran -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Lien vers la feuille de style Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Lien vers votre propre feuille de style -->
    <link rel="stylesheet" href="style.css">
    
    <!-- Titre de la page affiché dans l'onglet du navigateur -->
    <title>Connexion</title>
</head>
<body class="text-center">

    <!-- Contenu principal de la page avec une classe spécifique de Bootstrap -->
    <main class="form-signin">
        <!-- Formulaire de connexion avec action pointant vers le script "connexion.php" en méthode POST -->
        <form action="connexion.php" method="post">
            
            <!-- Logo de l'entreprise -->
            <img class="mb-4" src="logo.png" alt="" width="72" height="57">
            
            <!-- Titre du formulaire -->
            <h1 class="h3 mb-3 fw-normal">Veuillez vous connecter</h1>

            <!-- Affichage du message d'erreur s'il y en a un -->
            <?php if (isset($error_message)) : ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $error_message; ?>
                </div>
            <?php endif; ?>

            <!-- Champ de saisie pour le nom d'utilisateur -->
            <div class="form-floating">
                <input type="text" name="username" class="form-control" id="floatingInput" placeholder="Nom d'utilisateur" required>
                <label for="floatingInput">Nom d'utilisateur</label>
            </div>
            
            <!-- Champ de saisie pour le mot de passe -->
            <div class="form-floating">
                <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Mot de passe" required>
                <label for="floatingPassword">Mot de passe</label>
            </div>

            <!-- Bouton de soumission du formulaire -->
            <button class="w-100 btn btn-lg btn-primary" type="submit">Se connecter</button>
            
            <!-- Mention de copyright -->
            <p class="mt-3 mb-3 text-muted">&copy; 2023</p>
        </form>
    </main>

</body>
</html>
