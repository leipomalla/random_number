<?php
require 'number_game_functions.php';

$message_for_user = "I've picked a random number between " .
    RANDOM_NUMBER_MINIMUM . " and " .
    RANDOM_NUMBER_MAXIMUM . ". Can you guess it?";

$user_has_guessed_correctly = user_guessed_correctly();

if (user_submitted_a_guess()) {
    increase_the_user_guess_count();

    if ($user_has_guessed_correctly) {
        $message_for_user = "You got it! It took you " . user_guess_count() . " attempts. Guess again?";
    } else if (user_has_guessed_too_high()) {
        $message_for_user = "Sorry, guess again but lower.";
    } else if (user_has_guessed_too_low()) {
        $message_for_user = "Sorry, guess again but higher.";
    }
}

if (secret_number_has_not_yet_been_set() || user_has_requested_a_reset() || $user_has_guessed_correctly) {
    reset_secret_number();
    reset_user_guess_count();
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Number Guessing Game</title>
</head>
<body>
    <h1>Guessing Game</h1>
    <p><?=$message_for_user?></p>

    <form method="post">
        <label for="user_guess">Your Guess</label>
        <input id="user_guess" name="user_guess">
        <input type="submit" name="guess" value="Guess">
        <input type="submit" name="reset" value="Reset">
    </form>

    <!-- Uncomment This When Testing:
        <p><strong>Secret Number:</strong> <?=secret_number()?></p>
    -->
</body>
</html>