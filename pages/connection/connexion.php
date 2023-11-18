<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Connexion à la base de données avec PDO
    try {
        $bdd = new PDO("mysql:host=localhost;dbname=membre;charset=utf8", "root", "");
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Récupérer les données du formulaire
        $username = htmlspecialchars($_POST['username']);
        $password = $_POST['password'];

        // Préparer une requête SQL avec des paramètres pour vérifier les identifiants
        $query = $bdd->prepare("SELECT * FROM utilisateurs WHERE username = :username");

        // Liaison des paramètres
        $query->bindParam(':username', $username, PDO::PARAM_STR);

        // Exécuter la requête
        $query->execute();

        // Vérifier les résultats
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Connexion</title>
</head>
<body class="text-center">

    <main class="form-signin">
        <form action="connexion.php" method="post">
            <img class="mb-4" src="logo.png" alt="" width="72" height="57">
            <h1 class="h3 mb-3 fw-normal">Veuillez vous connecter</h1>

            <?php if (isset($error_message)) : ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $error_message; ?>
                </div>
            <?php endif; ?>

            <div class="form-floating">
                <input type="text" name="username" class="form-control" id="floatingInput" placeholder="Nom d'utilisateur" required>
                <label for="floatingInput">Nom d'utilisateur</label>
            </div>
            <div class="form-floating">
                <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Mot de passe" required>
                <label for="floatingPassword">Mot de passe</label>
            </div>

            <button class="w-100 btn btn-lg btn-primary" type="submit">Se connecter</button>
            <p class="mt-3 mb-3 text-muted">&copy; 2023</p>
        </form>
    </main>

</body>
</html>

