<?php
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $username = $_POST['username'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Insérer l'utilisateur dans votre base de données principale (users)
    $stmt = $pdo->prepare("INSERT INTO users (nom, prenom, username, email, password) VALUES (?, ?, ?, ?, ?)");
    if ($stmt->execute([$nom, $prenom, $username, $email, $password])) {

        // Ajouter l'utilisateur dans la base de données iRedMail
        // Connexion à la base de données iRedMail (vmail)
      /*  $pdo_iredmail = new PDO('mysql:host=localhost;dbname=vmail', 'root', 'Ibou1324'); // Remplacez par vos informations de connexion

        // Extraire le domaine de l'email
        //list($local_part, $domain) = explode('@', $email);

        // Vérifier si le domaine existe déjà dans iRedMail (table domain)
        $stmt_domain = $pdo_iredmail->prepare("SELECT * FROM domain WHERE domain = ?");
        $stmt_domain->execute([$domain]);
        $domain_row = $stmt_domain->fetch();

        if (!$domain_row) {
            // Si le domaine n'existe pas, le créer (exemple simple, sans validation complète)
            $stmt_domain_insert = $pdo_iredmail->prepare("INSERT INTO domain (domain) VALUES (?)");
            $stmt_domain_insert->execute([$domain]);
        }

        // Ajouter l'utilisateur dans la table `mailbox` d'iRedMail
        $hashed_password_iredmail = password_hash($password, PASSWORD_DEFAULT); // Utiliser un mot de passe haché
        $stmt_mailbox = $pdo_iredmail->prepare("
            INSERT INTO mailbox (username, password, name, domain)
            VALUES (?, ?, ?, ?)
        ");
        $stmt_mailbox->execute([$username, $hashed_password_iredmail, $nom, $domain]);
*/
        
    } else {
        echo "Erreur lors de l'inscription.";
    }
    $stmt = $pdo->prepare("SELECT role FROM users WHERE username = ?");
$stmt->execute([$username]);

// Récupérer le rôle de l'utilisateur
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user && $user['role'] == 'employe') {
    header("Location: dashboard.php");
    exit();
} elseif ($user && $user['role'] == 'client') {
    header("Location: dasboard1.php");
    exit();
} else {
    echo "Utilisateur inconnu ou rôle non défini.";
}

    /*        $hashed_password_iredmail = password_hash($password, PASSWORD_DEFAULT); // Utiliser un mot de passe haché
    $stmt_mailbox = $pdo_iredmail->prepare("
        INSERT INTO mailbox (username, password, name, domain)
        SELECT ?, domain_id, ?, ?
        FROM domain
        WHERE domain = ?
    ");
    $stmt_mailbox->execute([$username, $email, $hashed_password_iredmail, $domain]);

    // Optionnel : ajouter des informations supplémentaires dans la table `used_quota`
    $stmt_quota = $pdo_iredmail->prepare("INSERT INTO used_quota (username, quota) VALUES (?, 0)");
    $stmt_quota->execute([$email]);

} else {
    echo "Erreur lors de l'inscription.";
}*/
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <style>
        /* Style global */
        body {
            font-family: 'Arial', sans-serif;
            background-color:rgb(26, 25, 27); /* Fond noir */
            color: white; /* Texte en blanc */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #34495e; /* Fond de la boîte d'inscription */
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

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus {
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
    </style>
</head>
<body>

    <div class="container">
        <h2>Inscription</h2>
        <form method="POST">
        <input type="text" name="nom" placeholder="Nom" required>
        <input type="text" name="prenom" placeholder="Prénom" required>
        <input type="text" name="username" placeholder="Nom d'utilisateur" required>
        <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <button type="submit">S'inscrire</button>
        </form>
    </div>

</body>
</html>