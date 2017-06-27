<?php


session_start();

require_once ("d10sql.php");

// Set local variables to $_POST array elements (userlogin and userpassword) or empty strings

$userLogin = (isset($_POST['userlogin'])) ? trim($_POST['userlogin']) : '';
$userPassword = (isset($_POST['userpassword'])) ? trim($_POST['userpassword']) : '';
   

$redirect = (isset($_REQUEST['redirect'])) ? $_REQUEST['redirect'] : 'd10home.php';

// if the form was submitted

if (isset($_POST['login']))
{
    //Call getUser method to check credentials
    $userList = getUser1($userLogin, $userPassword);
    if (count($userList)===1) //If credentials check out
    {
        extract($userList[0]);

        // assign user info to an array

        $userInfo = array('username'=>$userName, 'firstname'=>$customerFirstName, 'userrole'=>$userRole);

        // assign the array to a session array element

        $_SESSION['userInfo'] = $userInfo;
		// echo "<pre>";
		// print_r($_SESSION);
		// exit();
        session_write_close(); //typically not required; ensures that the session data is stored

        // redirect the user

        header('location:' . $redirect);
        die();
    }

    else // Otherwise, assign error message to $error
    {
        $error = 'Invalid login credentials<br />Please try again';
    }
}

// display form

require_once ("../siteCommon2Pro.php");

// call the displayPageHeader method in siteCommon2.php

displayPageHeader("Login Form");
echo "<section>";
// if error variable was set, display it

if (isset($error))
{
    echo '<div id="error">' . $error . '</div>';
}
?>

<form action="d10loginform.php" name="loginForm" id="loginForm" method="post">

    <!-- Store the redirect file name in a hidden field  -->

   <input type="hidden" name ="redirect" value ="<?php echo $redirect ?>" />
   <label for="userlogin">Username:</label>
   <input type="text" name="userlogin" id ="userlogin" value="<?php echo $userLogin; ?>" maxlength="10" autofocus="autofocus" required="required" pattern="^[\w@\.-]+$" title="User Name has invalid characters" /> <br /> <br />
   <label for="userpassword">Password:</label> 
   <input type="password" name="userpassword" id="userpassword" value="<?php echo $userPassword; ?>" maxlength="10" required="required" pattern="^[\w@\.-]+$" title="Password has invalid characters" />
      <p>
         <input type="submit" value="Login" name="login" /> <br /> <br />
         New customer?  <a href="d10register.php">Register Here</a>
      </p>
</form>
</section>
<?php
// call the displayPageFooter method in siteCommon2.php

displayPageFooter();
?>
