<?php $baseUrl = '/18-mvc/pokemon'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Pokemon - Pokemon CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>
<body class="bg-base-200">
    <div class="container mx-auto py-8">
        <div class="max-w-2xl mx-auto">
            <div class="card bg-base-100 shadow-2xl">
                <div class="card-body">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="card-title text-3xl">Add New Pokemon</h2>
                        <a href="/18-mvc/pokemon" class="btn btn-circle btn-ghost">
                            <i class="ph ph-x" style="font-size: 1.5rem;"></i>
                        </a>
                    </div>

                    <form method="POST" action="/18-mvc/pokemon/store">
                        <div class="space-y-4">
                            <!-- Name -->
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text font-bold">Pokemon Name *</span>
                                </label>
                                <input type="text" name="name" required 
                                       class="input input-bordered w-full" 
                                       placeholder="e.g., Mewtwo, Charizard, Gengar" />
                            </div>

                            <!-- Type -->
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text font-bold">Type *</span>
                                </label>
                                <select name="type" required class="select select-bordered w-full">
                                    <option value="">-- Select Type --</option>
                                    <option value="Water">Water</option>
                                    <option value="Fire">Fire</option>
                                    <option value="Grass">Grass</option>
                                    <option value="Electric">Electric</option>
                                    <option value="Normal">Normal</option>
                                    <option value="Poison">Poison</option>
                                    <option value="Ghost">Ghost</option>
                                    <option value="Dragon">Dragon</option>
                                    <option value="Rock">Rock</option>
                                    <option value="Fight">Fight</option>
                                    <option value="Finght">Finght</option>
                                </select>
                            </div>

                            <!-- Stats Grid -->
                            <div class="grid grid-cols-2 gap-4">
                                <div class="form-control">
                                    <label class="label">
                                        <span class="label-text">Strength</span>
                                    </label>
                                    <input type="number" name="strength" value="100" min="0" max="9999" 
                                           class="input input-bordered w-full" />
                                </div>

                                <div class="form-control">
                                    <label class="label">
                                        <span class="label-text">Stamina</span>
                                    </label>
                                    <input type="number" name="staming" value="100" min="0" max="9999" 
                                           class="input input-bordered w-full" />
                                </div>

                                <div class="form-control">
                                    <label class="label">
                                        <span class="label-text">Speed</span>
                                    </label>
                                    <input type="number" name="speed" value="100" min="0" max="9999" 
                                           class="input input-bordered w-full" />
                                </div>

                                <div class="form-control">
                                    <label class="label">
                                        <span class="label-text">Accuracy</span>
                                    </label>
                                    <input type="number" name="accuracy" value="100" min="0" max="9999" 
                                           class="input input-bordered w-full" />
                                </div>
                            </div>

                            <!-- Trainer -->
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Trainer (optional)</span>
                                </label>
                                <select name="trainer_id" class="select select-bordered w-full">
                                    <option value="">-- No Trainer --</option>
                                    <option value="1">Ash Ketchum</option>
                                    <option value="2">Misty</option>
                                    <option value="3">Brok</option>
                                    <option value="4">Serena</option>
                                    <option value="5">Oak</option>
                                </select>
                            </div>

                            <!-- Buttons -->
                            <div class="flex gap-2 pt-4">
                                <button type="submit" class="btn btn-success flex-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                                    </svg>
                                    Add Pokemon
                                </button>
                                <a href="/18-mvc/pokemon" class="btn btn-ghost flex-1">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
