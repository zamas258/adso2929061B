<?php
    $description = " Display the current date and time using PHP's DateTime class with SSI";
    $title = "26 - Date and Time";
    include 'template/header.php';
    echo '<section>';
    
    echo "<p>Current Date and Time: " . $formattedDate . "</p>";
    echo '</section>';
    include 'template/footer.php';
