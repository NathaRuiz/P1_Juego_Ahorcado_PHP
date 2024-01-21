<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Love+Ya+Like+A+Sister&display=swap" rel="stylesheet">
    <title>Juego del Ahorcado</title>
</head>

<body>
    <header>
        <h1>Minijuego</h1>
    </header>
    <main>
        <div class="blackboard ">

            <div class=" blackboard-content">
                <?php
                include 'game.php';
                ?>
            </div>
        </div>
    </main>

</body>

</html>