<?php

    $title = "13 - Arrays Associative";
    $description = "Array using string keys to access corresponding values";

include 'template/header.php';
    echo '<section>';

    $characters = array(
        'Tanjiro Kamado' => 16,
        'Nezuko Kamado' => 15,
        'Zenitsu Agatsuma' => 17,
        'Inosuke Hashibira' => 18
    );

    $characters['Genya Shinazugawa'] = 20;
    $characters['Kanao Tsuyuri'] = 19;



    foreach($characters as $key => $value) {
        echo $key . ': ' . $value . '<br>';
    }

include 'template/footer.php'; ?>