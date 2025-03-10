<?php
// Récupérer les valeurs du formulaire
putenv("DISPLAY=:0");

$server_ip = "192.168.1.57";
$port = "3389";
$username = "da19";
$password = "Ibou1324"; // À remplacer par un mécanisme plus sécurisé

// Vérification de la validité des champs
if (empty($server_ip) || empty($username) || empty($password)) {
    die("Veuillez remplir tous les champs.");
}

// Vérifier si Remmina est installé
$check_remmina = exec("which remmina", $output, $return_var);
if ($return_var !== 0) {
    die("Remmina n'est pas installé sur ce serveur.");
}

// Commande pour exécuter un client RDP avec Remmina
$command = "xfreerdp /u:$username /p:$password /v:$server_ip:$port";

// Exécuter la commande
exec($command, $output, $return_var);

// Vérification du succès de l'exécution
if ($return_var === 0) {
    echo "Connexion RDP lancée avec succès.";
} else {
    echo "Une erreur est survenue lors de la tentative de connexion RDP. Code d'erreur: $return_var";
    echo "<pre>" . implode("\n", $output) . "</pre>"; // Affiche la sortie pour le débogage
}
?>
