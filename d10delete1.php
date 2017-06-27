<?php


 include_once ("d10sql.php");
// print_r($_GET);
// exit;
if ((isset($_GET['policyNumber'])))
{
    deletepolicy1($_GET['policyNumber']);
	
}

header("Location: d10AddPolicy.php");
exit;

?>
