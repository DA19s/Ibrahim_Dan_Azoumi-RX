<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload de fichier via FTP</title>
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

        /* Style des champs de formulaire */
        input[type="file"] {
            padding: 10px;
            background-color: #444;
            color: white;
            border: none;
            border-radius: 5px;
            width: 100%;
            margin-bottom: 20px;
            cursor: pointer;
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
        <h1>Formulaire de téléchargement de fichier via FTP</h1>
        <form action="upload_ftp.php" method="POST" enctype="multipart/form-data">
            <input type="file" name="file" required/>
            <button type="submit">Télécharger</button>
        </form>
    </div>

    <?php
    $ftp_server = "192.168.1.57";
    $ftp_user = "da19";
    $ftp_pass = "Ibou1324";

    echo "<pre>";
    print_r($_FILES['file']);
    echo "</pre>";

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

    if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
        $source_file = $_FILES['file']['tmp_name'];
        $destination_file = "uploads/" . $_FILES['file']['name'];

        // Upload du fichier via FTP
        if (ftp_put($conn_id, $destination_file, $source_file, FTP_BINARY)) {
            echo "<p class='success'>Fichier envoyé avec succès.</p>";
        } else {
            echo "<p class='error'>Échec de l'envoi du fichier.</p>";
        }
    } else {
        echo "<p class='error'>Aucun fichier téléchargé ou erreur lors du téléchargement.</p>";
    }

    // Fermeture de la connexion FTP
    ftp_close($conn_id);
    ?>
</body>
</html>
