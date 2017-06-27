<?php


session_start();


require_once ("../siteCommon2Pro.php");
require_once ("d10Sql.php");
$username=$_SESSION['userInfo']['username'];


// print_r($_POST);
 //exit;
// $_POST is an associative array of the values passed via the HTTP POST method

$policynumber=$_POST['policynumber'];
$policytype=$_POST['policytype'];
$policyperiod=$_POST['policyperiod'];
$policypremium=$_POST['premium'];
$policydescription=$_POST['policydescription'];

// $movieTitle = $_POST['movietitle'];
// $pitchText = $_POST['pitchtext'];
// $ratingPK = $_POST['ratingpk'];

// remove any potentially malicious characters
$policynumber = preg_replace("/[^a-zA-Z0-9\s]/", '', $policynumber);
$policytype = preg_replace("/[^a-zA-Z0-9\s]/", '', $policytype);
$policyperiod = preg_replace("/[^0-9]/", '', $policyperiod);
$policypremium = preg_replace("/[^0-9]/", '', $policypremium);
$policydescription = preg_replace("/[^a-zA-Z0-9\s]/", '', $policydescription);


// $movieTitle = preg_replace("/[^a-zA-Z0-9\s]/", '', $movieTitle);
// $pitchText = preg_replace("/[^a-zA-Z0-9\s]/", '', $pitchText);
// $ratingPK = preg_replace("/[^0-9]/", '', $ratingPK);

// get the rating associated with the ratingpk

// if ($ratingPK != '')
// {
    // $ratingRow = getAMovieRating($ratingPK);
    // if (count($ratingRow) === 1)
    // extract($ratingRow[0]);
// }
// call the displayPageHeader method in siteCommon2.php

$heading = <<<ABC
You searched for<br />
the following policies <br />
ABC;

displayPageHeader($heading);

//Call the getMoviesByMultiCriteria method

// echo "policynumber "; echo $policynumber;
// echo "policytype ";echo $policytype;
// echo "policyperiod "; echo $policyperiod ;
// echo "policypremium " ;echo $policypremium ;
// echo "policydescription "; echo $policydescription ;

// echo $policypremium;
// echo $policydescription;
// echo $policytype;
// exit;
$policyList = getPoliciesByMultiCriteria($policynumber,$policytype,$policyperiod,$policypremium,$policydescription);

// get a count of the number of movies returned by the method

$matchingRecords = count($policyList);
echo "<section>";
if (isset($_GET['error'])){
	$error=$_GET['error'];
}
if (!empty($error))
{
    echo '<div id="error">' . $error . '</div>';
}
if ($matchingRecords === 0)
{
   echo "<h3>No matches found for the search term(s)</h3>";
}
else
{   
// prepare the output using heredoc syntax

$output = <<<ABC
<table>
   <caption>$matchingRecords policy(s) found</caption>
   <tbody>
ABC;

    foreach ($policyList as $policy)
    {
		
		
		
        extract($policy);
		$policyName=getpolicyType($policyType);
		$policyNameFinal= $policyName[0]['policyType'];
		// print_r($policy);
		// exit();
        //$movieNum ++;
		// $policyNumber=
		
        // $filmpk = urlencode(trim($filmpk));
        //$dateReleased = date_format(new DateTime($dateintheaters), "F j, Y");
        $output .= <<<ABC
        <tr>
            <td>
				Policy Number:$policyNumber <br/>
				Policy Type:$policyNameFinal <br />
			Time Period:$policyPeriod Years<br />
			Premium Amount:$ $policyPremiumAmount
            </td>
            <td>
               <a href="d10reviews.php?policyNumber=$policyNumber&username=$username">Buy Policy</a>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                Policy Details:$policyDescription
            </td>
        </tr>
ABC;
    }
    
    $output .= "<tbody></table>";
}
$output .= <<<ABC
<p style="text-align: center">
    <a href="d10search.php">[Back to Search Page]</a>
</p></section>
ABC;

// display the output

echo $output;

// call the displayPageFooter method in siteCommon2.php

displayPageFooter();
?>
