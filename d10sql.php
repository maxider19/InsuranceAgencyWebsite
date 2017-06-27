<?php
/*
    Author: Manan Shah
    Date: January 2017

 */

require_once '../dbConnExec1.php';

// get movie ratings

function getpolicies()
{
  $query = <<<STR
Select policyId,policyType
From policyType
STR;
return executeQuery($query);
}
function getpolicyType($policyType)
{
  $query = <<<STR
Select policyId,policyType
From policyType
where policyId=$policyType
STR;
return executeQuery($query);
}


// function getpolicyType1(policyid)
// {
 // $query = <<<STR
// Select *
// From policyType
// where policyId=$policyid
// STR;
 // return executeQuery($query);
// }
// get a specific movie rating

function getAMovieRating($ratingPK)
{
    $query = <<<STR
Select ratingpk, rating
From filmrating
where ratingpk = $ratingPK
STR;

    return executeQuery($query);
}

function getPolicyList1()
{
    $query = <<<STR
Select policyDashboard.policyNumber,policyDashboard.policyPeriod,policyDashboard.policyType,policyDashboard.policyPremiumAmount,policyDashboard.policyDescription,policyType.policyType
From policyDashboard inner join policyType
on policyDashboard.policyType=policyType.policyId
STR;
    
    return executeQuery($query);
}



function getPoliciesByMultiCriteria($policynumber,$policytype,$policyperiod,$policypremium,$policydescription)
{


    $query = <<<STR
Select policyNumber, policyType,policyPeriod, policyPremiumAmount,policyDescription
From policyDashboard
Where 0=0
STR;
    if ($policynumber != '')
    {
    $query .= <<<STR
And policyNumber <=$policynumber
STR;
    }
    if ($policytype != '')
    {
    $query .= <<<STR
And policyType = $policytype
STR;
    }
    if ($policyperiod != '')
    {
    $query .= <<<STR
And policyPeriod <= $policyperiod
STR;
    }
if ($policypremium != '')
    {
    $query .= <<<STR
And policyPremiumAmount  <= $policypremium
STR;
    }
if ($policydescription != '')
    {
    $query .= <<<STR
And policyDescription like '%$policydescription%'
STR;
    }
	
return executeQuery($query);

}


function buyPolicy1($username, $policyNumber)
{		
 $query = <<<STR
insert into userPolicy(username,policyId)
values('$username',$policyNumber)
STR;
return executeQuery($query);
}

function checkpolicy1($username, $policyNumber)
{		
 $query = <<<STR
select count (*) as countOfPolicy from userPolicy
where username='$username' and policyId=$policyNumber
STR;
return executeQuery($query);
}



// search film table on multiple criteria



// get reviews for a specific movie

function getMovieReviews($filmPK)
{
    $query = <<<STR
Select reviewpk, reviewdate, reviewsummary, reviewrating, contactfk, firstname, lastname
From filmreview inner join contact on contactpk = contactfk
where filmfk = $filmPK
STR;

    return executeQuery($query);
}

// get reviews for a specific movie
function getUserPolicies1($username)
{
    $query = <<<STR
Select * from userPolicy where username='$username';
STR;

    return executeQuery($query);
}



// get details for a secific review

function getReviewDetails($reviewPK, $contactFK)
{
    $query = <<<STR
Select reviewsummary, reviewrating, movietitle
From filmreview inner join film on filmpk = filmfk
where reviewpk = $reviewPK and contactfk = $contactFK
STR;

    return executeQuery($query);
}

// checks whether a user with the provided credentials exists

function getUser($userLogin, $userPassword)
{
    $query = <<<STR
Select contactpk, firstname, userrolename
From contact inner join userrole
on userrolefk = userrolepk
Where userlogin = '$userLogin'
and userpassword = '$userPassword'
STR;

return executeQuery($query);

}


function getUser1($userLogin, $userPassword)
{
    $query = <<<STR
Select userName, customerFirstName, userRole
From userProfile inner join userRole
on role = userId
Where userName = '$userLogin'
and password = '$userPassword'
STR;

return executeQuery($query);

}





// checks whether a username alreadys exists

function findDuplicateUser($userLogin)
{
    $query = <<<STR
Select userlogin
From contact
Where userlogin = '$userLogin'
STR;

return executeQuery($query);
}


function findDuplicateUser1($userLogin)
{
    $query = <<<STR
Select userName
From userProfile
Where userName = '$userLogin'
STR;

return executeQuery($query);
}

function findDuplicatePolicy1($policyNumber)
{
    $query = <<<STR
Select *
From policyDashboard
Where policyNumber=$policyNumber
STR;

return executeQuery($query);
}

function getPolicyDetailsByID1($policyNumber)
{
 $query = <<<STR
Select *
From policyDashboard
Where policyNumber = $policyNumber
STR;
    
    return executeQuery($query);
}



function addpolicy1($policyNumber, $policyType, $period, $premium,$description)
{
    // escape single quotes within the string (e.g., "Schindler's List" is escaped as "Schindler''s List" 
    
    $policyNumber = str_replace('\'', '\'\'', trim($policyNumber));
    $policyType = str_replace('\'', '\'\'', trim($policyType));
	$period = str_replace('\'', '\'\'', trim($period));
	$premium = str_replace('\'', '\'\'', trim($premium));
	$description = str_replace('\'', '\'\'', trim($description));
    
    
    $query = <<<STR
Insert Into policyDashboard(policyNumber,policyType,policyPeriod,policyPremiumAmount,policyDescription)
Values('$policyNumber','$policyType',$period,'$premium','$description')
STR;

    executeQuery($query);
}


function updatepolicy1($policyNumber, $policyType, $period, $premium,$description)
{
    // escape single quotes within the string (e.g., "Schindler's List" is escaped as "Schindler''s List" 
   
    $policyNumber = str_replace('\'', '\'\'', trim($policyNumber));
    $policyType = str_replace('\'', '\'\'', trim($policyType));
	$period = str_replace('\'', '\'\'', trim($period));
	$premium = str_replace('\'', '\'\'', trim($premium));
	$description = str_replace('\'', '\'\'', trim($description));
    $query = <<<STR
Update policyDashboard
Set policyType='$policyType',policyPeriod='$period',policyPremiumAmount='$premium',policyDescription='$description'
Where policyNumber='$policyNumber'
STR;

    executeQuery($query);
}
function deletePolicy1($policyNumber)
{
$query = <<<STR
Delete
From policyDashboard
Where policyNumber = $policyNumber
STR;
executeQuery($query);
$query = <<<STR
Delete
From userPolicy
Where policyId = $policyNumber
STR;
executeQuery($query);
}
function deletePolicy2($policyNumber,$username)
{
$query = <<<STR
Delete
From userPolicy
Where (policyId = '$policyNumber' and username='$username')
STR;
executeQuery($query);
}



// inserts a new row in the contacts table

function addCustomer1($userlogin,$firstname,$middlename,$lastname,$gender,$dob,$address, $city, $state, $zip,$ssn,$eMail,$phone,$userPassword,$type)
{
$query = <<<STR
Insert Into userProfile(userName, customerFirstName, customerMiddleName, customerLastName, customerGender,customerDOB,customerAddress, customerCity, customerState, customerPostalCode,ssnNumber,emailId, contactNumber, password,role)
Values('$userlogin','$firstname','$middlename','$lastname','$gender','$dob','$address','$city', '$state','$zip','$ssn','$eMail','$phone','$userPassword','$type')
STR;
    executeQuery($query);
}



// insert a new review

function addReview($filmFK, $reviewSummary, $reviewRating, $contactFK)
{
    $query = <<<STR
Insert Into filmreview(reviewsummary,reviewrating,filmfk,contactfk)
Values('$reviewSummary',$reviewRating,$filmFK,$contactFK)
STR;

    executeQuery($query);
}

// Update a review

function updateReview($reviewPK, $reviewSummary, $reviewRating)
{
    $query = <<<STR
Update filmreview
Set reviewsummary = '$reviewSummary', reviewrating = $reviewRating
Where reviewpk = $reviewPK
STR;

    executeQuery($query);
}

// delete a secific review

function deleteReview($reviewPK, $contactFK)
{
    $query = <<<STR
delete
from filmreview            
where reviewpk = $reviewPK and contactfk = $contactFK
STR;

    return executeQuery($query);
}
?>
