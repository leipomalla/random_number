<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Pick a number</title>
</head>

<body>

<form method="post">
  <label for="quantity">Pick a number between 1 and 100</label>
  <input type="number" size="3" id="quantity" name="quantity">
  <input type="submit" name="guess" value="Guess">
</form>
  <?php
session_start();

if (!isset($_SESSION['random'])) {
    $_SESSION['random'] = rand(1, 100);
}
//echo "This is a session random: " . $_SESSION['random'] . "<br>";

if (isset($_POST['guess'])) {
    if (!is_numeric($_POST['quantity']) || (empty($_POST['quantity']))) {
         echo "Oops, seems like you didn't insert an integer! Try again, please.";
     } else if (($_POST['quantity']) > 100 || ($_POST['quantity']) < 0) {
       echo "Oopsiedaisy! Please enter an integer between 0 and 100!";
     }
     else {

        $_SESSION['guesses'][] = $_POST['quantity'];

        if ($_POST['quantity'] > $_SESSION['random']) {
            echo "Number is smaller than  " . $_POST['quantity'];
        } elseif ($_POST['quantity'] < $_SESSION['random']) {
            echo "Number is bigger than " . $_POST['quantity'];
        } else {
            echo "Congrats! You guessed the number  " . $_SESSION['random'] . " right!<br>";
            echo "You guessed  " . count($_SESSION['guesses']) . " times total!<br>";

            $guesses_nicely = implode(', ', $_SESSION['guesses']);

            print "Your guesses: ";

            print_r($guesses_nicely);
            session_destroy();
            unset($_SESSION['guesses']);
            unset($_SESSION['random']);
            unset($_SESSION['quantity']);
        }
    }
}

?>

</body>
</html>