<?php
$baseUrl = '/18-mvc/pokemon';
// Si $data no está definido, usar $pokemon
$pokemon = $data ?? $pokemon ?? null;
if (!$pokemon) {
    header('Location: ' . $baseUrl);
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokemon Details</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>
<body>
    <div class="hero bg-base-200 min-h-screen py-8">
        <div class="card bg-base-100 w-full max-w-lg shadow-2xl">
            <div class="card-body">
                <h2 class="card-title text-2xl mb-4">Pokemon Details</h2>
                
                <div class="form-control">
                    <label class="label"><span class="label-text">Name</span></label>
                    <input type="text" value="<?= htmlspecialchars($pokemon['name']) ?>" readonly class="input input-bordered" />
                </div>

                <div class="form-control">
                    <label class="label"><span class="label-text">Type</span></label>
                    <div class="input input-bordered flex items-center">
                        <?php
                        $badges = ['Water'=>'badge-info','Grass'=>'badge-success','Fire'=>'badge-error','Electric'=>'badge-warning','Normal'=>'badge-secondary','Poison'=>'badge-primary','Ghost'=>'badge-accent','Dragon'=>'badge-secondary','Rock'=>'badge-neutral','Fight'=>'badge-neutral','Finght'=>'badge-neutral'];
                        $class = $badges[$pokemon['type']] ?? 'badge-neutral';
                        ?>
                        <span class="badge <?= $class ?> badge-lg"><?= htmlspecialchars($pokemon['type']) ?></span>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="form-control">
                        <label class="label"><span class="label-text">Strength</span></label>
                        <input type="number" value="<?= $pokemon['strength'] ?>" readonly class="input input-bordered" />
                    </div>
                    <div class="form-control">
                        <label class="label"><span class="label-text">Stamina</span></label>
                        <input type="number" value="<?= $pokemon['staming'] ?>" readonly class="input input-bordered" />
                    </div>
                    <div class="form-control">
                        <label class="label"><span class="label-text">Speed</span></label>
                        <input type="number" value="<?= $pokemon['speed'] ?>" readonly class="input input-bordered" />
                    </div>
                    <div class="form-control">
                        <label class="label"><span class="label-text">Accuracy</span></label>
                        <input type="number" value="<?= $pokemon['accuracy'] ?>" readonly class="input input-bordered" />
                    </div>
                </div>

                <div class="form-control">
                    <label class="label"><span class="label-text">Trainer</span></label>
                    <input type="text" value="<?= !empty($pokemon['trainer_name']) ? htmlspecialchars($pokemon['trainer_name']) : 'No trainer' ?>" readonly class="input input-bordered" />
                </div>

                <div class="form-control mt-6 gap-2">
                    <a href="<?= $baseUrl ?>/edit/<?= $pokemon['id'] ?>" class="btn btn-primary">
                        <i class="ph ph-pencil-simple"></i>
                        Edit Pokemon
                    </a>
                    <a href="<?= $baseUrl ?>" class="btn btn-ghost">
                        <i class="ph ph-arrow-left"></i>
                        Back to List
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
