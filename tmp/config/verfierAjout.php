<?php
require "./db.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../ajouter.php');
    exit;
}

$titre = trim(htmlspecialchars($_POST['titre'] ?? ''));
$studio_id = $_POST['studio_id'] ?? '';
$annee_sortie = $_POST['annee_sortie'] ?? '';
$plateforme = htmlspecialchars($_POST['plateforme'] ?? '');
$genre = htmlspecialchars($_POST['genre'] ?? '');
$note = $_POST['note'] ?? '';
$description = trim(htmlspecialchars($_POST['description'] ?? ''));

$errors = [];

if ($titre === '') $errors['titre'] = "Le titre est obligatoire";

$anneeActuelle = date("Y");
if ($annee_sortie === '') {
    $errors['annee_sortie'] = "L'année est obligatoire";
} elseif ($annee_sortie === '' || $annee_sortie < 1970 || $annee_sortie > $anneeActuelle) {
    $errors['annee_sortie'] = "L'année doit être entre 1970 et $anneeActuelle";
}

if ($description !== '' && strlen($description) < 20) {
    $errors['description'] = "La description doit faire au moins 20 caractères";
}

if ($errors !== []) {
    $_SESSION['errors'] = $errors;
    $_SESSION['old'] = $_POST;
    header('Location: ../ajouter.php');
    exit;
}

try {
    $query = $connection->prepare("INSERT INTO jeux (titre, studio_id, annee_sortie, plateforme, genre, note, description) VALUES (?,?,?,?,?,?,?)");

    $query->execute([
        $titre,
        $studio_id,
        $annee_sortie,
        $plateforme,
        $genre,
        $note,
        $description
    ]);

    header('Location: ../liste.php');
    exit;

} catch (PDOException $e) {
    die("Erreur base de données : " . $e->getMessage());
}