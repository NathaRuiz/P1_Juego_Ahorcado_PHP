<?php

$colors = array(
    "Blanco",
    "Negro",
    "Rojo",
    "Azul",
    "Verde",
    "Amarillo",
    "Naranja",
    "Morado",
    "Rosa",
    "Gris",
    "Marrón",
    "Turquesa",
    "Ocre",
    "Cian",
    "Violeta",
    "Celeste",
    "Granate",
    "Dorado",
    "Plateado",
    "Índigo"
);

function randomColor($colors) {
    $index = array_rand($colors); 
    $color = $colors[$index];
    foreach (str_split($color) as $letter) {
        echo '<span class="letterColor">' . $letter . '</span>';
    }
}

if (isset($_POST['reload'])) {
    header('Location: index.php');
    exit;
}

randomColor($colors);

?>