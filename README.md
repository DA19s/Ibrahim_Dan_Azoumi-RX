# SmartTech — Plateforme de Gestion d'Infrastructure Réseau

Projet académique réalisé dans le cadre de la formation **DSTI2A**.  
Application web PHP permettant la gestion centralisée d'une infrastructure réseau : accès SSH, FTP, VNC, RDP et messagerie iRedMail, avec contrôle des utilisateurs basé sur les rôles.

---

## Fonctionnalités

### Authentification & Contrôle d'accès
- Inscription et connexion avec hachage sécurisé des mots de passe (`password_hash`)
- Sessions PHP avec routage automatique selon le rôle
- Deux rôles : **employé** (admin) et **client**
- Promotion d'un utilisateur au rang d'administrateur

### Tableau de bord Employé
- Gestion complète des utilisateurs (création, modification, suppression)
- Accès à tous les outils d'administration réseau
- Interface de messagerie iRedMail intégrée

### Tableau de bord Client
- Accès à la messagerie iRedMail (webmail)
- Accès SSH, VNC et FTP en lecture

### Accès à distance
| Protocole | Technologie | Détails |
|-----------|-------------|---------|
| SSH | phpseclib3 | Terminal web, exécution de commandes distantes |
| VNC | noVNC (iframe) | Affichage bureau distant (port 6080) |
| RDP | xfreerdp | Bureau Windows à distance (port 3389) |

### Gestion de fichiers FTP
- Upload de fichiers vers le serveur FTP distant
- Liste et téléchargement des fichiers disponibles
- Suppression de fichiers distants

---

## Stack technique

| Couche | Technologie |
|--------|-------------|
| Backend | PHP 8+ |
| Base de données | MySQL / MariaDB (PDO) |
| SSH | phpseclib/phpseclib v3 |
| Frontend | HTML5, CSS3, JavaScript vanilla |
| Messagerie | iRedMail |
| Encodage | paragonie/constant_time_encoding |

---

## Structure du projet

```
Ibrahim_Dan_Azoumi-RX/
├── database.sql                        # Schéma de la base de données
├── rx/
│   ├── index.php                       # Page d'accueil (point d'entrée)
│   └── project/
│       ├── config.php                  # Connexion PDO MySQL
│       ├── composer.json               # Dépendances PHP
│       ├── login.php                   # Authentification
│       ├── create.php                  # Inscription
│       ├── addAdmin.php                # Promotion administrateur
│       ├── dashboard.php               # Tableau de bord employé
│       ├── dasboard1.php               # Tableau de bord client
│       ├── update.php                  # Liste des utilisateurs (modification)
│       ├── edit_user.php               # Formulaire de modification utilisateur
│       ├── delete.php                  # Suppression utilisateur
│       ├── ssh_interface.php           # Interface terminal SSH (web)
│       ├── ssh_connect.php             # Backend SSH (phpseclib)
│       ├── test_ssh.php                # Test de connectivité SSH
│       ├── form_rdp.php                # Formulaire connexion RDP
│       ├── connect_rdp.php             # Exécution xfreerdp
│       ├── vnc.html                    # Visionneur VNC embarqué
│       ├── upload_file.php             # Interface upload FTP
│       ├── upload.php                  # Formulaire + connexion FTP
│       ├── read_uploads.php            # Liste des fichiers FTP
│       ├── download.php                # Téléchargement depuis FTP
│       ├── delete_ftp.php              # Suppression fichier FTP
│       └── vendor/                     # Librairies Composer
└── Ibrahim_Dan_Azoumi-PROJET_RX.odt   # Documentation du projet
```

---

## Base de données

**Nom de la base :** `smarttech_db`

```sql
CREATE TABLE users (
    id       INT(11)                      AUTO_INCREMENT PRIMARY KEY,
    nom      VARCHAR(255),
    prenom   VARCHAR(255),
    username VARCHAR(255)                 UNIQUE NOT NULL,
    role     ENUM('employe', 'client')    DEFAULT 'client',
    email    VARCHAR(255),
    password VARCHAR(255)                 NOT NULL
) CHARACTER SET utf8mb4;
```

---

## Installation

### Prérequis
- PHP 8.0+
- MySQL / MariaDB
- Composer
- Serveur web (Apache / Nginx)
- Extensions PHP : `pdo_mysql`, `ftp`

### Étapes

1. **Cloner le dépôt**
   ```bash
   git clone <url-du-repo>
   cd Ibrahim_Dan_Azoumi-RX
   ```

2. **Installer les dépendances PHP**
   ```bash
   cd rx/project
   composer install
   ```

3. **Créer la base de données**
   ```bash
   mysql -u root -p < database.sql
   ```

4. **Configurer la connexion**  
   Modifier [rx/project/config.php](rx/project/config.php) avec vos propres paramètres :
   ```php
   $host = 'localhost';
   $dbname = 'smarttech_db';
   $user = 'votre_utilisateur';
   $pass = 'votre_mot_de_passe';
   ```

5. **Déployer sur le serveur web**  
   Placer le dossier `rx/` à la racine de votre serveur web (ex. `htdocs/` ou `www/`).

6. **Accéder à l'application**  
   Ouvrir `http://localhost/rx/` dans un navigateur.

---

## Infrastructure cible

L'application est configurée pour interagir avec un serveur distant sur le réseau local :

| Service | Adresse | Port |
|---------|---------|------|
| SSH | 192.168.1.57 | 22 |
| FTP | 192.168.1.57 | 21 |
| VNC | 192.168.1.57 | 6080 |
| RDP | 192.168.1.57 | 3389 |

> Adapter ces valeurs dans les fichiers concernés (`ssh_connect.php`, `upload.php`, `vnc.html`, `connect_rdp.php`) selon votre environnement.

---

## Points d'attention (Sécurité)

> Ce projet est un prototype académique. Avant tout déploiement en production, les points suivants doivent être corrigés :

- **Credentials codés en dur** : déplacer les mots de passe vers des variables d'environnement (`.env`) ou un fichier de configuration exclu du contrôle de version (`.gitignore`)
- **Validation des entrées** : ajouter une validation stricte sur les formulaires et les noms de fichiers FTP
- **Gestion des sessions** : implémenter une déconnexion (`logout`) et la régénération d'identifiant de session
- **HTTPS** : forcer HTTPS en production pour sécuriser les échanges de credentials

---

## Auteurs

| Nom | Rôle |
|-----|------|
| Ibrahim Dan Azoumi | Développeur principal |

---

## Licence

Projet académique — usage éducatif uniquement.
