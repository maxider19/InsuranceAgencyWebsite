<?php

        
function displayPageHeader($pageTitle)
{
   $output = <<<ABC
<!DOCTYPE html>
<html>
   <head>
      <meta charset="UTF-8" />
      <title>Rams Insurance</title>
      <link rel="stylesheet" href="../stylesCommon2Pro.css" type="text/css" />
   </head>

   <body>
      <header>
         <h2>Rams Insurance - $pageTitle </h2>
      </header>
      <nav>
         <ul>
            <li><a href="d10home.php">Home</a></li>
ABC;

// the session array element "userInfo" will be set (see d8loginform.php) if the user has been authenticated

$logStatus = (isset($_SESSION['userInfo']));  
$userInfo=  $_SESSION['userInfo']; 
// print_r($logStatus);
// exit;
// if the user is authenticated, display "Log Out", else Log In"

    if ($logStatus)
    {
			extract($userInfo);
			if($userrole=='Admin'){
				$output .= '<li><a href="d10AddPolicy.php">Add policy</a></li>
						
							<li><a href="d10logout.php">Log Out</a></li>';	
			}
			else{
				$output .= '<li><a href="d10search.php">Search Policies</a></li>
							<li><a href="d10myreviews.php">My Policies</a></li>
							<li><a href="d10logout.php">Log Out</a></li>';	
				
			}
			
	}
	
    else
    {
        $output .= '<li><a href="d10loginform.php">Log In</a></li>';
    }
  
    $output .= "</ul></nav>";

   echo $output;
}
   
function displayPageFooter()
{
   $year = date('Y');
   $output = <<<ABC
   <footer>
      <address>
         &copy $year Rams Insurance
      </address>
   </footer>   
 </body>
</html>
ABC;
   echo $output;
}
?>