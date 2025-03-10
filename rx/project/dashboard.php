<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color:rgb(8, 2, 2);
            text-align: center;
            margin: 50px;
        }

        .container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            display: inline-block;
        }

        h1 {
            color: #333;
        }

        .link-container {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        a {
            display: block;
            background: #007BFF;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            transition: 0.3s;
        }

        a:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Gestion iRedMail</h1>
        <div class="link-container">
            <a href="https://smarttech.sn/iredadmin">IredAdmin</a>
            <a href="https://smarttech.sn/mail">IredMail</a>
            <a href="upload_file.php">Upload un fichier sur le serveur FTP</a>
            <a href="read_uploads.php">Télécharger un fichier sur le serveur FTP</a>
            <a href="delete_ftp.php">Supprimer un fichier sur le serveur FTP</a>
            <a href="ssh_interface.php">Connexion SSH</a>
            <a href="vnc.html">Connexion VNC</a>
            <a href="addAdmin.php">Ajouter un admin</a>
            <a href="update.php">Modifier un user</a>
            <a href="delete.php">Supprmier un user</a>
        </div>
    </div>

</body>
</html>
