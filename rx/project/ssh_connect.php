<?php
use phpseclib3\Net\SSH2;
require 'vendor/autoload.php'; 

$host = '192.168.1.57'; 
$port = 22;
$username = 'da19';
$password = 'Ibou1324'; 

try {
    $ssh = new SSH2($host, $port);
    if (!$ssh->login($username, $password)) {
        throw new Exception("Échec de l'authentification SSH.");
    }

    // Si une commande est envoyée, on l'exécute
    if (isset($_POST['command'])) {
        $command = $_POST['command'];
        $output = $ssh->exec($command);
        echo nl2br(htmlspecialchars($output));
        exit;
    }
} catch (Exception $e) {
    die("Erreur SSH : " . $e->getMessage());
}
?>
