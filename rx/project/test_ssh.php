<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<?php
require 'vendor/autoload.php'; // Vérifie que phpseclib est bien chargé

use phpseclib3\Net\SSH2;

$host = '192.168.1.57'; // Remplace par ton IP/hostname
$username = 'da19';
$password = 'Ibou1324';

$ssh = new SSH2($host);
if (!$ssh->login($username, $password)) {
    die('Échec de la connexion SSH');
}

echo "Connexion réussie !<br>";

$output = $ssh->exec('ls -l'); // Teste une commande simple
echo "<pre>$output</pre>";
?>
