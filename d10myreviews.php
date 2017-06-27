<?php


session_start();

require_once ("d10logincheck.php");

require_once ("../siteCommon2Pro.php");
require_once ("d10Sql.php");

// call the displayPageHeader method in siteCommon2.php
// print_R($_SESSION);
// exit;
displayPageHeader("View/Cancel your Polices");
$reviewList = getUserPolicies1($_SESSION['userInfo']['username']);  //gets the list opolicy ids for one user


// get a count of the number of reviews returned by the method

$reviewsCount = count($reviewList);

echo "<section>";

if ($reviewsCount === 0)
{
    echo '<h3>You don\'t have any policies. <a href="d10search.php">Search Policies To Purchase</a></h3>';
}
else
{
$output = <<<HTML
<table>
      <caption>{$_SESSION['userInfo']['firstname']}, you have $reviewsCount policy(s)</caption>
      <tbody>
HTML;

// display each review with a link to edit the review or a button to delete it

foreach ($reviewList as $review)
{	
	extract($review);
	$policyDetails=findDuplicatePolicy1($policyId);
	foreach($policyDetails as $details){
		extract($details);
		//echo $policyType;
		$typeP=getpolicyType($policyType);
		foreach($typeP as $typePolicy){
				$typeFinal=$typePolicy['policyType'];
		}
		$output .= <<<ABC
        <tr>
            <td>
			Policy Number:$policyNumber <br/>
			Policy Type:$typeFinal<br />
			Time Period:$policyPeriod Years<br />
			Premium Amount:$ $policyPremiumAmount
            </td>
            <td>
			<a href="d10delete2.php?policyNumber=$policyNumber">[Delete]</a>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                Policy Details:$policyDescription
            </td>
        </tr>
ABC;
	}
	
}
$output .= "<tbody></table>";
echo $output;
}
echo "</section><br />";
// call the displayPageFooter method in siteCommon2.php

displayPageFooter();

?>
