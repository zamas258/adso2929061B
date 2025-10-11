<?php
$title = "30 - Sessions";
$description = "Gestión simple de sesiones";

session_start();
$status = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    if ($action === 'set_var' && !empty($_POST['var_name'])) {
        $name = preg_replace('/[^A-Za-z0-9_]/','', $_POST['var_name']);
        $_SESSION[$name] = $_POST['var_value'] ?? '';
        $status = "Variable '$name' establecida.";
    } elseif ($action === 'regenerate') {
        session_regenerate_id(true);
        $status = 'ID de sesión regenerado.';
    } elseif ($action === 'destroy') {
        $_SESSION = [];
        session_unset();
        session_destroy();
        session_start();
        $status = 'Sesión destruida.';
    }
}

$_SESSION['views'] = ($_SESSION['views'] ?? 0) + 1;

include 'template/header.php';
?>
<section style="max-width:720px;margin:2rem auto;padding:1rem;background:#fafafa;border-radius:8px;">
    <h2>Sesiones (simple)</h2>

    <?php if ($status): ?>
        <p><?php echo htmlspecialchars($status, ENT_QUOTES, 'UTF-8'); ?></p>
    <?php endif; ?>

    <p><strong>Session ID:</strong> <?php echo htmlspecialchars(session_id(), ENT_QUOTES, 'UTF-8'); ?></p>
    <p><strong>Visitas en esta sesión:</strong> <?php echo (int)$_SESSION['views']; ?></p>

    <h3>Establecer variable</h3>
    <form method="post" style="display:flex;gap:8px;flex-wrap:wrap;">
        <input type="text" name="var_name" placeholder="clave" style="padding:6px;border-radius:6px;">
        <input type="text" name="var_value" placeholder="valor" style="padding:6px;border-radius:6px;">
        <input type="hidden" name="action" value="set_var">
        <button type="submit" style="padding:6px 10px;border-radius:6px;">Guardar</button>
    </form>

    <?php if (!empty($_SESSION)): ?>
        <h3>Variables de sesión</h3>
        <ul>
            <?php foreach ($_SESSION as $k => $v): ?>
                <li><?php echo htmlspecialchars($k, ENT_QUOTES, 'UTF-8'); ?>: <?php echo htmlspecialchars(var_export($v, true), ENT_QUOTES, 'UTF-8'); ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <div style="margin-top:12px;display:flex;gap:8px;">
        <form method="post"><input type="hidden" name="action" value="regenerate"><button type="submit" style="padding:6px 10px;border-radius:6px;">Regenerar ID</button></form>
        <form method="post"><input type="hidden" name="action" value="destroy"><button type="submit" style="padding:6px 10px;border-radius:6px;">Destruir sesión</button></form>
    </div>
</section>
<?php include 'template/footer.php'; ?>