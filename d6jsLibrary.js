/*
 Purpose: Demo6 - CRUD Operations
 Author: LV
 Date: February 2017
 Javascript function library
 */

// checks for invalid characters in a string

function hasInvalidChars(aControl)
{
    //create a regular expression literal to identify invalid characters

    var reg = /[^a-zA-Z0-9\s\&\!\?\.,]/;

   //use the regular expression method - test - to check whether the string contains invalid characters

   return reg.test(aControl.value.trim());
}

// displays a message box with an appropriate message

function showAlert(aControl, aMessage)
{
    alert(aMessage);
    aControl.focus(); // sets the focus on the appropriate control
}

// this function receives a form object as its argument and performs multiple validations

function checkForm(aForm)
{
    if (hasInvalidChars(aForm.summary))
    {
       showAlert(aForm.summary, "Summary has invalid characters");
       return false;      
    }
    else if (isDate(aForm.dateintheaters.value)== false)
    {
        aForm.dateintheaters.focus();
        return false;
    }
    
    else return true;
}

/*
 * DHTML date validation script. Courtesy of SmartWebby.com (http://www.smartwebby.com/dhtml/)
 */
// Declaring valid date character, minimum year and maximum year

function isPositiveInteger(aValue)
{
    for (var i = 0; i < aValue.length; i++)  // set up a loop to check each character in the value
    {
        var aChar = aValue.charAt(i);
        if (aChar < "0" || aChar > "9")
        {
            return false;
        }
    }
    return true;
}

// finds and removes the occurences of a specific character (i.e., "/") from a string

function stripCharsInBag(aString, aChar)
{
    var i;
    var returnString = "";
    // Search through string's characters one by one.
    // If character is not in bag, append to returnString.
    for (i = 0; i < aString.length; i++)
    {
        var c = aString.charAt(i);
        if (aChar.indexOf(c) == -1) returnString += c;
    }
    return returnString;
}

// returns the number of days in February for a given year

function daysInFebruary (aYear)
{
    // February has 29 days in any year evenly divisible by four,
    // EXCEPT for centurial years which are not divisible by 400.
    
    return (((aYear % 4 == 0) && ( (!(aYear % 100 == 0)) || (aYear % 400 == 0))) ? 29 : 28 );

}

// returns the number of days in each month as an array

function getDaysInMonth()
{
    var daysArray = new Array(12);
    
    for (var i = 1; i <= 12; i++)
    {
        daysArray[i] = 31;
	if (i==4 || i==6 || i==9 || i==11)
        {
            daysArray[i] = 30;
        }
	if (i==2)
        {
            daysArray[i] = 29;
        }
   }
   return daysArray;
}

//checks whether a date string contains a valid date

function isDate(dtStr)
{
    var dtCh= "/";
    var minYear=1900;  //the minimum and maximum years can be set
    var maxYear=2020;
    
    // get the month, day and year from the date string and assign to variables

    var daysInMonth = getDaysInMonth();
    var pos1=dtStr.indexOf(dtCh);
    var pos2=dtStr.indexOf(dtCh,pos1+1);
    var strMonth=dtStr.substring(0,pos1);
    var strDay=dtStr.substring(pos1+1,pos2);
    var strYear=dtStr.substring(pos2+1);
    var strYr=strYear;

    if (strDay.charAt(0)=="0" && strDay.length>1)
    {
        strDay=strDay.substring(1);
    }
    
    if (strMonth.charAt(0)=="0" && strMonth.length>1)
    {
        strMonth=strMonth.substring(1);
    }
    
    for (var i = 1; i <= 3; i++)
    {
        if (strYr.charAt(0)=="0" && strYr.length>1)
        {
           strYr=strYr.substring(1);
        }
    }
    
    var month=parseInt(strMonth);
    var day=parseInt(strDay);
    var year=parseInt(strYr);

    if (pos1==-1 || pos2==-1)
    {
        alert("The date format should be : mm/dd/yyyy");
        return false;
    }
    if (strMonth.length<1 || month<1 || month>12)
    {
        alert("Please enter a valid month");
        return false;
    }
    if (strDay.length<1 || day<1 || day>31 || (month==2 && day>daysInFebruary(year)) || day > daysInMonth[month])
    {
        alert("Please enter a valid day");
        return false;
    }
    if (strYear.length != 4 || year==0 || year < minYear || year > maxYear)
    {
        alert("Please enter a valid 4 digit year between " + minYear + " and " + maxYear);
            return false;
    }
    if (dtStr.indexOf(dtCh,pos2+1)!=-1 || isPositiveInteger(stripCharsInBag(dtStr, dtCh))==false)
    {
        alert("Please enter a valid date");
        return false;
    }
return true
}




