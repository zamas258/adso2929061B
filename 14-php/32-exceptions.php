<?php

    $title = "32 - Exceptions";
    $description = "Learn how to handle exceptions in PHP.";

include 'template/header.php';
    echo '<section style="max-width:480px;margin:2rem auto;padding:1.5rem;background:#fafafa;border-radius:8px;text-align:center;">';

    // Mostrar formulario
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        echo '<h2>Ingresa tu edad</h2>';
        echo '<form method="post" style="display:flex;flex-direction:column;gap:8px;align-items:center;">';
        echo '<input type="number" name="age" min="0" placeholder="Edad" required style="padding:8px;border-radius:6px;border:1px solid #ccc;width:160px;text-align:center;">';
        echo '<button type="submit" style="padding:8px 12px;border-radius:6px;background:#2d89ef;color:#fff;border:none;cursor:pointer;">Enviar</button>';
        echo '</form>';
    } else {
        try {
            $age = filter_input(INPUT_POST, 'age', FILTER_VALIDATE_INT);
            if ($age === false || $age === null) {
                throw new InvalidArgumentException('Edad inválida.');
            }
            if ($age < 0) {
                throw new InvalidArgumentException('La edad no puede ser negativa.');
            }
            if ($age < 18) {
                // lanzar excepción si es menor de 18
                throw new Exception('Acceso denegado: debes ser mayor de 18 años.');
            }

            // si todo está bien
            echo '<h2 style="color:green;">Acceso permitido</h2>';
            echo '<p>Tienes ' . htmlspecialchars($age, ENT_QUOTES, 'UTF-8') . ' años.</p>';

        } catch (InvalidArgumentException $e) {
            echo '<h2 style="color:#e67e22;">Error</h2>';
            echo '<p>' . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . '</p>';
        } catch (Exception $e) {
            echo '<h2 style="color:red;">' . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . '</h2>';
            echo '<p>Si no cumples la edad mínima, no puedes continuar.</p>';
        }

        // botón para volver a intentar
        echo '<p><a href="' . htmlspecialchars($_SERVER['PHP_SELF'], ENT_QUOTES, 'UTF-8') . '" style="display:inline-block;margin-top:12px;padding:8px 12px;background:#ccc;border-radius:6px;text-decoration:none;color:#000;">Volver</a></p>';
    }

    echo '</section>';