<?php $baseUrl = '/18-mvc/pokemon'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Pokemon - Pokemon CRUD</title>
    // ...existing code...
</head>

<body>
    <div style="max-width: 800px; margin: 0 auto; padding: 20px;">
        <h2>Add New Pokemon</h2>
        <a href="/pokemon">Back</a>
        <br><br>

        <form method="POST" action="/pokemon/store">
            <label for="name">Pokemon Name *</label><br>
            <input type="text" name="name" required placeholder="e.g., Mewtwo, Charizard, Gengar" style="width: 100%; padding: 8px; margin-bottom: 10px;" />
            <br>

            <label for="type">Type *</label><br>
            <select name="type" required style="width: 100%; padding: 8px; margin-bottom: 10px;">
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
                <option value="Fighting">Fighting</option>
            </select>
            <br>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
                <div>
                    <label for="strength">Strength</label><br>
                    <input type="number" name="strength" value="100" min="0" max="9999" style="width: 100%; padding: 8px;" />
                </div>
                <div>
                    <label for="staming">Stamina</label><br>
                    <input type="number" name="staming" value="100" min="0" max="9999" style="width: 100%; padding: 8px;" />
                </div>
                <div>
                    <label for="speed">Speed</label><br>
                    <input type="number" name="speed" value="100" min="0" max="9999" style="width: 100%; padding: 8px;" />
                </div>
                <div>
                    <label for="accuracy">Accuracy</label><br>
                    <input type="number" name="accuracy" value="100" min="0" max="9999" style="width: 100%; padding: 8px;" />
                </div>
            </div>
            <br>

            <label for="trainer_id">Trainer (optional)</label><br>
            <select name="trainer_id" style="width: 100%; padding: 8px; margin-bottom: 10px;">
                <option value="">-- No Trainer --</option>
                <option value="1">Ash Ketchum</option>
                <option value="2">Misty</option>
                <option value="3">Brok</option>
                <option value="4">Serena</option>
                <option value="5">Oak</option>
            </select>
            <br>

            <button type="submit" style="padding: 10px 20px; background: green; color: white; border: none;">Add Pokemon</button>
            <a href="/pokemon" style="padding: 10px 20px; background: gray; color: white; text-decoration: none;">Cancel</a>
        </form>
    </div>
</body>

</html>