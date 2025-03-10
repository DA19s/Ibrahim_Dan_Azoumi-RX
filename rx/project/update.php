<?php
require 'config.php';

// Récupération des utilisateurs
$stmt = $pdo->query("SELECT username, nom, prenom, email FROM users");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification des utilisateurs</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #2e2e2e;
            color: white;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .container {
            background-color: #333;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            text-align: center;
            width: 80%;
            max-width: 600px;
        }

        h1 {
            color: #f39c12;
            margin-bottom: 20px;
        }

        .user-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .user-button {
            background-color: #3498db;
            border: none;
            color: white;
            padding: 12px 20px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
            font-size: 16px;
            text-align: left;
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
        }

        .user-button:hover {
            background-color: #2980b9;
        }

        .edit-button {
            background-color: #f39c12;
            border: none;
            color: white;
            padding: 10px;
            margin-left: 10px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .edit-button:hover {
            background-color: #e67e22;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Modifier un utilisateur</h1>

        <div class="user-list">
            <?php foreach ($users as $user) : ?>
                <form method="GET" action="edit_user.php">
                    <button type="submit" class="user-button" name="username" value="<?php echo htmlspecialchars($user['username']); ?>">
                        <?php echo htmlspecialchars($user['username'] . " - " . $user['nom'] . " " . $user['prenom'] . " - " . $user['email']); ?>
                        <span class="edit-button">Modifier</span>
                    </button>
                </form>
            <?php endforeach; ?>
        </div>
    </div>

</body>
</html>
