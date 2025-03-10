<?php
// Configuration FTP
$ftp_server = "192.168.1.57"; // Adresse du serveur FTP
$ftp_user = "da19"; // Identifiant FTP
$ftp_pass = "Ibou1324"; // Mot de passe FTP
$ftp_directory = "uploads/"; // Répertoire contenant les fichiers

// Connexion FTP
$conn_id = ftp_connect($ftp_server);
if (!$conn_id) {
    die("Impossible de se connecter au serveur FTP");
}

// Connexion avec les identifiants FTP
$login_result = ftp_login($conn_id, $ftp_user, $ftp_pass);
if (!$login_result) {
    die("Échec de la connexion avec les identifiants FTP");
}

// Suppression de fichier si demandé
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["file"])) {
    $file_to_delete = $ftp_directory . $_POST["file"];
    if (ftp_delete($conn_id, $file_to_delete)) {
        $message = "<p class='success'>Fichier supprimé avec succès : " . htmlspecialchars($_POST["file"]) . "</p>";
    } else {
        $message = "<p class='error'>Erreur lors de la suppression de : " . htmlspecialchars($_POST["file"]) . "</p>";
    }
}

// Lister les fichiers dans le répertoire
$files = ftp_nlist($conn_id, $ftp_directory);

// Fermeture de la connexion FTP
ftp_close($conn_id);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FTP - Gestion des fichiers</title>
    <style>
        /* Style général */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #2e2e2e;
            color: white;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Conteneur principal */
        .container {
            background-color: #333;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            text-align: center;
            width: 80%;
            max-width: 600px;
        }

        /* Style des titres */
        h1 {
            color: #f39c12;
            margin-bottom: 20px;
        }

        /* Style des boutons */
        button {
            background-color: #e74c3c;
            border: none;
            color: white;
            padding: 12px 20px;
            margin: 10px 0;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
            width: 200px;
            font-size: 16px;
        }

        button:hover {
            background-color: #c0392b;
        }

        /* Style des messages */
        .success {
            color: #2ecc71;
            font-weight: bold;
        }

        .error {
            color: #e74c3c;
            font-weight: bold;
        }

        /* Style des fichiers */
        .file-container {
            margin: 10px 0;
            padding: 10px;
            background-color: #444;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Gestion des fichiers FTP</h1>

        <!-- Affichage des messages -->
        <?php if (isset($message)) echo $message; ?>

        <?php if (!$files): ?>
            <p class='error'>Aucun fichier trouvé dans le répertoire.</p>
        <?php else: ?>
            <p>Fichiers disponibles :</p>
            <?php foreach ($files as $file): ?>
                <div class="file-container">
                    <p><?php echo htmlspecialchars(basename($file)); ?></p>
                    <form method="POST">
                        <input type="hidden" name="file" value="<?php echo htmlspecialchars(basename($file)); ?>">
                        <button type="submit">🗑️ Supprimer</button>
                    </form>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</body>
</html>
