<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Téléchargement de fichier FTP</title>
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
            width: 80%;
            max-width: 600px;
            text-align: center;
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
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
            font-size: 16px;
            margin-top: 20px;
        }

        button:hover {
            background-color: #2980b9;
        }

        /* Style des messages */
        .message {
            font-size: 18px;
            margin-top: 20px;
        }

        .error {
            color: #e74c3c;
        }

        .success {
            color: #2ecc71;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Fichier à télécharger depuis FTP</h1>

        <?php
        ini_set('display_errors', 1);
        error_reporting(E_ALL);

        $ftp_server = "192.168.1.57";
        $ftp_user = "da19";
        $ftp_pass = "Ibou1324";
        $download_path = '/var/www/html/downloads/'; // Répertoire de téléchargement

        // Connexion au serveur FTP
        $conn_id = ftp_connect($ftp_server);
        if (!$conn_id) {
            die("<p class='message error'>Impossible de se connecter au serveur FTP.</p>");
        } else {
            echo "<p class='message success'>Connexion FTP réussie.</p>";
        }

        // Connexion avec les identifiants FTP
        $login_result = ftp_login($conn_id, $ftp_user, $ftp_pass);
        if (!$login_result) {
            die("<p class='message error'>Échec de la connexion avec les identifiants FTP.</p>");
        } else {
            echo "<p class='message success'>Connexion avec les identifiants FTP réussie.</p>";
        }

        // Activer le mode passif
        ftp_pasv($conn_id, true);

        if (isset($_POST['file']) && !empty($_POST['file'])) {
            $file_name = basename($_POST['file']); // Nettoyer le nom du fichier
            $local_file = $download_path . $file_name;
            $remote_file = "uploads/" . $file_name;

            // Vérifier si le répertoire de destination est accessible
            if (!is_writable($download_path)) {
                die("<p class='message error'>Le répertoire $download_path n'est pas accessible en écriture.</p>");
            }

            echo "<p class='message'>Chemin local du fichier : " . $local_file . "</p>";

            // Vérifier si le fichier existe sur le serveur FTP
            $file_size = ftp_size($conn_id, $remote_file);
            if ($file_size == -1) {
                die("<p class='message error'>Le fichier distant n'existe pas : " . $remote_file . "</p>");
            } else {
                echo "<p class='message'>Le fichier distant existe. Taille : " . $file_size . " octets.</p>";
            }

            // Télécharger le fichier
            if (ftp_get($conn_id, $local_file, $remote_file, FTP_BINARY)) {
                echo "<p class='message success'>Fichier téléchargé avec succès.</p>";

                // Vérifier si le fichier a été écrit localement
                if (file_exists($local_file)) {
                    echo "<p class='message success'>Le fichier a été écrit avec succès à l'emplacement : " . $local_file . "</p>";
                    echo "<p class='message'>Taille du fichier : " . filesize($local_file) . " octets.</p>";
                } else {
                    echo "<p class='message error'>Le fichier n'a pas été écrit à l'emplacement spécifié.</p>";
                }
            } else {
                echo "<p class='message error'>Erreur lors du téléchargement du fichier. Code d'erreur FTP : " . ftp_errno($conn_id) . " - " . ftp_last_error($conn_id) . "</p>";
            }
        } else {
            echo "<p class='message error'>Aucun fichier spécifié pour le téléchargement.</p>";
        }

        // Fermeture de la connexion FTP
        ftp_close($conn_id);
        ?>
    </div>
</body>
</html>
