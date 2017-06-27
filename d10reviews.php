<?php


session_start();
// print_r($_GET);
  // exit;


require_once ("../siteCommon2Pro.php");
require_once ("d10Sql.php");

$policyNumber=$_GET[policyNumber];
$username=$_GET[username];
$listPage = 'd10results.php';
// If filmpk is not passed with page request or it is not numeric, redirect to Home Page
// Else, assign the URL parameter to a variable
if (!isset($_GET['username']))
{
    header('Location:' . $listPage);
}
else
{
    $checkpolicy=checkpolicy1($username,$policyNumber);	

	foreach($checkpolicy as $check){
		//extract($checkpolicy);
		$count=$check['countOfPolicy'];
		if($count<1){
			buyPolicy1($username,$policyNumber);
			header('Location:d10myreviews.php');
		}
		else{
			header('Location:d10results.php?error=you have already purchased this policy ');
		}

		
	}

		
	
	//header('Location:d10myreviews.php');
}


// include files

// get the movietitle associated with the filmpk
// call the displayPageHeader method in siteCommon2.php
// Call the getMovieReviews method

//$reviewList = getMovieReviews($filmPK);

// get a count of the number of reviews returned by the method

//$matchingRecords = count($reviewList);

//echo "<section>";

//if ($matchingRecords === 0)
//{
  // echo "<h3>No reviews found for $movietitle</h3>";
//}
//else
//{   
// prepare the output using heredoc syntax

//$output = <<<ABC
//<table>
  // <caption>$matchingRecords review(s) found</caption>
   //<tbody>
//ABC;

  //  foreach ($reviewList as $review)
    //{
      //  extract($review);
        //$reviewpk = urlencode(trim($reviewpk));
        //$reviewDate = date_format(new DateTime($reviewdate), "F j, Y");
        //$output .= <<<ABC
        //<tr>
          //  <td colspan="3">
            //    $reviewsummary
            //</td>
        //</tr>
        // <tr>
            // <td>
               // $reviewrating Reels
            // </td>
            // <td>
                // Review Date: $reviewDate
            // </td>
            // <td>
                // Reviewer: $firstname $lastname
// ABC;
   // if (isset($_SESSION['userInfo']) && $_SESSION['userInfo']['contactpk']===$contactfk)
   // {    $output .= <<<ABC
            // <br />
            // <a href="d10editreview.php?reviewpk=$reviewpk">Edit Review</a>
// ABC;
    // }
        // $output .= "</td></tr>";
    // }
    
    // $output .= "<tbody></table>";
// }
// $output .= <<<ABC
// <p style="text-align: center">
    // <a href="d10editreview.php?filmpk=$filmPK">[Review Movie]</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="d10search.php">[Back to Search Page]</a>
// </p></section>
// ABC;

//display the output

// echo $output;

// call the displayPageFooter method in siteCommon2.php

displayPageFooter();
?>