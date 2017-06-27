<?php


session_start();

require_once ("d10logincheck.php");

require_once ("../siteCommon2.php");
require_once ("d10Sql.php");

$homePage = 'd10home.php';
$contactPK = $_SESSION['userInfo']['contactpk'];

if ((isset($_POST['reviewpk'])) && (is_numeric($_POST['reviewpk'])))
{
    deleteReview((int)$_POST['reviewpk'], $contactPK);
    $message = "You have successfuly deleted your review";
}
else
{
    $message = "Invalid or missing review";
}
header('Refresh: 2; URL=d10myreviews.php');
echo "<h2>$message. You will now be redirected to your reviews page.<h2>";
exit;

?>

