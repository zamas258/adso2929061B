<?php
    $description = "Challenge: Display the difference between a given date and today";
    $title = "25 - Challenge Dates";
    include 'template/header.php';

    $today = new DateTime();
    $currentYear = (int) $today->format('Y');

    echo '<section style="max-width:480px;margin:2rem auto;padding:2rem;background:#222;color:#fff;border-radius:16px;text-align:center;">';

    // Form
    echo '<form method="post" style="margin-bottom:1.5rem;display:flex;flex-wrap:wrap;gap:8px;justify-content:center;align-items:center;">';
    // Day select
    echo '<label for="day" style="width:100%;">Selecciona día, mes y año</label>';
    echo '<select name="day" id="day" required style="padding:6px;border-radius:6px;">';
    for ($d = 1; $d <= 31; $d++) {
        $sel = (isset($_POST['day']) && (int)$_POST['day'] === $d) ? ' selected' : '';
        echo "<option value=\"$d\"$sel>$d</option>";
    }
    echo '</select>';

    // Month select
    echo '<select name="month" id="month" required style="padding:6px;border-radius:6px;">';
    $months = [1=>'Enero',2=>'Febrero',3=>'Marzo',4=>'Abril',5=>'Mayo',6=>'Junio',7=>'Julio',8=>'Agosto',9=>'Septiembre',10=>'Octubre',11=>'Noviembre',12=>'Diciembre'];
    for ($m = 1; $m <= 12; $m++) {
        $sel = (isset($_POST['month']) && (int)$_POST['month'] === $m) ? ' selected' : '';
        echo "<option value=\"$m\"$sel>{$months[$m]}</option>";
    }
    echo '</select>';

    // Year select
    echo '<select name="year" id="year" required style="padding:6px;border-radius:6px;">';
    for ($y = $currentYear; $y >= 1; $y--) {
        $sel = (isset($_POST['year']) && (int)$_POST['year'] === $y) ? ' selected' : '';
        echo "<option value=\"$y\"$sel>$y</option>";
        // keep the list reasonable in length
        if ($currentYear - $y > 120) break;
    }
    echo '</select>';

    echo '<button type="submit" style="padding:8px 12px;border-radius:6px;background:#e53935;color:#fff;border:none;cursor:pointer;">Calcular</button>';
    echo '</form>';

    // Process
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['day'], $_POST['month'], $_POST['year'])) {
        $day = (int) $_POST['day'];
        $month = (int) $_POST['month'];
        $year = (int) $_POST['year'];

        if (!checkdate($month, $day, $year)) {
            echo '<p style="color:#ffcccb;">Fecha inválida. Por favor ingresa una fecha válida.</p>';
        } else {
            $inputDate = DateTime::createFromFormat('Y-n-j', "$year-$month-$day");
            $diff = $today->diff($inputDate);

            $y = $diff->y;
            $m = $diff->m;
            $d = $diff->d;

            $formattedInput = $inputDate->format('d-m-Y');
            $formattedToday = $today->format('d-m-Y');

            if ($diff->invert === 0) {
                // inputDate is in the future
                echo "<p>Faltan <strong>$y</strong> años, <strong>$m</strong> meses y <strong>$d</strong> días para llegar a <strong>$formattedInput</strong>.</p>";
            } else {
                // inputDate is in the past (or today)
                if ($y === 0 && $m === 0 && $d === 0) {
                    echo "<p>La fecha ingresada es hoy: <strong>$formattedToday</strong>.</p>";
                } else {
                    echo "<p>Han pasado <strong>$y</strong> años, <strong>$m</strong> meses y <strong>$d</strong> días desde <strong>$formattedInput</strong> hasta <strong>$formattedToday</strong>.</p>";
                }
            }
        }
    }

    echo '</section>';
    include 'template/footer.php';
?>