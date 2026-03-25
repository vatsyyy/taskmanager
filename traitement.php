<?php
    session_start();
    require_once 'config/database.php';

    if (!isset($_SESSION['utilisateur_id'])) {
        header("Location: auth/connexion.php");
        exit();
    }

    $uid = $_SESSION['utilisateur_id'];

    // Ajouter une tâche
    if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['titre'])) {
        $titre = $_POST['titre'];
        $stmt = $pdo->prepare("INSERT INTO taches (titre, utilisateur_id) VALUES (:titre, :uid)");
        $stmt->execute([
            ':titre' => $titre,
            ':uid' => $uid
        ]);

        //?Pattern PRG (Post Redirect Get)
        header("Location: index.php");
        exit();
    }

    
    // Supprimer une tâche
    if (isset($_POST['supprimer_id'])) {
        $stmt = $pdo->prepare(("DELETE FROM taches where id = :id AND utilisateur_id = :uid"));
        $stmt->execute([
            ':id' => $_POST['supprimer_id'],
            ':uid' => $uid
        ]);
        
        header("Location: index.php"); 
        exit();
    }

    // Terminer une tache
    if (isset($_POST['terminer_id'])) {
        $stmt = $pdo->prepare("UPDATE taches SET statut = 'terminée' WHERE id = :id AND utilisateur_id = :uid");
        $stmt->execute([
            ':id' => $_POST['terminer_id'],
            ':uid' => $uid 
        ]);
        
        header("Location: index.php"); 
        exit();
    }

    // Si on arrive ici sans POST, on redirige
    header("Location: index.php"); 
    exit();
