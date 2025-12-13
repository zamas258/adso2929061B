<?php $baseUrl = '/18-mvc/pokemon'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokemon List</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../../css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Pokemon List</h1>
        <a href="<?= $baseUrl ?>/create" class="btn-add"><i class="fas fa-plus"></i></a>
        <br><br>
        <form method="GET" action="<?= $baseUrl ?>" class="search-form">
            <input type="text" name="q" placeholder="Search by name" value="<?= htmlspecialchars($_GET['q'] ?? '') ?>" />
            <button type="submit">Search</button>
        </form>
        <br>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Strength</th>
                    <th>Stamina</th>
                    <th>Speed</th>
                    <th>Accuracy</th>
                    <th>Trainer</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $pokemon): ?>
                <tr>
                    <td><?= $pokemon['id'] ?></td>
                    <td><?= htmlspecialchars($pokemon['name']) ?></td>
                    <td><?= htmlspecialchars($pokemon['type']) ?></td>
                    <td><?= $pokemon['strength'] ?></td>
                    <td><?= $pokemon['staming'] ?></td>
                    <td><?= $pokemon['speed'] ?></td>
                    <td><?= $pokemon['accuracy'] ?></td>
                    <td>
                        <?php
                        $trainers = [1 => 'Ash Ketchum', 2 => 'Misty', 3 => 'Brok', 4 => 'Serena', 5 => 'Oak'];
                        echo $pokemon['trainer_id'] ? $trainers[$pokemon['trainer_id']] : 'None';
                        ?>
                    </td>
                    <td>
                        <a href="<?= $baseUrl ?>/edit/<?= $pokemon['id'] ?>" class="btn-edit"><i class="fas fa-pencil-alt"></i></a>
                        <form method="POST" action="<?= $baseUrl ?>/delete/<?= $pokemon['id'] ?>" style="display:inline;">
                            <button type="submit" class="btn-delete" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
