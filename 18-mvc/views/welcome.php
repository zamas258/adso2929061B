    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Welcome MVC</title>
        <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
        <script src="https://unpkg.com/@phosphor-icons/web"></script>
    </head>

    <body>
        <div class="hero bg-base-200 min-h-screen">
            <div class="hero-content text-center">
                <div class="max-w-md">
                    <h1 class="text-5xl font-bold">MVC</h1>
                    <h3 class="mb-10">Model View Controller</h3>

                    <a href="" class="btn btn-success mb-8">
                        <i class="ph ph-plus-circle" style="font-size: 1.5rem;"></i>
                        Add Pokemon
                    </a>
                    <div class="overflow-x-auto h-96 w-96">
                        <table class="table table-zebra table-xs table-pin-rows table-pin-cols">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <td>Name</td>
                                    <td>Type</td>
                                    <td>Access</td>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data as $pokemon): ?>
                                    <tr>
                                        <th><?= htmlspecialchars($pokemon['id']) ?></th>
                                        <td><?= htmlspecialchars($pokemon['name']) ?></td>
                                        <td>
                                            <?php if ($pokemon['type'] == 'Water'): ?>
                                                <span class="badge badge-info">Water</span>
                                            <?php elseif ($pokemon['type'] == 'Grass'): ?>
                                                <span class="badge badge-success">Grass</span>
                                            <?php elseif ($pokemon['type'] == 'Fire'): ?>
                                                <span class="badge badge-error">Fire</span>
                                            <?php elseif ($pokemon['type'] == 'Electric'): ?>
                                                <span class="badge badge-warning">Electric</span>
                                            <?php elseif ($pokemon['type'] == 'Normal'): ?>
                                                <span class="badge badge-secondary">Normal</span>
                                            <?php elseif ($pokemon['type'] == 'Poison'): ?>
                                                <span class="badge badge-primary">Poison</span>
                                            <?php elseif ($pokemon['type'] == 'Ghost'): ?>
                                                <span class="badge badge-accent">Ghost</span>
                                            <?php elseif ($pokemon['type'] == 'Dragon'): ?>
                                                <span class="badge badge-secondary">Dragon</span>
                                            <?php elseif ($pokemon['type'] == 'Rock'): ?>
                                                <span class="badge badge-neutral">Rock</span>
                                            <?php elseif ($pokemon['type'] == 'Fight'): ?>
                                                <span class="badge badge-neutral">Fight</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="" class="btn btn-xs btn-neutral">
                                                <i class="ph ph-magnifying-glass"></i>
                                            </a>
                                            <a href="" class="btn btn-xs btn-neutral">
                                                <i class="ph ph-pencil-simple"></i>
                                            </a>
                                            <a href="" class="btn btn-xs btn-error">
                                                <i class="ph ph-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </body>

    </html>