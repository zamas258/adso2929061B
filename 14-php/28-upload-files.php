<?php
$title = "28 - Upload Files";
$description = "Learn how to upload files in PHP.";

include 'template/header.php';
echo '<section>';
echo '<h2>Upload Files</h2>';
echo '<form action="" method="post" enctype="multipart/form-data">';
echo '<input type="file" name="fileToUpload" id="fileToUpload" accept="image/*">';
echo '<input type="submit" value="Upload File" name="submit">';
echo '</form>';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_FILES['fileToUpload']['name'])) {
    $tmp = $_FILES['fileToUpload']['tmp_name'];
    $origName = basename($_FILES['fileToUpload']['name']);
    $ext = strtolower(pathinfo($origName, PATHINFO_EXTENSION));
    $allowed = ['jpg','jpeg','png','gif','webp','svg'];

    // Validar tipo imagen (getimagesize no detecta svg, se permite svg por extensión)
    $isImage = @getimagesize($tmp) !== false || $ext === 'svg';
    if (!$isImage) {
        echo "<p style='color:red;'>El archivo no parece ser una imagen válida.</p>";
    } elseif (!in_array($ext, $allowed)) {
        echo "<p style='color:red;'>Tipo no permitido. Usa: " . implode(', ', $allowed) . ".</p>";
    } else {
        $uploadDir = __DIR__ . '/uploads/';
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

        // nombre seguro y único
        $safeName = time() . '_' . bin2hex(random_bytes(4)) . '.' . $ext;
        $targetFile = $uploadDir . $safeName;

        if (move_uploaded_file($tmp, $targetFile)) {
            $publicPath = 'uploads/' . $safeName; // ruta accesible desde el navegador
            echo "<p>El archivo " . htmlspecialchars($origName, ENT_QUOTES, 'UTF-8') . " se subió correctamente.</p>";
            echo "<p><img src=\"" . htmlspecialchars($publicPath, ENT_QUOTES, 'UTF-8') . "\" alt=\"uploaded\" style=\"max-width:100%;height:auto;border-radius:8px;box-shadow:0 4px 12px rgba(0,0,0,.3);\"></p>";
        } else {
            echo "<p style='color:red;'>Hubo un error al subir el archivo.</p>";
        }
    }
}

echo '</section>';
include 'template/footer.php';