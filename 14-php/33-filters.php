<?php
    $title = "33 - Filters";
    $description = "Learn how to use filters in PHP.";

include 'template/header.php';
    echo '<section style="max-width:720px;margin:2rem auto;padding:1.5rem;background:#fafafa;border-radius:8px;">';

    echo '<h2>Filtros en PHP — ejemplos</h2>';


    $email = "user@example.com";
    $url = "http://example.com";
    $dirty = "<script>alert('x')</script> Hola <b>Mundo</b>";


    $emailValid = filter_var($email, FILTER_VALIDATE_EMAIL) ? true : false;
    echo '<p><strong>Email:</strong> ' . htmlspecialchars($email) . ' — ' . ($emailValid ? '<span style="color:green">Válido</span>' : '<span style="color:red">No válido</span>') . '</p>';

    $urlValid = filter_var($url, FILTER_VALIDATE_URL) ? true : false;
    echo '<p><strong>URL:</strong> ' . htmlspecialchars($url) . ' — ' . ($urlValid ? '<span style="color:green">Válida</span>' : '<span style="color:red">No válida</span>') . '</p>';


    $sanitized = filter_var($dirty, FILTER_SANITIZE_SPECIAL_CHARS);
    echo '<p><strong>Original:</strong> ' . $dirty . '</p>';
    echo '<p><strong>Sanitizado:</strong> ' . $sanitized . '</p>';


    $data = [
        'email' => 'someone@example.com',
        'website' => 'https://example.org'
    ];
    $filters = [
        'email' => FILTER_VALIDATE_EMAIL,
        'website' => FILTER_VALIDATE_URL
    ];
    $validated = filter_var_array($data, $filters);
    echo '<h3>filter_var_array</h3>';
    echo '<pre style="background:#222;color:#fff;padding:8px;border-radius:6px;">' . htmlspecialchars(print_r($validated, true)) . '</pre>';


    echo '<h3>Prueba rápida (POST)</h3>';
    echo '<form method="post" style="display:flex;gap:8px;flex-wrap:wrap;align-items:center;">';
    echo '<input type="email" name="test_email" placeholder="Email a validar" style="padding:6px;border-radius:6px;border:1px solid #ccc;">';
    echo '<input type="url" name="test_url" placeholder="URL a validar" style="padding:6px;border-radius:6px;border:1px solid #ccc;">';
    echo '<button type="submit" style="padding:6px 10px;border-radius:6px;background:#2d89ef;color:#fff;border:none;cursor:pointer;">Validar</button>';
    echo '</form>';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $postEmail = filter_input(INPUT_POST, 'test_email', FILTER_VALIDATE_EMAIL);
        $postUrl = filter_input(INPUT_POST, 'test_url', FILTER_VALIDATE_URL);

        echo '<div style="margin-top:12px;">';
        echo '<p><strong>Resultado email POST:</strong> ' . ($postEmail ? '<span style="color:green">Válido</span>' : '<span style="color:red">No válido</span>') . '</p>';
        echo '<p><strong>Resultado URL POST:</strong> ' . ($postUrl ? '<span style="color:green">Válida</span>' : '<span style="color:red">No válida</span>') . '</p>';
        echo '</div>';
    }

    echo '</section>';

include 'template/footer.php'; ?>