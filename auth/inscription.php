<?php
    session_start();

    if (isset($_SESSION['utilisateur_id'])) {
    header("Location: ../index.php");
    exit();
    }

    $erreurs = [
        'champs_vides' => 'Tous les champs sont obligatoires.',
        'email_invalide' => "L'email n'est pas valide.",
        'mot_de_passe_court' => 'Le mot de passe doit faire au moins 8 caractères.',
        'email_existe' => 'Cet email est déjà utilisé.',
    ];

    $erreur = isset($_GET['erreur']) && isset($erreurs[$_GET['erreur']])
            ? $erreurs[$_GET['erreur']]
            : '';


?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="/taskmanager/css/style.css">
</head>
<body class="auth-page">
    <div class="auth-container">
        <h1>Inscription</h1>

        <?php if (!empty($erreur)): ?>
            <p class="erreur"><?= htmlspecialchars($erreur) ?></p>
        <?php endif; ?>
    
        <form method="POST" action="traitement_auth.php">
            <input type="hidden" name="action" value="inscription">
            <input type="text" name="nom" placeholder="Ton nom"><br><br>
            <input type="email" name="email" placeholder="Ton email" ><br></br>
            <input type="password" name="mot_de_passe" placeholder="Mot de passe" ><br><br>
            <button type="submit">S'inscrire</button>
        </form>
    
        <p>Déjà un compte ? <a href="connexion.php">Se connecter</a></p>
    </div>
</body>
</html>