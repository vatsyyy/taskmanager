<?php if (!isset($_SESSION['utilisateur_nom'])) $_SESSION['utilisateur_nom'] = ''; ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager</title>
    <link rel="stylesheet" href="/taskmanager/css/style.css">
</head>
<body>
    <header>
        <h1>Mon Gestionnaire de Tâches</h1>
        <?php if (!empty($_SESSION['utilisateur_nom'])): ?>
            <nav>
                <span>Bonjour <?= htmlspecialchars($_SESSION['utilisateur_nom']) ?> !</span>
                <a href="/taskmanager/auth/deconnexion.php">Se déconnecter</a>
            </nav>
        <?php endif; ?>
    </header>
    <main>