<?php


// this script checks whether the user has been authenticated
// if the session array element, "userInfo" is not set,
// the user is redirected to the login page 

session_start();

if (!isset($_SESSION['userInfo']))
{
    $redirect = $_SERVER['PHP_SELF'];
    
    if (isset($_GET['filmpk']) && is_numeric($_GET['filmpk']))
    {
        $filmPK = (int) $_GET['filmpk'];
        $redirect .= '?filmpk=' . $filmPK;
    }
    header('location: d10loginform.php?redirect=' . $redirect);
    die();
}
?>
