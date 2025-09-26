<?php
    $description = "Display the current date and time using PHP's DateTime class";
    $title = "24 - Date and Time";
    include 'template/header.php';
    echo '<section>';

    $currentDateTime = new DateTime();
    $formattedDate = $currentDateTime->format('Y-m-d H:i:s');
    echo "<p>Current Date and Time: " . $formattedDate . "</p>";
    echo '</section>';
    include 'template/footer.php';
    