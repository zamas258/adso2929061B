<?php $baseUrl = '/18-mvc/pokemon'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pokemon</title>
    // ...existing code...
</head>
<body>
    <div style="max-width: 600px; margin: 0 auto; padding: 20px;">
        <?php if (!isset($pokemon) || !$pokemon): ?>
            <p>Pokemon not found.</p>
            <a href="<?= $baseUrl ?>">Back</a>
        <?php else: ?>
        <h2>Edit Pokemon</h2>
        <form method="POST" action="<?= $baseUrl ?>/update/<?= $pokemon['id'] ?>">
            <label for="name">Name *</label><br>
            <input type="text" name="name" value="<?= htmlspecialchars($pokemon['name']) ?>" required style="width: 100%; padding: 8px; margin-bottom: 10px;" />
            <br>

            <label for="type">Type *</label><br>
            <select name="type" required style="width: 100%; padding: 8px; margin-bottom: 10px;">
                <?php
                $types = ['Water','Fire','Grass','Electric','Normal','Poison','Ghost','Dragon','Rock','Fighting'];
                foreach($types as $type):
                ?>
                <option value="<?= $type ?>" <?= $pokemon['type']==$type?'selected':'' ?>><?= $type ?></option>
                <?php endforeach; ?>
            </select>
            <br>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
                <div>
                    <label for="strength">Strength</label><br>
                    <input type="number" name="strength" value="<?= $pokemon['strength'] ?>" min="0" style="width: 100%; padding: 8px;" />
                </div>
                <div>
                    <label for="staming">Stamina</label><br>
                    <input type="number" name="staming" value="<?= $pokemon['staming'] ?>" min="0" style="width: 100%; padding: 8px;" />
                </div>
                <div>
                    <label for="speed">Speed</label><br>
                    <input type="number" name="speed" value="<?= $pokemon['speed'] ?>" min="0" style="width: 100%; padding: 8px;" />
                </div>
                <div>
                    <label for="accuracy">Accuracy</label><br>
                    <input type="number" name="accuracy" value="<?= $pokemon['accuracy'] ?>" min="0" style="width: 100%; padding: 8px;" />
                </div>
            </div>
            <br>

            <label for="trainer_id">Trainer</label><br>
            <select name="trainer_id" style="width: 100%; padding: 8px; margin-bottom: 10px;">
                <option value="">No trainer</option>
                <option value="1" <?= $pokemon['trainer_id']==1?'selected':'' ?>>Ash Ketchum</option>
                <option value="2" <?= $pokemon['trainer_id']==2?'selected':'' ?>>Misty</option>
                <option value="3" <?= $pokemon['trainer_id']==3?'selected':'' ?>>Brok</option>
                <option value="4" <?= $pokemon['trainer_id']==4?'selected':'' ?>>Serena</option>
                <option value="5" <?= $pokemon['trainer_id']==5?'selected':'' ?>>Oak</option>
            </select>
            <br>

            <button type="submit" style="padding: 10px 20px; background: blue; color: white; border: none;">Update Pokemon</button>
            <a href="<?= $baseUrl ?>" style="padding: 10px 20px; background: gray; color: white; text-decoration: none;">Cancel</a>
        </form>
        <?php endif; ?>
    </div>
</body>
</html>
