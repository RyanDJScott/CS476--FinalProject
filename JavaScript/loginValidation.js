/*
Login wrapper functions, validate the login inputs to make sure
that they are valid before they can be passed for login
*/
function emailChecker(event)
{
    var email = event.currentTarget.value;

    var errorMsg = document.getElementById("invalidLoginEmail");
    
    var validInput = emailValidation(email);

    if (validInput) {
        errorMsg.innerHTML = "";
    } else if (!validInput) {
        errorMsg.innerHTML = "This is not a valid email";
    }
}

function passwordChecker(event)
{
    var password = event.currentTarget.value;

    var errorMsg = document.getElementById("invalidLoginPassword");
    
    var validInput = passwordValidation(password);

    if (validInput) {
        errorMsg.innerHTML = "";
    } else if (!validInput) {
        errorMsg.innerHTML = "This is not a valid password";
    }
}

//submit button, checks all inputs before submitting
function loginCheck(event)
{
    //login error message
    var errorMsg = document.getElementById("invalidLoginMessage");

    //get page inputs
    var email = document.getElementById("loginEmail").value;
    var password = document.getElementById("loginPassword").value;

    if(emailValidation(email) && passwordValidation(password)) {
        errorMsg.innerHTML = "";
    } else {
        errorMsg.innerHTML = "This was not a valid login, please check your login and try again";
        event.preventDefault();
    }
}