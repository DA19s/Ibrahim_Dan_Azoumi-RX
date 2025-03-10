<?php
require 'config.php';

if (!isset($_GET['username'])) {
    die("Aucun utilisateur sélectionné.");
}

$username = $_GET['username'];

// Récupération des infos de l'utilisateur
$stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
$stmt->execute([$username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    die("Utilisateur introuvable.");
}

// Traitement de la modification
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $new_nom = $_POST['nom'];
    $new_prenom = $_POST['prenom'];
    $new_email = $_POST['email'];

    $stmt = $pdo->prepare("UPDATE users SET nom = ?, prenom = ?, email = ? WHERE username = ?");
    if ($stmt->execute([$new_nom, $new_prenom, $new_email, $username])) {
        $message = "Utilisateur mis à jour avec succès.";
        // Rafraîchir les données
        $user['nom'] = $new_nom;
        $user['prenom'] = $new_prenom;
        $user['email'] = $new_email;
    } else {
        $message = "Erreur lors de la mise à jour.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier utilisateur</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #2e2e2e;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #333;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            text-align: center;
            width: 80%;
            max-width: 400px;
        }

        h1 {
            color: #f39c12;
        }

        input, button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
            font-size: 16px;
        }

        input {
            background-color: #444;
            color: white;
        }

        button {
            background-color: #3498db;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #2980b9;
        }

        .message {
            color: #2ecc71;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Modifier <?php echo htmlspecialchars($user['username']); ?></h1>

        <?php if (isset($message)) : ?>
            <p class="message"><?php echo $message; ?></p>
        <?php endif; ?>

        <form method="POST">
            <input type="text" name="nom" value="<?php echo htmlspecialchars($user['nom']); ?>" required>
            <input type="text" name="prenom" value="<?php echo htmlspecialchars($user['prenom']); ?>" required>
            <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            <button type="submit">Mettre à jour</button>
        </form>
    </div>

</body>
</html>
