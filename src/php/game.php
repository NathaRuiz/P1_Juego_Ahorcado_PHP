<?php
session_start();
startGame();

$won = true;
$bodyParts = ["rightLeg", "leftLeg", "arms", "body", "head", "noHead"];

if (isset($_POST['letter'])) {
    wordHasTheLetter();
}

if (isset($_GET['Restart'])) {
    restart();
}

checkRulesGame();

function restart()
{
    session_unset();
    session_destroy();
    header("location: index.php");
}

function startGame()
{
    if (!isset($_SESSION['word'])) {
        $words = array(
            "blanco",
            "negro",
            "rojo",
            "azul",
            "verde",
            "amarillo",
            "naranja",
            "morado",
            "rosa",
            "gris",
            "marron",
            "turquesa",
            "ocre",
            "cian",
            "violeta",
            "celeste",
            "granate",
            "dorado",
            "plateado",
            "indigo"
        );
        $_SESSION['word'] = $words[array_rand($words)];
        $_SESSION['guessed_letters'] = [];
        $_SESSION['wrong_letters'] = [];
        $_SESSION['attempts'] = 5;
    } else {
        if (!isset($_SESSION['guessed_letters']) || !is_array($_SESSION['guessed_letters'])) {
            $_SESSION['guessed_letters'] = [];
        }
    }
}

function wordHasTheLetter()
{
    $guessedLetter = strtolower($_POST['letter']);

    if (ctype_alpha($guessedLetter) && strlen($guessedLetter) === 1) {
        if (strpos($_SESSION['word'], $guessedLetter) === false) {
            if (!in_array($guessedLetter, $_SESSION['wrong_letters'])) {
                $_SESSION['attempts']--;
                $_SESSION['wrong_letters'][] = $guessedLetter;
            }
        } else {
            $_SESSION['guessed_letters'][] = $guessedLetter;
        }
    }
}

function checkRulesGame()
{
    global $won;
    isSameWord();
    if ($_SESSION['attempts'] !== 0 && !$won) {
        echo '<h2 class="title">El Ahorcado de los Colores</h2>';
        echo '<div class="infoGame">';
        echo "<span>Número de intentos: {$_SESSION['attempts']} </span>";
        echo "<span>Letras incorrectas: " . implode(", ", $_SESSION['wrong_letters']) . "</span>";
        echo '</div>';
        echo '<div class="guessedLetterContainer" > 
               <img  class="image" src=" '. getCurrentImage() . '" >
               <div class="guessedLetter">
               <div class="secretWord">';

        foreach (str_split($_SESSION['word']) as $letter) {
            if (in_array($letter, $_SESSION['guessed_letters'])) {
                echo "<span>";
                echo $letter . " ";
                echo "</span>";
            } else {
                echo "<span>";
                echo "_ ";
                echo "</span>";
            }
        }
        echo '</div>';
        echo '
            <form method="post" class="formAddLetter">
            <label for="letter">Ingresa una letra:</label>
            <input type="text" name="letter" maxlength="1" pattern="[a-zA-Z]" required>
            <input type="submit" value="Enviar">
        </form> ';
        echo '</div>
            </div>';
    } else {
        resultGame();
    }
}

function isSameWord()
{
    global $won;
    foreach (str_split($_SESSION['word']) as $letter) {
        if (!in_array($letter, $_SESSION['guessed_letters'])) {
            $won = false;
            break;
        }
    }
}

function resultGame()
{
    global $won;
    if ($_SESSION['attempts'] === 0) {
        echo '<div class="result"><h1>¡Has perdido!</h1>';
        echo " <span>La palabra correcta era: {$_SESSION['word']} </span>";
        echo '<form method="get" action="">
        <input type="submit" name="Restart" value="Restart">
    </form> </div>';
        echo "<img class='image' src=" . getCurrentImage() . " >";
    }
    if ($won) {
        echo '<div class="result"><h1>¡Felicidades!</h1>';
        echo "adivinaste la palabra : {$_SESSION['word']}";
        echo '<form method="get" action="">
        <input type="submit" name="Restart" value="Restart"><br>
    </form> </div>';
    echo '<img class="imgWin" src="../assets/images/win.jpg">';
    }
}

function getCurrentImage()
{
    global $bodyParts;
    $part = $_SESSION['attempts'];
    $imgPart = $bodyParts[$part];
    return "../assets/images/" . $imgPart . ".png";
}
