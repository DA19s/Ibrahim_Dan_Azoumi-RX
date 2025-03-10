<?php
$ftp_server = "192.168.1.57";
$ftp_user = "da19";
$ftp_pass = "Ibou1324";

// Connexion au serveur FTP
$conn_id = ftp_connect($ftp_server);
if (!$conn_id) {
    die("Impossible de se connecter au serveur FTP");
}

// Connexion avec les identifiants FTP
$login_result = ftp_login($conn_id, $ftp_user, $ftp_pass);
if (!$login_result) {
    die("Échec de la connexion avec les identifiants FTP");
}

// Lister les fichiers dans le répertoire 'uploads/'
$files = ftp_nlist($conn_id, "uploads/");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FTP - Téléchargement de fichiers</title>
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

        /* Conteneur du contenu */
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
            background-color: #3498db;
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
            background-color: #2980b9;
        }

        /* Style du texte d'erreur */
        .error {
            color: #e74c3c;
            margin-top: 15px;
        }

        /* Style pour le message de succès */
        .success {
            color: #2ecc71;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Liste des fichiers à télécharger</h1>
        <?php
        if (!$files) {
            echo "<p class='error'>Aucun fichier trouvé dans le répertoire uploads.</p>";
        } else {
            echo "<p>Fichiers disponibles pour le téléchargement :</p>";
            foreach ($files as $file) {
                echo "<form action='download.php' method='POST'>";
                echo "<button type='submit' name='file' value='" . basename($file) . "'>Télécharger " . basename($file) . "</button>";
                echo "</form>";
            }
        }
        ?>
    </div>
</body>
</html>
<?php
// Fermeture de la connexion FTP
ftp_close($conn_id);
?>
