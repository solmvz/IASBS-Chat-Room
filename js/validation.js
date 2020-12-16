/*
RegEx references:
1. Testing RegEx: https://regexr.com/
2. https://www.w3resource.com/javascript/form/email-validation.php
3. https://stackoverflow.com/questions/45790123/regex-persian-date-validation
4. https://www.oreilly.com/library/view/regular-expressions-cookbook/9781449327453/ch06s07.html
5. https://stackoverflow.com/questions/59380759/regex-to-allow-only-few-special-characters-along-with-az-or-az
*/

function English(event)
{
    var p = /^[a-z ]*$/i; // just english characters and space
    if (!p.test(event))
        return false; // not english
    return true; // english
}
function Validate_Username(event)
{
    var p = /^[a-zA-Z0-9]+$/ // just english characters and numbers
    if (!p.test(event))
        return false; // invalid
    return true; // valid
}
function Validate_Email(event) 
{
    var p = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    if (!p.test(event))
        return false // invalid 
    return true // valid
}
function Validate_Password(event)
{
    var p = /^[a-zA-Z0-9-+!#$*=]+$/ // just english characters, numbers and some special characters
    if (!p.test(event))
        return false; // invalid
    return true; // valid
}

function Validate_Form() 
{
    var error = 0
    //-------------------------------------------------------------------------------------------------------------------
    var name = document.forms["register_form"]["uiName"].value;
    document.getElementById('error1').innerHTML = "";
    if (name == "")
    {
        error++;
        document.getElementById('error1').innerHTML = "Enter name. <br/>";
    }
    else if (!English(name))
    {
        error++;
        document.getElementById('error1').innerHTML = "Only use english characters. <br/>";
    }
    //-------------------------------------------------------------------------------------------------------------------
    var family = document.forms["register_form"]["uiFamily"].value;
    document.getElementById('error2').innerHTML = "";
    if (family != "")
    {
        if (!English(family))
        {
            error++;
            document.getElementById('error2').innerHTML = "Only use english characters. <br/>";
        }   
    }
    //-------------------------------------------------------------------------------------------------------------------
    var email = document.forms["register_form"]["uiEmail"].value;
    document.getElementById('error3').innerHTML = "";
    if (email == "")
    {
        error++;
        document.getElementById('error3').innerHTML = "Enter email. <br/>";
    }
    else if (!Validate_Email(email))
    {
        error++;
        document.getElementById('error3').innerHTML = "Enter a valid email address. <br/>";
    }
    //-------------------------------------------------------------------------------------------------------------------
    var username = document.forms["register_form"]["uiUsername"].value;
    document.getElementById('error4').innerHTML = "";
    if (username == "")
    {
        error++;
        document.getElementById('error4').innerHTML = "Enter username. <br/>";
    }
    else if (!Validate_Username(username))
    {
        error++;
        document.getElementById('error4').innerHTML = "Only use english characters or numbers. <br/>";
    }
    //-------------------------------------------------------------------------------------------------------------------
    var password = document.forms["register_form"]["uiPassword"].value;
    document.getElementById('error5').innerHTML = "";
    if (password == "")
    {
        error++;
        document.getElementById('error5').innerHTML = "Enter password. <br/>";
    }
    else if (!Validate_Password(password))
    {
        error++;
        document.getElementById('error5').innerHTML = "Only use english/special characters or numbers. <br/>";
    }
    //-------------------------------------------------------------------------------------------------------------------
    var reppassword = document.forms["register_form"]["uiConfirmPassword"].value;
    document.getElementById('error6').innerHTML = "";
    if (reppassword == "")
    {
        error++;
        document.getElementById('error6').innerHTML = "Repeat password. <br/>";
    }
    else if(reppassword != password)
    {
        error++;
        document.getElementById('error6').innerHTML = "Passwords do not match. <br/>";
    }
    //-------------------------------------------------------------------------------------------------------------------
    if (error > 0) 
        return false;
    else
        return true;
}