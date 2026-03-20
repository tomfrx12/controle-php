<?php
require "./config/db.php";
session_start();

// 1. Récupération de l'ID via l'URL
$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: liste.php");
    exit;
}

// 2. Chargement des données du jeu pour pré-remplir le formulaire
$queryJeu = $connection->prepare("SELECT * FROM jeux WHERE id = ?");
$queryJeu->execute([$id]);
$jeu = $queryJeu->fetch();

if (!$jeu) {
    header("Location: liste.php");
    exit;
}

// 3. Chargement des studios pour la liste déroulante
$studios = $connection->query("SELECT id, nom FROM studio;")->fetchAll();

// 4. Gestion des erreurs de session
$errors = $_SESSION['errors'] ?? [];
unset($_SESSION['errors']);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Modifier Jeu</title>
</head>
<body class="m-0 p-0">
    <main class="p-2">
        <form action="./config/verifierModifier.php" method="POST" class="bg-gray-200 border border-gray-400 flex flex-col w-[1024px] justify-self-center p-10 shadow-md rounded-lg">
            
            <input type="hidden" name="id" value="<?= $jeu['id'] ?>">

            <h2 class="text-xl font-bold mb-6 border-b border-gray-400 pb-2">Modifier le jeu : <?= htmlspecialchars($jeu['titre']) ?></h2>

            <div class="flex items-center mb-4">
                <label class="w-1/3 font-semibold">Titre :</label>
                <div class="w-2/3 flex flex-col">
                    <input name="titre" value="<?= htmlspecialchars($jeu['titre']) ?>" required class="border border-black p-2 rounded-md bg-white"/>
                    <?php if (isset($errors['titre'])) echo '<span class="text-red-500 text-sm mt-1">' . $errors['titre'] . '</span>'; ?>
                </div>
            </div>

            <div class="flex items-center mb-4">
                <label class="w-1/3 font-semibold">Studio :</label>
                <div class="w-2/3 flex flex-col">
                    <select name="studio_id" required class="border border-black p-2 rounded-md bg-white">
                        <?php foreach ($studios as $studio) : ?>
                            <option value="<?= $studio['id'] ?>" <?= ($studio['id'] == $jeu['studio_id']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($studio['nom']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="flex items-center mb-4">
                <label class="w-1/3 font-semibold">Année de sortie :</label>
                <div class="w-2/3 flex flex-col">
                    <input name="annee_sortie" value="<?= htmlspecialchars($jeu['annee_sortie']) ?>" required class="border border-black p-2 rounded-md bg-white" />
                    <?php if (isset($errors['annee_sortie'])) echo '<p class="text-red-500 text-sm mt-1">' . $errors['annee_sortie'] . '</p>'; ?>
                </div>
            </div>

            <div class="flex items-center mb-4">
                <label class="w-1/3 font-semibold">Plateforme :</label>
                <div class="w-2/3 flex flex-col">
                    <select name="plateforme" class="border border-black p-2 rounded-md bg-white">
                        <?php $pfs = ['PC', 'PlayStation', 'Xbox', 'Nintendo Switch', 'Mobile'];
                        foreach ($pfs as $pf) : ?>
                            <option value="<?= $pf ?>" <?= ($pf == $jeu['plateforme']) ? 'selected' : '' ?>><?= $pf ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="flex items-center mb-4">
                <label class="w-1/3 font-semibold">Genre :</label>
                <div class="w-2/3 flex flex-col">
                    <select name="genre" class="border border-black p-2 rounded-md bg-white">
                        <?php $genres = ['Action', 'RPG', 'FPS', 'Aventure', 'Sport'];
                        foreach ($genres as $g) : ?>
                            <option value="<?= $g ?>" <?= ($g == $jeu['genre']) ? 'selected' : '' ?>><?= $g ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="flex items-center mb-4">
                <label class="w-1/3 font-semibold">Note :</label>
                <div class="w-2/3 flex items-center space-x-3 bg-white p-2 border border-black rounded-md">
                    <?php for($i=1; $i<=5; $i++): ?>
                        <input type="radio" name="note" value="<?= $i ?>" <?= ($jeu['note'] == $i) ? 'checked' : '' ?> required class="ml-1"> <?= $i ?>
                    <?php endfor; ?>
                </div>
            </div>

            <div class="flex flex-col mb-6">
                <label class="font-semibold mb-2">Description :</label>
                <textarea name="description" class="border border-black p-2 rounded-md bg-white h-32"><?= htmlspecialchars($jeu['description']) ?></textarea>
                <?php if (isset($errors['description'])) echo '<p class="text-red-500 text-sm mt-1">' . $errors['description'] . '</p>'; ?>
            </div>

            <div class="flex justify-between">
                <a href="liste.php" class="p-3 underline">Annuler</a>
                <button type="submit" class="border-2 border-black bg-gray-300 p-3 font-bold hover:bg-gray-400 transition-all cursor-pointer">
                    Mettre à jour le jeu
                </button>
            </div>
        </form>
    </main>
</body>
</html>