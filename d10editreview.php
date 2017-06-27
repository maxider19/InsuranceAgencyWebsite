<?php


session_start();

require_once ("d10logincheck.php");

require_once ("../siteCommon2.php");
require_once ("d10Sql.php");

$homePage = 'd10home.php';
$contactPK = $_SESSION['userInfo']['contactpk'];

// declare and initialize Add/Edit flag variable

$editmode = false;

// if a numeric filmpk was passed through the URL

if ((isset($_GET['filmpk'])) && (is_numeric($_GET['filmpk'])))
{
    $filmPK = (int) $_GET['filmpk'];
    
    // get the title of the movie to add a review
    
    $movieRow = getAMovieTitle($filmPK);
    
    // if a movie title is not returned for the filmpk, redirect to home page
    
    if (count($movieRow) !==  1)
    {
        header('Location:' . $homePage);
        exit();
    }
}
// elseif a numeric reviewpk was passed through the URL

elseif ((isset($_GET['reviewpk'])) && (is_numeric($_GET['reviewpk'])))
{
    $reviewPK = (int) $_GET['reviewpk'];
    
    // get the details for the review to be edited
    
    $reviewDetails = getReviewDetails($reviewPK, $contactPK);
    
    // if a review is not returned for the reviewpk, redirect to home page
    
    if (count($reviewDetails) !==  1)
    {
        header('Location:' . $homePage);
        exit();
    }
    else
    {
        $editmode = true;
    }
}
 // else (i.e., this page was accessed without a valid filmpk or reviewpk), redirect to home page
 else
 {
     header('Location:' . $homePage);
     exit();
 }
 
// if mode is $editmode is true

if ($editmode)
{
   extract($reviewDetails[0]);

    $formtitle = "Update your review of <br /> '$movietitle'";
    $buttontext = 'Update';
 }
else  //otherwise, set the column variables to ""
{
    extract($movieRow[0]);
    $reviewsummary = '';
    $reviewrating = '';
   
    $formtitle = "Add a review for <br /> '$movietitle'";
    $buttontext = 'Insert';
}

// call the displayPageHeader method in siteCommon2.php

displayPageHeader($formtitle);

?>
<section>
<form name ="addEditForm" id="addEditForm" action="d10editreviewa.php" method="post">

<?php
    if ($editmode)  //put the reviewpk or filmpk in a hidden field
    {
        echo '<input type="hidden" name="reviewpk" value="' . $reviewPK . '" />';
    }
    else
    {
       echo '<input type="hidden" name="filmpk" value="' . $filmPK . '" />'; 
    }
?>

<label for="reviewsummary">Review Summary:</label>   
   <input type="text" name="reviewsummary" id="reviewsummary" maxlength="100" value="<?php echo $reviewsummary; ?>" autofocus="autofocus" required="required" pattern="^[a-zA-Z][a-zA-Z\s,]*[a-zA-Z\?\.]$" title="Review summary has invalid characters" /><br /><br />
   <label for="reviewrating" id="rr">Review Rating (1 to 10 Reels):</label>
   <select name="reviewrating" id="reviewrating"> //if edit, ensure that the appropriate review rating for the review being edited is selected
      <?php
         $ratingsList = array(1,2,3,4,5,6,7,8,9,10);  // create an array of ratings
         foreach ($ratingsList as $aRating)
         {
            if ($aRating == $reviewrating)
            {
               $output .= <<<HTML
                            <option value="$aRating" selected="selected">$aRating</option>
HTML;
            }
            else
            {
               $output .= <<<HTML
                        <option value="$aRating">$aRating</option>
HTML;
            }

         }
         echo $output;
      ?>
   </select>
   <br />
   <p>
      <input type="submit" value="<?php echo $buttontext ?>" />
      <a href="d10home.php">Cancel</a>
    </p> 

</form>
</section>
<?php
// call the displayPageFooter method in siteCommon2.php

displayPageFooter();
?>
