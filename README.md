# 📝 Task Manager

Une application web de gestion de tâches développée en PHP, MariaDB et Apache.

## 🚀 Fonctionnalités

- ✅ Inscription et connexion utilisateur
- ✅ Ajouter, afficher, modifier et supprimer des tâches
- ✅ Filtrer les tâches par statut (toutes, en cours, terminées)
- ✅ Chaque utilisateur a ses propres tâches
- ✅ Interface responsive et moderne

## 🛠️ Technologies utilisées

- **PHP 8.4** — Back-end
- **MariaDB** — Base de données
- **Apache** — Serveur web
- **HTML/CSS** — Front-end

## ⚙️ Installation

1. Clone le projet
\`\`\`bash
git clone https://github.com/vatsyyy/taskmanager.git
\`\`\`

2. Copie le fichier de configuration
\`\`\`bash
cp config/database.example.php config/database.php
\`\`\`

3. Modifie `config/database.php` avec tes identifiants MariaDB

4. Crée la base de données
\`\`\`sql
CREATE DATABASE taskmanager;
USE taskmanager;

CREATE TABLE utilisateurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    mot_de_passe VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT NOW()
);

CREATE TABLE taches (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(255) NOT NULL,
    statut ENUM('en_cours', 'terminée') DEFAULT 'en_cours',
    created_at DATETIME DEFAULT NOW(),
    utilisateur_id INT NOT NULL
);
\`\`\`

5. Place le projet dans le bon dossier selon ton système et ouvre ton navigateur :

**Linux/Mac (Apache)**
\`\`\`bash
/var/www/html/taskmanager
\`\`\`

**Windows (XAMPP)**
\`\`\`
C:\xampp\htdocs\taskmanager
\`\`\`

**Windows (WAMP)**
\`\`\`
C:\wamp64\www\taskmanager
\`\`\`

Puis ouvre :
\`\`\`
http://localhost/taskmanager
\`\`\`

## 👤 Auteur

**Vatsiniaina** — [GitHub](https://github.com/vatsyyy)
