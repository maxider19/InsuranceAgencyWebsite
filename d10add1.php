<?php
/
session_start();
require_once ("../siteCommon2Pro.php");
require_once ("d10Sql.php");
// declare and initialize Add/Edit flag variable

$editmode = false;
$getpolicies=getpolicies();

// if a numeric filmid was passed through the URL

if ((isset($_GET['policyNumber'])) && (is_numeric($_GET['policyNumber'])))
{
    // get the details for the movie to be edited
    $policyDetails = getPolicyDetailsByID1($_GET['policyNumber']);
    
    // if movie details are returned for the filmid, set $editmode to true
    
    $editmode = (count(policyDetails) == 1);
}

// if mode is $editmode is true

if ($editmode)
{	
// print_r($policyDetails);
	 // exit;
   extract($policyDetails[0]);
   $period=$policyPeriod;
   $premium=$policyPremiumAmount;
   $description=$policyDescription;
   
   // echo $policyNumber;
   // exit();
	// print_r($policyDetails);
	// exit;
    //$dateintheaters = date_format(new DateTime($dateintheaters), 'm/d/Y');

    $formtitle = 'Update a Policy';
    $buttontext = 'Update';
 }
else  //otherwise, set the column variables to ""
{
	if(isset($_GET['error'])){
	// print_r($_GET);
	 // exit;
	$policyType=$_GET['policyType'];
	$premium=$_GET['premium'];
	$description=$_GET['description'];
	$period=$_GET['period'];
	$formtitle = 'Add a Policy';
    $buttontext = 'Insert';
	}
    
	else{
	$movietitle = '';
    $pitchtext = '';
    $amountbudgeted = '';
    $ratingfk = '';
    $summary = '';
    $imagename = '';
    $dateintheaters = '';
	$formtitle = 'Add a Policy';
    $buttontext = 'Insert';	
	}
	

   
}

// call the displayPageHeader method in siteCommon.php

displayPageHeader($formtitle);
?>
<script src="d6jsLibrary.js" type="text/javascript"></script>
<section>
<?php 

if (isset($_GET['error'])){
	$error=$_GET['error'];
}
if (!empty($error))
{
    echo '<div id="error">' . $error . '</div>';
}
?>
<form action="d10edit1a.php" method = "post" name="SearchByMultiCriteria" id="SearchByMultiCriteria" onsubmit="return checkForm(this)">
<?php
    if ($editmode)  //put the filmpk in a hidden field
    {
        echo '<input type="hidden" name="editmode" value="' . $policyNumber . '" />';
		
    }
?>
 <label for="policynumber">Policy Number:</label>
   <input type="number" name="policynumber" id="policynumber" min="1" max="10000" required  <?php if($editmode) echo "disabled" ?> value="<?php echo $policyNumber;  ?>"  />
   <label for="policytype">Policy Type:</label>   
   <select name="policytype" id="policytype">
      <option value=""></option>
          <?php
              foreach ($getpolicies as $policy)
              {
				  //extract the array elements
				  if($policyType==$policy['policyId']){
					 echo '<option selected value="' .  $policy['policyId'] .'">' . $policy['policyType'] . '</option>';
				  }
				  else{
					  echo '<option value="' . $policy['policyId'].'">' . $policy['policyType'] . '</option>';
				  }
                  
              }
          ?>
   </select>
  <label for="rating">Period(in years):</label>
    <input type="number" name="policyperiod" id="policyperiod" required min="1" max="100" value="<?php echo $period;  ?>" />
    <label for="rating">Premium Amount:</label>
   <input type="number" name="premium" id="premium" required min="1" value="<?php echo $premium; ?>" />
   <label for="rating">Description:</label>
	<input type="text" name="policydescription" id="policydescription" maxlength="100" value="<?php echo $description; ?>" required pattern="^[a-zA-Z0-9][\w\s\&,]*[a-zA-Z0-9\!\?\.]$" title="Description line has invalid characters" />  
   <input type="submit" value="<?php echo $buttontext ?>" />
   <a href="d10AddPolicy.php" style="position:relative;top:288px;">Cancel</a>
</form>
</section>



         
 
   
   

</form>

<?php
// call the displayPageFooter method in siteCommon.php

displayPageFooter();
?>