<?php
require "./config/db.php";
session_start();

$errors = $_SESSION['errors'] ?? []; 
$old = $_SESSION['old'] ?? [];
unset($_SESSION['errors'], $_SESSION['old']);

$studios = $connection->query("SELECT id, nom FROM studio;")->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Ajouter Jeux</title>
</head>
<body class="m-0 p-0">
    <main class="p-2">
        <form action="./config/verfierAjout.php" method="POST" class="bg-gray-200 border border-gray-400 flex flex-col w-[1024px] justify-self-center p-10 shadow-md rounded-lg">
            
            <h2 class="text-xl font-bold mb-6 border-b border-gray-400 pb-2">Ajouter un jeu</h2>

            <div class="flex items-center mb-4">
                <label class="w-1/3 font-semibold">Titre :</label>
                <div class="w-2/3 flex flex-col">
                    <input name="titre" placeholder="Insérez un titre" required class="border border-black p-2 rounded-md bg-white"/>
                    <?php if (isset($errors['titre'])) echo '<span class="text-red-500 text-sm mt-1">' . $errors['titre'] . '</span>'; ?>
                </div>
            </div>

            <div class="flex items-center mb-4">
                <label class="w-1/3 font-semibold">Studio :</label>
                <div class="w-2/3 flex flex-col">
                    <select name="studio_id" required class="border border-black p-2 rounded-md bg-white">
                        <option value="">Choisir un studio</option>
                        <?php foreach ($studios as $studio) : ?>
                            <option value="<?= $studio['id'] ?>"><?= $studio['nom'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?php if (isset($errors['studio_id'])) echo '<p class="text-red-500 text-sm mt-1">' . $errors['studio_id'] . '</p>'; ?>
                </div>
            </div>

            <div class="flex items-center mb-4">
                <label class="w-1/3 font-semibold">Année de sortie :</label>
                <div class="w-2/3 flex flex-col">
                    <input name="annee_sortie" placeholder="Ex: 2024" required class="border border-black p-2 rounded-md bg-white" />
                    <?php if (isset($errors['annee_sortie'])) echo '<p class="text-red-500 text-sm mt-1">' . $errors['annee_sortie'] . '</p>'; ?>
                </div>
            </div>

            <div class="flex items-center mb-4">
                <label class="w-1/3 font-semibold">Plateforme :</label>
                <div class="w-2/3 flex flex-col">
                    <select name="plateforme" class="border border-black p-2 rounded-md bg-white">
                        <option value="PC">PC</option>
                        <option value="PlayStation">PlayStation</option>
                        <option value="Xbox">Xbox</option>
                        <option value="Nintendo Switch">Nintendo Switch</option>
                        <option value="Mobile">Mobile</option>
                    </select>
                    <?php if (isset($errors['plateforme'])) echo '<p class="text-red-500 text-sm mt-1">' . $errors['plateforme'] . '</p>'; ?>
                </div>
            </div>

            <div class="flex items-center mb-4">
                <label class="w-1/3 font-semibold">Genre :</label>
                <div class="w-2/3 flex flex-col">
                    <select name="genre" class="border border-black p-2 rounded-md bg-white">
                        <option value="Action">Action</option>
                        <option value="RPG">RPG</option>
                        <option value="FPS">FPS</option>
                        <option value="Aventure">Aventure</option>
                        <option value="Sport">Sport</option>
                    </select>
                    <?php if (isset($errors['genre'])) echo '<p class="text-red-500 text-sm mt-1">' . $errors['genre'] . '</p>'; ?>
                </div>
            </div>

            <div class="flex items-center mb-4">
                <label class="w-1/3 font-semibold">Note :</label>
                <div class="w-2/3 flex items-center space-x-3 bg-white p-2 border border-black rounded-md">
                    <input type="radio" name="note" value="1" required class="ml-1"> 1
                    <input type="radio" name="note" value="2" class="ml-1"> 2
                    <input type="radio" name="note" value="3" class="ml-1"> 3
                    <input type="radio" name="note" value="4" class="ml-1"> 4
                    <input type="radio" name="note" value="5" class="ml-1"> 5
                    <?php if (isset($errors['note'])) echo '<p class="text-red-500 text-sm ml-4">' . $errors['note'] . '</p>'; ?>
                </div>
            </div>

            <div class="flex flex-col mb-6">
                <label class="font-semibold mb-2">Description :</label>
                <textarea name="description" placeholder="Minimum 20 caractères" class="border border-black p-2 rounded-md bg-white h-32"></textarea>
                <?php if (isset($errors['description'])) echo '<p class="text-red-500 text-sm mt-1">' . $errors['description'] . '</p>'; ?>
            </div>

            <button type="submit" class="border-2 border-black bg-gray-300 p-3 font-bold hover:bg-gray-400 transition-all cursor-pointer">
                Enregistrer le jeu
            </button>
        </form>
    </main>
</body>
</html>