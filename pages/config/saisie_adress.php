
<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['num_addresses'] = $_POST['num_addresses'];
    header("Location: confirmation.php");
    exit();
}

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
        <h2>Saisie des adresses</h2>
        <form action="confirmation.php" method="post">
            <?php for ($i = 1; $i <= $num_addresses; $i++) : ?>
                <div class="address-form">
                    <h3>Adresse <?php echo $i; ?></h3>
                    <label for="street_<?php echo $i; ?>">Rue :</label>
                    <input type="text" name="street_<?php echo $i; ?>" maxlength="50" required>

                    <label for="street_nb_<?php echo $i; ?>">Numéro :</label>
                    <input type="number" name="street_nb_<?php echo $i; ?>" required>

                    <label for="type_<?php echo $i; ?>">Type :</label>
                    <select name="type_<?php echo $i; ?>">
                        <option value="livraison">Livraison</option>
                        <option value="facturation">Facturation</option>
                        <option value="autre">Autre</option>
                    </select>

                    <label for="city_<?php echo $i; ?>">Ville :</label>
                    <select name="city_<?php echo $i; ?>">
                        <option value="Montreal">Montreal</option>
                        <option value="Laval">Laval</option>
                       
                    </select>

                    <label for="zipcode_<?php echo $i; ?>">Code postal :</label>
                    <input type="text" name="zipcode_<?php echo $i; ?>" maxlength="6" required>
                </div>
            <?php endfor; ?>

            <button type="submit">Continuer</button>
        </form>
    </div>
</body>
</html>
