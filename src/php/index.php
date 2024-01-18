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
        <div class="blackboard image">
            <div class=" blackboard-content">
                <form action="index.php" method="POST" class="formReload">
                    <input type="submit" name="reload" value="Reiniciar juego" class="reload">
                </form>
                <h2 class="title">El Ahorcado de los Colores</h2>
                <form method="POST" action="addLetter.php" class="formAddLetter">
                    <label for="letter">Ingresa una letra:</label>
                    <input type="text" id="letter" name="letter" maxlength="1" pattern="[a-zA-Z]" required>
                    <input type="submit" value="Enviar" class="submit">
                </form>
                <div class="colorContainer">
                    <?php 
                    include 'game.php';
                    ?>
                </div>
            </div>
        </div>
    </main>
</body>
</html>