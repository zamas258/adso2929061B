<?php
    $description = "Challenge: Display the current date and time in different formats";
    $title = "25 - Challenge Dates";
    include 'template/header.php';
    echo '<section style="max-width:400px;margin:2rem auto;padding:2rem;background:#222;color:#fff;border-radius:16px;text-align:center;">';

    // Formulario para ingresar el año
    echo '<form method="post" style="margin-bottom:2rem;">
            <label for="year">Ingresa un año:</label>
            <input type="number" name="year" id="year" min="1" max="' . date('Y') . '" required style="margin:0 1rem;">
            <button type="submit">Calcular</button>
        </form>';

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['year'])) {
        $inputYear = intval($_POST['year']);
        $currentYear = intval(date('Y'));
        $yearsPassed = $currentYear - $inputYear;

        if ($yearsPassed >= 0) {
            echo "<p>Han pasado <strong>$yearsPassed</strong> años desde <strong>$inputYear</strong> hasta <strong>$currentYear</strong>.</p>";
        } else {
            echo "<p>El año ingresado es mayor al año actual.</p>";
        }
    }

    echo '</section>';
    include 'template/footer.php';

    ?>