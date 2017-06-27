<?php
/*
    Author: Manan Shah
    Date: January 2017

 */

session_start();

require_once ("../siteCommon2Pro.php");
require_once ("d10Sql.php");

// get the ratings from the FilmRating table

$getpolicies = getpolicies();

// call the displayPageHeader method in siteCommon2.php

displayPageHeader("<br />Search for a policy by its Type, Time Period ,premium amount and/or description <br />");
?>

<section>
<form action="d10results.php" method = "post" name="SearchByMultiCriteria" id="SearchByMultiCriteria">
<label for="policynumber">Policy Number:</label>
   <input type="number" name="policynumber" id="policynumber" min="1" max="10000"  />
   <label for="policytype">Policy Type:</label>   
   <select name="policytype" id="policytype">
      <option value=""></option>
          <?php
              foreach ($getpolicies as $policy)
              {
				  //extract the array element
					 echo '<option  value="' .  $policy['policyId'] .'">' . $policy['policyType'] . '</option>';
              }
          ?>
   </select>
  <label for="rating">Period(in years):</label>
    <input type="number" name="policyperiod" id="policyperiod"  min="1" max="100" />
    <label for="rating">Premium Amount:</label>
   <input type="number" name="premium" id="premium"  min="1" />
   <label for="rating">Description:</label>
	<input type="text" name="policydescription" id="policydescription" maxlength="100"  pattern="^[a-zA-Z0-9][\w\s\&,]*[a-zA-Z0-9\!\?\.]$" title="Description line has invalid characters" />
   
   <input name = "search" type="submit" value="Search" />
</form>
</section>












<?php

// call the displayPageFooter method in siteCommon2.php

displayPageFooter();
?>
