<?php
session_start();

define("RANDOM_NUMBER_MAXIMUM", 100);
define("RANDOM_NUMBER_MINIMUM", 1);

function user_submitted_a_guess()
{
    return isset($_POST['guess']);
}

function user_guessed_correctly()
{
    return user_guess() == secret_number();
}

function user_has_guessed_too_high()
{
    return user_guess() > secret_number();
}

function user_has_guessed_too_low()
{
    return user_guess() < secret_number();
}

function user_has_requested_a_reset()
{
    return isset($_POST['reset']);
}

// conditional_fetch prevents errors for unset keys.
function conditional_fetch($hash, $key)
{
    if (isset($hash[$key])) {
        return $hash[$key];
    } else {
        return false;
    }
}

function user_guess()
{
    return conditional_fetch($_POST, 'user_guess');
}

function secret_number()
{
    return conditional_fetch($_SESSION, 'secret_number');
}

function secret_number_has_not_yet_been_set()
{
    return !isset($_SESSION['secret_number']);
}

function reset_secret_number()
{
    $_SESSION['secret_number'] = rand(RANDOM_NUMBER_MINIMUM, RANDOM_NUMBER_MAXIMUM);
}

function reset_user_guess_count()
{
    $_SESSION['guess_count'] = 0;
}

function increase_the_user_guess_count()
{
    $_SESSION['guess_count']++;
}

function user_guess_count()
{
    return conditional_fetch($_SESSION, 'guess_count');
}
