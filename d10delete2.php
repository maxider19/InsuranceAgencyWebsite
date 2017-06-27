<?php

session_start();
 include_once ("d10sql.php");


if ((isset($_GET['policyNumber'])))
{
    deletepolicy2($_GET['policyNumber'],$_SESSION['userInfo']['username']);
}

header("Location: d10myreviews.php");

?>
