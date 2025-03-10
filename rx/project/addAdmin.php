<?php
require 'config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];

    $stmt = $pdo->prepare("SELECT role FROM users WHERE username = ?");
    $stmt->execute([$username]);

    // Récupérer le rôle de l'utilisateur
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && $user['role'] == 'employe') {
        echo "Cet utilisateur est déjà admin";
    } elseif ($user && $user['role'] == 'client') {
        $stmt_add = $pdo->prepare("UPDATE users SET role = 'employe' WHERE username = ?");
        $stmt_add->execute([$username]);
        
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Utilisateur inconnu ou rôle non défini.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <style>
        /* Style global */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #1a1a1a; /* Fond noir */
            color: white; /* Texte en blanc */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #2c3e50; /* Fond de la boîte de connexion */
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 400px;
        }

        h2 {
            text-align: center;
            color: #ecf0f1; /* Couleur du titre */
        }

        form {
            display: flex;
            flex-direction: column;
        }

        input[type="text"] {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }

        input[type="text"]:focus {
            border-color: #3498db;
            outline: none;
        }

        button {
            padding: 10px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #2980b9;
        }

        .message {
            text-align: center;
            color: #ecf0f1;
        }

        .message a {
            color: #3498db;
            text-decoration: none;
        }

        .message a:hover {
            text-decoration: underline;
        }

        .error-message {
            color: #e74c3c;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Connexion</h2>
        <form method="POST">
            <input type="text" name="username" placeholder="Nom d'utilisateur" required>
            <button type="submit">Valider</button>
        </form>
    </div>

</body>
</html>
