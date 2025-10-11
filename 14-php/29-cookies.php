<?php
    $title = "29 - Cookies";
    $description = "Learn how to work with cookies in PHP.";

    // --- Handle POST actions BEFORE any output (set/delete) ---
    $status = '';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // determine action
        $action = $_POST['action'] ?? 'set';

        if ($action === 'set') {
            $nameRaw  = $_POST['cookie_name'] ?? '';
            $valueRaw = $_POST['cookie_value'] ?? '';

            // sanitize cookie name: allow letters, numbers, - and _
            $name = preg_replace('/[^A-Za-z0-9_\-]/', '', $nameRaw);
            $value = substr($valueRaw, 0, 200); // limit length

            if ($name === '') {
                $status = 'Cookie name inválido. Usa letras, números, guión o guión bajo.';
            } else {
                $expire = time() + 3600; // 1 hora
                $path = '/';
                $domain = ''; // opcional
                $secure = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off');
                $httponly = true;

                setcookie($name, $value, $expire, $path, $domain, $secure, $httponly);
                $status = "Cookie '" . htmlspecialchars($name, ENT_QUOTES, 'UTF-8') . "' creada.";
            }
        } elseif ($action === 'delete') {
            $nameRaw = $_POST['cookie_name'] ?? '';
            $name = preg_replace('/[^A-Za-z0-9_\-]/', '', $nameRaw);
            if ($name !== '') {
                // delete cookie by setting expiration in the past
                setcookie($name, '', time() - 3600, '/');
                // also remove from current request so UI updates
                unset($_COOKIE[$name]);
                $status = "Cookie '" . htmlspecialchars($name, ENT_QUOTES, 'UTF-8') . "' eliminada.";
            } else {
                $status = 'Nombre de cookie inválido para eliminar.';
            }
        }
    }

    include 'template/header.php';
    echo '<section style="max-width:720px;margin:2rem auto;padding:1.5rem;background:#fafafa;border-radius:8px;">';

    echo '<h2>Cookies</h2>';

    // show status
    if ($status !== '') {
        echo '<p style="padding:8px;background:#eef;border-radius:6px;">' . htmlspecialchars($status, ENT_QUOTES, 'UTF-8') . '</p>';
    }

    // form to set cookie
    $prefName = isset($_POST['cookie_name']) ? htmlspecialchars($_POST['cookie_name'], ENT_QUOTES, 'UTF-8') : '';
    $prefValue = isset($_POST['cookie_value']) ? htmlspecialchars($_POST['cookie_value'], ENT_QUOTES, 'UTF-8') : '';

    echo '<form action="" method="post" style="display:flex;gap:8px;flex-wrap:wrap;margin:12px 0;">';
    echo '<input type="text" name="cookie_name" placeholder="Cookie Name" value="' . $prefName . '" style="padding:8px;border-radius:6px;border:1px solid #ccc;">';
    echo '<input type="text" name="cookie_value" placeholder="Cookie Value" value="' . $prefValue . '" style="padding:8px;border-radius:6px;border:1px solid #ccc;flex:1;">';
    echo '<input type="hidden" name="action" value="set">';
    echo '<button type="submit" style="padding:8px 12px;border-radius:6px;background:#2d89ef;color:#fff;border:none;cursor:pointer;">Set Cookie</button>';
    echo '</form>';

    // list current cookies
    echo '<h3>Cookies actuales</h3>';
    if (!empty($_COOKIE)) {
        echo '<table style="width:100%;border-collapse:collapse;">';
        echo '<thead><tr><th style="text-align:left;padding:6px;border-bottom:1px solid #ddd;">Name</th><th style="text-align:left;padding:6px;border-bottom:1px solid #ddd;">Value</th><th style="padding:6px;border-bottom:1px solid #ddd;"></th></tr></thead><tbody>';
        foreach ($_COOKIE as $cname => $cvalue) {
            echo '<tr>';
            echo '<td style="padding:6px;border-bottom:1px solid #f1f1f1;">' . htmlspecialchars($cname, ENT_QUOTES, 'UTF-8') . '</td>';
            echo '<td style="padding:6px;border-bottom:1px solid #f1f1f1;">' . htmlspecialchars($cvalue, ENT_QUOTES, 'UTF-8') . '</td>';
            echo '<td style="padding:6px;border-bottom:1px solid #f1f1f1;">';
            echo '<form method="post" style="display:inline;">';
            echo '<input type="hidden" name="cookie_name" value="' . htmlspecialchars($cname, ENT_QUOTES, 'UTF-8') . '">';
            echo '<input type="hidden" name="action" value="delete">';
            echo '<button type="submit" style="padding:6px 8px;border-radius:6px;background:#e53935;color:#fff;border:none;cursor:pointer;">Delete</button>';
            echo '</form>';
            echo '</td>';
            echo '</tr>';
        }
        echo '</tbody></table>';
    } else {
        echo '<p>No hay cookies establecidas.</p>';
    }

    echo '</section>';
    include 'template/footer.php';
?>