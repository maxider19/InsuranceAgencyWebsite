<?php


require_once ("d10sql.php");

// assign form values to variables

$userLogin = (isset($_POST['userlogin'])) ? trim($_POST['userlogin']) : '';
$userPassword = (isset($_POST['userpassword'])) ? trim($_POST['userpassword']) : '';
$firstName = (isset($_POST['firstname'])) ? trim($_POST['firstname']) : '';
$middleName = (isset($_POST['middlename'])) ? trim($_POST['middlename']) : '';
$lastName = (isset($_POST['lastname'])) ? trim($_POST['lastname']) : '';
$gender=(isset($_POST['gender'])) ? trim($_POST['gender']) : '';
$dob = (isset($_POST['dob'])) ? trim($_POST['dob']) : '';
$address = (isset($_POST['address'])) ? trim($_POST['address']) : '';
$city = (isset($_POST['city'])) ? trim($_POST['city']) : '';
$state = (isset($_POST['state'])) ? trim($_POST['state']) : '';
$zip = (isset($_POST['zip'])) ? trim($_POST['zip']) : '';
$ssn = (isset($_POST['ssn'])) ? trim($_POST['ssn']) : '';
$country = (isset($_POST['country'])) ? trim($_POST['country']) : '';
$eMail = (isset($_POST['email'])) ? trim($_POST['email']) : '';
$phone = (isset($_POST['phone'])) ? trim($_POST['phone']) : '';
$type=(isset($_POST['type'])) ? trim($_POST['type']) : '';


// if the form was submitted

if (isset($_POST['register']))
{	
//print_r($_POST);
    // check whether the username already exists

    $result = findDuplicateUser1($userLogin);

    if (count($result) > 0)
    {
        $error = 'Please choose a different Username';
    }
    else
    {
        // insert new record
        addCustomer1($userLogin,$firstName,$middleName,$lastName,$gender,$dob,$address, $city, $state, $zip,$ssn,$eMail,$phone,$userPassword,$type);
        //redirect user to login page

        header('Refresh: 2; URL=d10loginform.php');
        echo '<h2>Thank you for Registering.  You will now be redirected to the login page.<h2>';
        die();
    }
}
require_once ("../siteCommon2Pro.php");

// call the displayPageHeader method in siteCommon2.php

displayPageHeader("New Customer Registration");
echo "<section>";
// if the user chose a duplicate username, display error

if (!empty($error))
{
    echo '<div id="error">' . $error . '</div>';
}
?>

<form name ="addUserForm" id="addUserForm" action="d10register.php" method="post">
   <label for="userlogin">Username:</label>
   <input type="text" name="userlogin" id ="userlogin" value="<?php echo $userLogin; ?>" class="ten" maxlength="10" autofocus="autofocus" required="required" pattern="^[\w@\.-]+$" title="Valid characters are a-z 0-9 _ . @ -" /><br />
   <label for="userpassword">Password:</label> 
   <input type="password" name="userpassword" id="userpassword" value="<?php echo $userPassword; ?>" class="ten" maxlength="10" required="required" pattern="^[\w@\.-]+$" title="Valid characters are a-z 0-9 _ . @ -" /><br />
   <label for="firstname">First Name:</label>
   <input type="text" name="firstname" id ="firstname" value="<?php echo $firstName; ?>" maxlength="20" class="twenty" required="required" pattern="^[a-zA-Z-]+$" title="First Name has invalid characters" /><br />
   <label for="lastname">Middle Name:</label>
   <input type="text" name="middlename" id ="middlename" value="<?php echo $middleName; ?>" maxlength="20" class="twenty" required="required" pattern="^[a-zA-Z-]+$" title="Middle Name has invalid characters" /><br />
   <label for="lastname">Last Name:</label>
   <input type="text" name="lastname" id ="lastname" value="<?php echo $lastName; ?>" maxlength="20" class="twenty" required="required" pattern="^[a-zA-Z-]+$" title="Last Name has invalid characters" /><br />
   <label for="gender">Gender:</label>
   <select name="gender" id="gender">
	<option value="M" class="twenty"  >Male</option>
	<option value="F" class="twenty" >Female</option>
	</select>
	<br /><br />
	<label for="dob">Date Of Birth:</label>
	<input type="date" name="dob" id ="dob" value="<?php echo $dob; ?>" class="twenty" required="required" title="Address has invalid characters" /><br />
   <label for="address">Address:</label>
   <input type="text" name="address" id ="address" value="<?php echo $address; ?>" maxlength="30" class="twenty" required="required" pattern="^[a-zA-Z0-9][\w\s\.]*[a-zA-Z0-9\.]$" title="Address has invalid characters" /><br />      
   <label for="city">City:</label>
   <input type="text" name="city" id ="city" value="<?php echo $city; ?>" maxlength="20" class="twenty" required="required" pattern="^[a-zA-Z][a-zA-Z\s]*[a-zA-Z]$" title="City has invalid characters" /><br />
   <label for="state">State:</label>
   <input type="text" name="state" id ="state" value="<?php echo $state; ?>" maxlength="2" required="required" pattern="^[a-zA-Z]{2}$" title="Enter a valid state" /><br />
   <label for="zip">Zip:</label>
   <input type="text" name="zip" id ="zip" value="<?php echo $zip; ?>" maxlength="10" class="ten" required="required" pattern="^\d{5}(-\d{4})?$" title="Enter a valid 5 or 9 digit zip code" /><br />   
    <label for="zip">SSN:</label>
   <input type="text" name="ssn" id ="ssn" value="<?php echo $ssn; ?>" maxlength="10" class="ten" required="required" pattern="^\d{9}?$" title="Enter a valid 9 digit ssn code" /><br />   
   <label for="email">Email:</label>
   <input type="text" name="email" id ="email" value="<?php echo $eMail; ?>" maxlength="50" class="twenty" required="required" pattern="^([\w-\.]+)@([\w]+)\.([a-zA-Z]{2,4})$" title="Enter a valid email" /> <br />
   <label for="phone">Telephone:</label>
   <input type="text" name="phone" id ="phone" value="<?php echo $phone; ?>" maxlength="12" class="ten" required="required" pattern="^(\d{3}-)?\d{3}-\d{4}$" title="Invalid phone number(xxx-xxx-xxxx)" /><br />
   <label for="type">User Type:</label>
   <select name="type" id="type">
	<option value="1" class="twenty">Admin</option>
	<option value="2" class="twenty">Customer</option>
	</select>
	<br /><br />
   <p>
      <input type="submit" value="Register" name="register" /> <br />
   </p>
</form>
</section>

<?php
// call the displayPageFooter method in siteCommon2.php

displayPageFooter();

?>