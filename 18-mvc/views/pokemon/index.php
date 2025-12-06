<?php
$baseUrl = '/18-mvc/pokemon';
$currentSearch = $searchTerm ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokemon Management</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>
<body>
    <div class="hero bg-base-200 min-h-screen py-8">
        <div class="hero-content text-center w-full">
            <div class="max-w-6xl w-full">
                <h1 class="text-5xl font-bold mb-2">Pokemon</h1>
                <p class="mb-8 text-lg">Complete Pokemon Management System</p>
                
                <div class="flex gap-4 mb-8 justify-center flex-wrap">
                    <a href="<?= $baseUrl ?>/create" class="btn btn-success">
                        <i class="ph ph-plus-circle" style="font-size: 1.5rem;"></i>
                        Add Pokemon
                    </a>
                    
                    <form method="GET" action="<?= $baseUrl ?>" class="join">
                        <input type="text" name="q" value="<?= htmlspecialchars($currentSearch) ?>" placeholder="Search..." class="input input-bordered join-item w-64" />
                        <button type="submit" class="btn join-item btn-primary">Search</button>
                        <?php if(!empty($currentSearch)): ?>
                        <a href="<?= $baseUrl ?>" class="btn join-item btn-ghost">Clear</a>
                        <?php endif; ?>
                    </form>
                </div>

                <?php if(!empty($currentSearch)): ?>
                <div class="alert alert-info mb-4">
                    <span>Results for: <strong>"<?= htmlspecialchars($currentSearch) ?>"</strong> - Found <?= count($data) ?> pokemon(s)</span>
                </div>
                <?php endif; ?>

                <div class="overflow-x-auto shadow-xl rounded-lg">
                    <table class="table table-zebra w-full">
                        <thead class="bg-primary text-primary-content">
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
                            <?php if(empty($data)): ?>
                            <tr>
                                <td colspan="9" class="text-center py-8">
                                    <p class="text-lg font-semibold">No Pokemon found</p>
                                    <?php if(!empty($currentSearch)): ?>
                                    <a href="<?= $baseUrl ?>" class="btn btn-primary mt-4">View All</a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php else: ?>
                            <?php foreach($data as $pokemon): ?>
                            <tr class="hover">
                                <th><?= $pokemon['id'] ?></th>
                                <td class="font-semibold"><?= htmlspecialchars($pokemon['name']) ?></td>
                                <td>
                                    <?php
                                    $badges = ['Water'=>'badge-info','Grass'=>'badge-success','Fire'=>'badge-error','Electric'=>'badge-warning','Normal'=>'badge-secondary','Poison'=>'badge-primary','Ghost'=>'badge-accent','Dragon'=>'badge-secondary','Rock'=>'badge-neutral','Fight'=>'badge-neutral','Finght'=>'badge-neutral'];
                                    $class = $badges[$pokemon['type']] ?? 'badge-neutral';
                                    ?>
                                    <span class="badge <?= $class ?> badge-lg"><?= htmlspecialchars($pokemon['type']) ?></span>
                                </td>
                                <td><span class="badge badge-outline"><?= $pokemon['strength'] ?></span></td>
                                <td><span class="badge badge-outline"><?= $pokemon['staming'] ?></span></td>
                                <td><span class="badge badge-outline"><?= $pokemon['speed'] ?></span></td>
                                <td><span class="badge badge-outline"><?= $pokemon['accuracy'] ?></span></td>
                                <td>
                                    <?= !empty($pokemon['trainer_name']) ? '<span class="badge badge-ghost">'.htmlspecialchars($pokemon['trainer_name']).'</span>' : '<span class="text-gray-400">No trainer</span>' ?>
                                </td>
                                <td>
                                    <div class="join">
                                        <a href="<?= $baseUrl ?>/edit/<?= $pokemon['id'] ?>" class="btn btn-sm btn-info join-item">
                                            <i class="ph ph-pencil-simple"></i>
                                        </a>
                                        <a href="<?= $baseUrl ?>/delete/<?= $pokemon['id'] ?>" onclick="return confirm('Delete <?= htmlspecialchars($pokemon['name']) ?>?')" class="btn btn-sm btn-error join-item">
                                            <i class="ph ph-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <div class="stats shadow mt-8">
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
