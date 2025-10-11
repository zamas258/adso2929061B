<?php
    $title = "26 - SSI";
    $description = "Learn how to use Server Side Includes (SSI) in PHP.";

    include 'template/header.php';
    echo '<section style="max-width:800px;margin:2rem auto;padding:1.5rem;background:#fafafa;border-radius:8px;">';

    echo '<h2>Server Side Includes (SSI) — resumen y ejemplos</h2>';
    echo '<p>SSI son directivas que el servidor procesa dentro de archivos HTML (normalmente con extensión <code>.shtml</code>) antes de enviarlos al cliente. Se escriben como comentarios HTML especiales y permiten incluir contenido de otros archivos.</p>';

    echo '<h3>Requisitos (Apache)</h3>';
    echo '<p>Asegúrate de que el servidor permita la ejecución de includes. Un ejemplo típico en <code>.htaccess</code> para habilitar SSI en archivos <code>.shtml</code>:</p>';
    echo '<pre style="background:#222;color:#e6e6e6;padding:8px;border-radius:6px;">Options +Includes
AddType text/html .shtml
AddHandler server-parsed .shtml</pre>';

    echo '<p>Con esa configuración, crea archivos con extensión <code>.shtml</code> y usa directivas SSI como:</p>';
    echo '<pre style="background:#222;color:#e6e6e6;padding:8px;border-radius:6px;"><!--#include virtual="/includes/header.html" --></pre>';
    echo '<p>La ruta en <code>virtual</code> es relativa al documento raíz del servidor.</p>';

    echo '<h3>Incluir archivos PHP</h3>';
    echo '<p>Si prefieres usar PHP (más flexible), lo habitual es usar <code>include</code>/<code>require</code> de PHP en archivos <code>.php</code>:</p>';
    echo '<pre style="background:#222;color:#e6e6e6;padding:8px;border-radius:6px;">&lt;?php include "includes/header.php"; ?&gt;</pre>';
    echo '<p>Esto no requiere habilitar SSI y es la forma recomendada cuando trabajas con PHP.</p>';

    echo '<h3>Si quieres que SSI procese archivos .php (no recomendado a menos que necesites ambas cosas)</h3>';
    echo '<p>Forzar server-parsed en .php (puede tener implicaciones de rendimiento/seguridad):</p>';
    echo '<pre style="background:#222;color:#e6e6e6;padding:8px;border-radius:6px;"># habilitar includes en .php
Options +Includes
AddHandler server-parsed .php
AddType text/html .php</pre>';
    echo '<p>Si usas esto, las directivas SSI dentro de archivos .php serán procesadas por Apache antes de pasar el resultado al intérprete PHP — esto suele producir conflictos, por lo que se recomienda usar archivos .shtml para SSI o usar includes de PHP.</p>';

    echo '<h3>Ejemplo práctico</h3>';
    echo '<p>Crear <code>/includes/footer.html</code> con HTML simple y en tu página <code>.shtml</code> poner:</p>';
    echo '<pre style="background:#222;color:#e6e6e6;padding:8px;border-radius:6px;"><!--#include virtual="/includes/footer.html" --></pre>';

    echo '<p>O, usando PHP (recomendado cuando el proyecto ya usa PHP):</p>';
    echo '<pre style="background:#222;color:#e6e6e6;padding:8px;border-radius:6px;">&lt;?php include __DIR__ . \'/includes/footer.php\'; ?&gt;</pre>';

    echo '</section>';

    include 'template/footer.php';
?>