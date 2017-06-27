<?php


require_once ("d10sql.php");
if (!isset($_POST['editmode']))
 $result = findDuplicatePolicy1($_POST['policynumber']);

// if $_POST has a filmpk element, call the update method

if (isset($_POST['editmode']))
{
    updatepolicy1($_POST['editmode'], $_POST['policytype'], $_POST['policyperiod'],
            $_POST['premium'], $_POST['policydescription']);
}
else //call the add method
{
	if (count($result) > 0)
    {
		// print_r($result);
		// exit;
        $error = 'Duplicate Policy Number';
		$period=$_POST['policyperiod'];
		$policytype=$_POST['policytype'];
		$premium=$_POST['premium'];
		$description=$_POST['policydescription'];
		header("Location: d10add1.php?error=$error&policyType=$policytype&period=$period&premium=$premium&description=$description");
		exit;
		
    }
	else{
		addPolicy1($_POST['policynumber'], $_POST['policytype'], $_POST['policyperiod'], $_POST['premium'], $_POST['policydescription']);
	}
    
}

header("Location: d10AddPolicy.php");
exit;

?>
