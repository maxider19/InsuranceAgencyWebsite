<?php


session_start();

require_once ("d10sql.php");

// if $_POST has a reviewpk element, call the update method

if (isset($_POST['reviewpk']))
{
    updateReview((int)$_POST['reviewpk'], $_POST['reviewsummary'], (int) $_POST['reviewrating']);
    $message = "You have successfully updatated your review";
}
elseif (isset($_POST['filmpk'])) // if $_POST has a filmpk element,call the add method
{
    addReview((int) $_POST['filmpk'], $_POST['reviewsummary'], 
            (int)$_POST['reviewrating'], $_SESSION['userInfo']['contactpk']);
    $message = "You have successfully added your review";
}

header('Refresh: 2; URL=d10myreviews.php');
echo "<h2>$message. You will now be redirected to your reviews page.<h2>";
exit;

?>

