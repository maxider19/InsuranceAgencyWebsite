<?php


// this method call should be placed at the start (top) of every php file that uses session variables

session_start();

require_once ("../siteCommon2Pro.php");

// call the displayPageHeader method in siteCommon2.php

displayPageHeader("Home Page");

// the session array element "userInfo" will be set (see d10loginform.php) if the user has been authenticated

$logFName = (isset($_SESSION['userInfo']))? $_SESSION['userInfo']['firstname'] : "";   

?>

<section>
<?php
   // if the user is authenticated, customize greeting"
if (!empty($logFName))
    {
		// print_r($_SESSION['userInfo']);
        echo "<p>Welcome back to Rams Insurance, <strong>$logFName</strong>!</p>";
    }
    else
    {
        echo "<p>Hello, and welcome to Rams Insurance!</p>
		<p>Please Login As an <strong>Administrator</strong> Or <strong>Customer</strong> to Use This Application</p>
		";
    }
?>

<?php 

	if(isset($_SESSION['userInfo'])&&($_SESSION['userInfo']['userrole']=='Admin')){
		echo "<p>You Have Logged in as an <strong>Administrator</strong></p>
		<p>You have the privilege to add new Insurance Policies Which will be purchased by our customers</p>
		<p>You can also make changes to existing policies in the system and also delete unwanted policies</p>";
	} 
	else if(isset($_SESSION['userInfo'])&&($_SESSION['userInfo']['userrole']=='Customer')){
		echo "<p>You Have Logged in as a <strong>Customer</strong></p>
		<p>You have the privilege to buy Insurance Policies which will be added to your account</p>
		<p>You can also search which policy is suitable for you from the wide variety of policies we offer</p>
		<p>Also you can cancel any policy that you do not require</p>";
	}
	
	

	?>


   
</section>

<?php
// call the displayPageFooter method in siteCommon2.php

displayPageFooter();
?>