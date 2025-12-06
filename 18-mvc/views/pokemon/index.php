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
            <div class="max-w-2xl w-full">
                <h1 class="text-5xl font-bold mb-2">Pokemon</h1>
                <br>
                
                <div class="flex gap-4 mb-8 justify-center flex-wrap">
                    <a href="<?= $baseUrl ?>/create" class="btn btn-success">
                        <i class="ph ph-plus-circle" style="font-size: 1.5rem;"></i>
                        Add Pokemon
                    </a>
                </div>

                <?php if(!empty($currentSearch)): ?>
                <div class="alert alert-info mb-4">
                    <span>Results for: <strong>"<?= htmlspecialchars($currentSearch) ?>"</strong> - Found <?= count($data) ?> pokemon(s)</span>
                </div>
                <?php endif; ?>

                <div class="overflow-x-auto rounded-lg border border-base-300">
                    <table class="table table-zebra w-full table-sm">
                        <thead class="bg-black text-white">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(empty($data)): ?>
                            <tr>
                                <td colspan="4" class="text-center py-8">
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
                                <td>
                                    <div class="flex gap-1">
                                        <a href="<?= $baseUrl ?>/view/<?= $pokemon['id'] ?>" class="btn btn-sm btn-neutral">
                                            <i class="ph ph-magnifying-glass"></i>
                                        </a>
                                        <a href="<?= $baseUrl ?>/edit/<?= $pokemon['id'] ?>" class="btn btn-sm btn-neutral">
                                            <i class="ph ph-pencil-simple"></i>
                                        </a>
                                        <a href="<?= $baseUrl ?>/delete/<?= $pokemon['id'] ?>" onclick="return confirm('Delete <?= htmlspecialchars($pokemon['name']) ?>?')" class="btn btn-sm btn-error">
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
