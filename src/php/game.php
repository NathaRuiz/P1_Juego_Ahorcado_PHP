<?php
session_start();
startGame();

$won = true;
$bodyParts = ["rightLeg","leftLeg" ,"arms" ,"body" ,"head" ,"noHead"];

if (isset($_POST['letter'])) {
    wordHasTheLetter();
}

//Restart
if (isset($_GET['Restart'])) {
    echo '<script>console.log("entró")</script>';
   restart();
}
// Check if the game is won or lost


checkRulesGame();

function restart(){
    session_unset();
    session_destroy();
    header("location: index.php");
}

// Initialize the game if not already started
function startGame(){
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
        // Ensure guessed_letters is an array
        if (!isset($_SESSION['guessed_letters']) || !is_array($_SESSION['guessed_letters'])) {
            $_SESSION['guessed_letters'] = [];
        }
    }
}

// Check if a letter is submitted
function wordHasTheLetter(){
    $guessedLetter = strtolower($_POST['letter']);

    // Check if the guessed letter is valid
    if (ctype_alpha($guessedLetter) && strlen($guessedLetter) === 1) {
        // Check if the letter is in the word
        if (strpos($_SESSION['word'], $guessedLetter) === false) {
            $_SESSION['attempts']--;
            $_SESSION['wrong_letters'][] = $guessedLetter;
        } else {
            $_SESSION['guessed_letters'][] = $guessedLetter;
        }       
    }
}

function checkRulesGame(){
    global $won;
    isSameWord();
    if($_SESSION['attempts'] !== 0 && !$won){
        echo "Attempts remaining: {$_SESSION['attempts']}<br>";
        echo "Wrong letters: " . implode(", ", $_SESSION['wrong_letters']) . "<br>";
        echo "<img  class='image' src=". getCurrentImage()." >";
        // Display the word with underscores for unguessed letters
        foreach (str_split($_SESSION['word']) as $letter) {
            if (in_array($letter, $_SESSION['guessed_letters'])) {
                echo $letter . " ";
            } else {
                echo "_ ";
            }
        }
        // Display the form for guessing a letter
        echo '
            <form method="post" action="" class="formReload">
                <label for="letter">Guess a letter:</label>
                <input type="text" name="letter" maxlength="1" pattern="[a-zA-Z]" required>
                <input type="submit" value="Guess">
            </form> 
            <form method="get" action="" class="formAddLetter">
                <input type="submit" name="Restart" value="Restart">
            </form> ';
    }
    else{
        resultGame();
    }
}

function isSameWord(){
    global $won;
    foreach (str_split($_SESSION['word']) as $letter) {
        if (!in_array($letter, $_SESSION['guessed_letters'])) {
            $won = false;
            break;
        }
    }
}

function resultGame(){
    global $won;
    if ($_SESSION['attempts'] === 0) {
        echo "You lost! The correct word was: {$_SESSION['word']}";
        echo '<form method="get" action="">
        <input type="submit" name="Restart" value="Restart">
    </form> ';
    echo "<img class='image' src=". getCurrentImage()." >";
       
    }
    if ($won) {
        echo "Congratulations! You guessed the word: {$_SESSION['word']}";
        echo '<form method="get" action="">
        <input type="submit" name="Restart" value="Restart">
    </form> ';
        
    } 
}

function getCurrentImage(){
    global $bodyParts;
    $part = $_SESSION['attempts'];
    $imgPart = $bodyParts[$part];
    return "../assets/images/".$imgPart.".png";
}


?>
