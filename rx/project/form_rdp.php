<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion RDP</title>
</head>
<body>
    <h1>Connexion à un serveur via RDP</h1>
    <form action="connect_rdp.php" method="POST">
        <label for="server_ip">Adresse IP du serveur RDP :</label>
        <input type="text" name="server_ip" id="server_ip" required>
        <br><br>
        <label for="port">Port (par défaut 3389) :</label>
        <input type="text" name="port" id="port" value="3389">
        <br><br>
        <label for="username">Nom d'utilisateur :</label>
        <input type="text" name="username" id="username" required>
        <br><br>
        <label for="password">Mot de passe :</label>
        <input type="password" name="password" id="password" required>
        <br><br>
        <input type="submit" value="Se connecter">
    </form>
</body>
</html>
