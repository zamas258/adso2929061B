<?php $baseUrl = '/18-mvc/pokemon'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pokemon</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>
<body>
    <div class="hero bg-base-200 min-h-screen py-8">
        <div class="card bg-base-100 w-full max-w-lg shadow-2xl">
            <form method="POST" action="<?= $baseUrl ?>/update/<?= $pokemon['id'] ?>" class="card-body">
                <h2 class="card-title text-2xl mb-4">Edit Pokemon</h2>
                
                <div class="form-control">
                    <label class="label"><span class="label-text">Name *</span></label>
                    <input type="text" name="name" value="<?= htmlspecialchars($pokemon['name']) ?>" required class="input input-bordered" />
                </div>

                <div class="form-control">
                    <label class="label"><span class="label-text">Type *</span></label>
                    <select name="type" required class="select select-bordered">
                        <?php
                        $types = ['Water','Fire','Grass','Electric','Normal','Poison','Ghost','Dragon','Rock','Fight','Finght'];
                        foreach($types as $type):
                        ?>
                        <option value="<?= $type ?>" <?= $pokemon['type']==$type?'selected':'' ?>><?= $type ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="form-control">
                        <label class="label"><span class="label-text">Strength</span></label>
                        <input type="number" name="strength" value="<?= $pokemon['strength'] ?>" min="0" class="input input-bordered" />
                    </div>
                    <div class="form-control">
                        <label class="label"><span class="label-text">Stamina</span></label>
                        <input type="number" name="staming" value="<?= $pokemon['staming'] ?>" min="0" class="input input-bordered" />
                    </div>
                    <div class="form-control">
                        <label class="label"><span class="label-text">Speed</span></label>
                        <input type="number" name="speed" value="<?= $pokemon['speed'] ?>" min="0" class="input input-bordered" />
                    </div>
                    <div class="form-control">
                        <label class="label"><span class="label-text">Accuracy</span></label>
                        <input type="number" name="accuracy" value="<?= $pokemon['accuracy'] ?>" min="0" class="input input-bordered" />
                    </div>
                </div>

                <div class="form-control">
                    <label class="label"><span class="label-text">Trainer</span></label>
                    <select name="trainer_id" class="select select-bordered">
                        <option value="">No trainer</option>
                        <option value="1" <?= $pokemon['trainer_id']==1?'selected':'' ?>>Ash Ketchum</option>
                        <option value="2" <?= $pokemon['trainer_id']==2?'selected':'' ?>>Misty</option>
                        <option value="3" <?= $pokemon['trainer_id']==3?'selected':'' ?>>Brok</option>
                        <option value="4" <?= $pokemon['trainer_id']==4?'selected':'' ?>>Serena</option>
                        <option value="5" <?= $pokemon['trainer_id']==5?'selected':'' ?>>Oak</option>
                    </select>
                </div>

                <div class="form-control mt-6 gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="ph ph-check-circle"></i>
                        Update Pokemon
                    </button>
                    <a href="<?= $baseUrl ?>" class="btn btn-ghost">
                        <i class="ph ph-x-circle"></i>
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
