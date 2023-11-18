
<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $bdd = new PDO("mysql:host=localhost;dbname=adress;charset=utf8", "root", "");
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        for ($i = 1; $i <= $_SESSION['num_addresses']; $i++) {
            $street = $_POST["street_$i"];
            $street_nb = $_POST["street_nb_$i"];
            $type = $_POST["type_$i"];
            $city = $_POST["city_$i"];
            $zipcode = $_POST["zipcode_$i"];

            $query = $bdd->prepare("INSERT INTO adresses (street, street_nb, type, city, zipcode) VALUES (?, ?, ?, ?, ?)");
            $query->execute([$street, $street_nb, $type, $city, $zipcode]);
        }

        header("Location: confirmation_finale.php");
        exit();
    } catch (PDOException $e) {
        die("Erreur : " . $e->getMessage());
    }
}

$num_addresses = isset($_SESSION['num_addresses']) ? $_SESSION['num_addresses'] : 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Confirmation des adresses</title>
</head>
<body>
    <div class="container">
        <h2>Confirmation des adresses</h2>
        <p>Les adresses suivantes ont été saisies :</p>
        <?php for ($i = 1; $i <= $num_addresses; $i++) : ?>
            <div class="confirmation-address">
                <strong>Adresse <?php echo $i; ?>:</strong>
                <!-- Affichez ici les détails de l'adresse (rue, numéro, type, ville, code postal) -->
            </div>
        <?php endfor; ?>

        <p>Confirmez-vous ces informations ?</p>
        <form action="confirmation.php" method="post">
            <button type="submit">Confirmer</button>
            <a href="saisie_adresses.php">Modifier les informations</a>
        </form>
    </div>
</body>
</html>
