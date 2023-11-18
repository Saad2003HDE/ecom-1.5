<!-- index.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Nombre d'adresses</title>
</head>
<body>
    <div class="container">
        <h2>Combien d'adresses souhaitez-vous saisir ?</h2>
        <form action="saisie_adresses.php" method="post">
            <input type="number" name="num_addresses" required>
            <button type="submit">Continuer</button>
        </form>
    </div>
</body>
</html>

