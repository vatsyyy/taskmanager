<?php
    session_start();

    if (isset($_SESSION['utilisateur_id'])) {
        header("Location: ../index.php");
        exit();
    }

    $erreurs = [
        'champs_vides' => 'Tous les champs sont obligatoires.',
        'email_invalide' => "L'email n'est pas valide.",
        'identifiants_incorrects' => 'Email ou mot de passe incorrect.',
    ];

    $erreur = isset($_GET['erreur']) && isset($erreurs[$_GET['erreur']]) 
            ? $erreurs[$_GET['erreur']] 
            : '';

    $success = isset($_GET['success']) && $_GET['success'] == 'inscription'
                ? 'Inscription réussie ! Connecte-toi.'
                : '';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="/taskmanager/css/style.css">
</head>
<body class="auth-page">
    <div class="auth-container">
        <h1>Connexion</h1>
    
        <?php if (!empty($erreur)): ?>
            <p class="erreur"><?= htmlspecialchars($erreur) ?></p>
        <?php endif; ?>
    
        <?php if (!empty($success)): ?>
            <p class="success"><?= htmlspecialchars($success) ?></p>
        <?php endif; ?>
    
        <form method="POST" action="traitement_auth.php">
            <input type="hidden" name="action" value="connexion">
            <input type="email" name="email" placeholder="Ton email" required><br><br>
            <input type="password" name="mot_de_passe" placeholder="Mot de passe" required><br><br>
            <button type="submit">Se connecter</button>
        </form>
    
        <p>Pas encore de compte ? <a href="inscription.php">S'inscrire</a></p>
    </div>
</body>
</html>