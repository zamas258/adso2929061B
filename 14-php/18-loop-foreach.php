<?php

    $title = "18 - Loop Foreach";
    $description = "Loop that iterates over each element in an array";

include 'template/header.php';
    echo '<section>';

    $signs = ['♈ Aries', '♉ Taurus', '♊ Gemini', '♋ Cancer', '♌ Leo', '♍ Virgo'];


    foreach ($signs as $sign) {
        echo "<p>$sign</p>";
    }


include 'template/footer.php'; ?>