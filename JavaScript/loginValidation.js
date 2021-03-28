/*
Login wrapper functions, validate the login inputs to make sure
that they are valid before they can be passed for login
*/
function emailChecker(event)
{
    var email = event.currentTarget.value;

    var errorMsg = document.getElementById("invalidLoginEmail");
    
    var validInput = emailValidation(email);

    if(validInput == true)
    {
        errorMsg = "";
    }
    if(validInput == false)
    {
        errorMsg = "This is not a valid email";
    }
}

function passwordChecker(event)
{
    var password = event.currentTarget.value;

    var errorMsg = document.getElementById("invalidLoginPassword");
    
    var validInput = passwordValidation(password);

    if(validInput == true)
    {
        errorMsg = "";
    }
    if(validInput == false)
    {
        errorMsg = "This is not a valid password";
    }
}

//submit button, checks all inputs before submitting
function loginCheck(event)
{
    //login error message
    var errorMsg = document.getElementById("invalidLoginMessage");

    //get page inputs
    var email = document.getElementById("loginEmail");
    var password = document.getElementById("loginPassword");
    
    //check the inputs
    var validInput = (emailValidation(email) && passwordValidation(password));

    if(validInput == true)
    {
        errorMsg = "";
    }
    if(validInput == false)
    {
        errorMsg = "This was not a valid login, please check your login and try again";
    }
}