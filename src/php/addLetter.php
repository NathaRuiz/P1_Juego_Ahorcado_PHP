<?php
    $letter = strtoupper($_REQUEST["letter"]); // Convertir a mayúsculas para simplificar la validación

    if (preg_match("/^[A-Z]$/", $letter)) {
        echo "La letra ingresada es: $letter";
    } else {
        echo "Por favor, ingresa una única letra válida.";
    }
?>