<?php 
require "./config/db.php";

$queryGetJeux = $connection->query("SELECT jeux.*, studio.* FROM jeux INNER JOIN studio ON jeux.studio_id = studio.id ORDER BY jeux.note DESC;")->fetchAll();
$queryCountJeux = $connection->query("SELECT COUNT(*) AS total FROM jeux;")->fetch();
$queryNbJeuStudio = $connection->query("SELECT COUNT(*) AS total FROM jeux JOIN studio ON jeux.studio_id = studio.id GROUP BY studio.nom;")->fetch();

function CouleurNote($note) {
    if ($note >= 4) {
        return "bg-green-400";
    } elseif ($note >= 2) {
        return "bg-orange-400";
    } else {
        return "bg-red-400";
    }
}

function EtoileNote($note) {
    $etoiles = "";
    for ($i = 0; $i < 5; $i++) {
        if ($note >= 1) {
            $etoiles .= "★";
            $note--;
        } else {
            $etoiles .= "☆";
        }
    }
    return $etoiles;
}

function Moyenne($jeux) {
    $total = 0;
    for ($i = 0; $i < count($jeux); $i++) {
        $total += $jeux[$i]['note'];
    }
    return $total / count($jeux);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Jeux</title>
</head>
<body>
    <main class="p-2">
        <a href="./ajouter.php" class="border bg-blue-400 hover:bg-blue-300 transition-all delay-150 duration-400 hover:rotate-360 px-4 py-2 my-4 inline-block font-semibold rounded-md">Ajoutez un jeu</a>
        <table class="border w-full">
            <thead class="m-2">
                <tr>
                    <th>Titre</th>
                    <th>Studio</th>
                    <th>Pays du Studio</th>
                    <th>Année</th>
                    <th>Plateforme</th>
                    <th>Genre</th>
                    <th>Note</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="m-2">
                <?php foreach ($queryGetJeux as $jeu) : ?>
                    <tr>
                        <td class="border p-2"><?= $jeu['titre'] ?></td>
                        <td class="border p-2"><?= $jeu['nom'] ?></td>
                        <td class="border p-2"><?= $jeu['pays'] ?></td>
                        <td class="border p-2"><?= $jeu['annee_sortie'] ?></td>
                        <td class="border p-2"><?= $jeu['plateforme'] ?></td>
                        <td class="border p-2"><?= $jeu['genre'] ?></td>
                        <td 
                            class="border p-2 
                                <?= 
                                    CouleurNote($jeu['note'])
                                ?>">
                            <?= EtoileNote($jeu['note']) ?>
                        </td>
                        <td class="flex justify-center gap-2">
                            <a href="./modifier.php?id=<?= $jeu['id'] ?>" 
                            class="justify-self-end border bg-green-200 hover:bg-green-400 p-2 transition-colors duration-200 inline-block">
                            Modifier
                            </a>
                            <a href="" class="justify-self-end border bg-red-200 hover:bg-red-400 p-2 transition-colors duration-200 inline-block">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="10" class="p-2"><strong>Nombre de jeux: </strong><?= $queryCountJeux['total'] ?></td>
                </tr>
                <tr>
                    <td colspan="10" class="p-2"><strong>Moyenne </strong><?= Moyenne($queryGetJeux) ?></td>
                </tr>
                <tr>
                    <td colspan="10" class="p-2"><strong>Nombre de jeux par studios: </strong><?= $queryNbJeuStudio['total'] ?></td>
                </tr>
            </tfoot>
        </table>
    </main>
</body>
</html>
