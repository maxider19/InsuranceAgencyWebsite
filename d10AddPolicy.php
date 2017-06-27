<?php


session_start();
require_once ("../siteCommon2Pro.php");
require_once ("d10Sql.php");

// call the displayPageHeader method in siteCommon.php

displayPageHeader("Add/Update/Delete a Policy");

$policyList = getPolicyList1();  //gets the list of policies
// print_r($policyList);
// exit();
$output = <<<HTML
<section><table id="allMovies">
HTML;

// display each movie with links to edit or delete it

foreach ($policyList as $policy)
{
    extract($policy);
    $output .= <<<HTML
    <tr>
        <td>
            Policy Numeber:$policyNumber <br/>
			Policy Type:$policyType<br />
			Time Period:$policyPeriod Years<br />
			Premium Amount:$ $policyPremiumAmount 
        </td>
        <td>
            <a href="d10add1.php?policyNumber=$policyNumber">[Edit]</a><br/>
            <a href="d10delete1.php?policyNumber=$policyNumber">[Delete]</a>
        </td>
    </tr>
	<tr>
            <td colspan="2">
                Policy Details:$policyDescription
            </td>
        </tr>
	
HTML;
}

$output .= <<<HTML
     <tr>
        <td colspan="3" align="center">
            <a href="d10add1.php">[Add a Policy]</a>
        </td>
    </tr>
</table></section>
HTML;

echo $output;

// call the displayPageFooter method in siteCommon.php

displayPageFooter();

?>
