/*
Validation for signup.php
checks each input as recieved through event listeners. These functions
are responsble for displaying error messages and where all inputs are
verified before submission.
For the sake of readability, these are listed in the order they appear 
on the form
*/

function firstNameChecker(event)
{
    var name = event.currentTarget.value;

    var firstNameErrorMsg = document.getElementById("signupFNameError");

    var validInput = nameValidation(name);

    if(validInput == true)
    {
        firstNameErrorMsg.innerHTML = "";
    }
    if(validInput == false)
    {
        firstNameErrorMsg.innerHTML = "This is an invalid name";
    }
    return validInput;
}

function lastNameChecker(event)
{
    var name = event.currentTarget.value;

    var lastNameErrorMsg = document.getElementById("signupLNameError");

    var validInput = nameValidation(name);

    if(validInput == true)
    {
        lastNameErrorMsg.innerHTML = "";
    }
    if(validInput == false)
    {
        lastNameErrorMsg.innerHTML = "This is an invalid last name";
    }
    return validInput;
}

function emailChecker(event)
{
    var input = event.currentTarget.value;

    var errorMsg = document.getElementById("signupEmailError");

    var validInput = emailValidation(input);

    if(validInput == true)
    {
        errorMsg.innerHTML = "";
    }
    if(validInput == false)
    {
        errorMsg = "This email is invalid";
    }
    return validInput;
}

function screennameChecker(event)
{
    var screename = event.currentTarget.value;

    var errorMsg = document.getElementById("signupScreennameError");

    var validInput = screennameValidation(screename);

    if(validInput == true)
    {
        errorMsg.innerHTML = "";
    }
    if(validInput == false)
    {
        errorMsg = "This screenname is invalid";
    }
    return validInput;
}

function passwordChecker(event)
{
    var input = event.currentTarget.value;

    var errorMsg = document.getElementById("signupPasswordError");

    var validInput = passwordValidation(input);

    if(validInput == true)
    {
        errorMsg.innerHTML = "";
    }
    if(validInput == false)
    {
        errorMsg = "This password is invalid";
    }
    return validInput;
}

function passwordConfirmChecker(event)
{
    var input = event.currentTarget.value;

    var confirmPassword = document.getElementById("signupPasswordConfirm");

    var errorMsg = document.getElementById("signupPasswordConfirmError");

    var validInput = passwordConfirmValidation(input, confirmPassword);

    if(validInput == true)
    {
        errorMsg.innerHTML = "";
    }
    if(validInput == false)
    {
        errorMsg = "Cannot confirm passwords";
    }
    return validInput;
}

function birthdayChecker(event)
{
    var input = event.currentTarget.value;

    var errorMsg = document.getElementById("signupBirthdayError");

    var validInput = birthdayValidation(input);

    if(validInput == true)
    {
        errorMsg.innerHTML = "";
    }
    if(validInput == false)
    {
        errorMsg = "This birthday is invalid";
    }
    return validInput;
}

function faveGameChecker(event)
{
    var input = event.currentTarget.value;

    var errorMsg = document.getElementById("signupFavGameError");

    var validInput = faveGameValidation(input);

    if(validInput == true)
    {
        errorMsg.innerHTML = "";
    }
    if(validInput == false)
    {
        errorMsg = "This input is invalid";
    }
    return validInput;
}

function faveGameTypeChecker(event)
{
    var input = event.currentTarget.value;

    var errorMsg = document.getElementById("signupFavGameTypeError");

    var validInput = faveGameTypeValidation(input);

    if(validInput == true)
    {
        errorMsg.innerHTML = "";
    }
    if(validInput == false)
    {
        errorMsg = "This input is invalid";
    }
    return validInput;
}

function gameTimeChecker(event)
{
    var input = event.currentTarget.value;

    var errorMsg = document.getElementById("signupGameTimeError");

    var validInput = gameTimeValidation(input);

    if(validInput == true)
    {
        errorMsg.innerHTML = "";
    }
    if(validInput == false)
    {
        errorMsg = "This input is invalid";
    }
    return validInput;
}

function biographyChecker(event)
{
    var input = event.currentTarget.value;

    var errorMsg = document.getElementById("signupBiographyError");

    var validInput = biographyValidation(input);

    if(validInput == true)
    {
        errorMsg.innerHTML = "";
    }
    if(validInput == false)
    {
        errorMsg = "This biography is invalid";
    }
    return validInput;
}

function pictureChecker(event)
{
    var input = event.currentTarget.value;

    var errorMsg = document.getElementById("signupPicError");

    var validInput = pictureValidation(input);

    if(validInput == true)
    {
        errorMsg.innerHTML = "";
    }
    if(validInput == false)
    {
        errorMsg = "This picture is invalid";
    }
    return validInput;
}

/*
This function is called on submit, it ensures that all inputs on the
page are valid before the form can be submitted
*/
function submit(event)
{
    var firstName = document.getElementById("signupFName");
    if (firstNameChecker(firstName) == false)
    {
        event.preventDefault();
    }

    var lastName = document.getElementById("signupLName");
    if (lastNameChecker(lastName) == false)
    {
        event.preventDefault();
    }

    var email = document.getElementById("signupEmail");
    if(emailChecker(email) == false)
    {
        event.preventDefault();
    }

    var screenname = document.getElementById("signupScreenname");
    if(screennameChecker(screenname) == false)
    {
        event.preventDefault();
    }

    var password = document.getElementById("signupPassword");
    if(passwordChecker(password) == false)
    {
        event.preventDefault();
    }

    var passwordConfirm = document.getElementById("signupPasswordConfirm");
    if(passwordConfirmChecker(passwordConfirm) == false)
    {
        event.preventDefault();
    }

    var birthday = document.getElementById("signupBirthday");
    if(birthdayChecker(birthday) == false)
    {
        event.preventDefault();
    }

    var faveGame = document.getElementById("signupFavGame");
    if(faveGameChecker(faveGame) == false)
    {
        event.preventDefault();
    }

    var faveGameType = document.getElementById("signupFavGameType");
    if(faveGameTypeChecker(faveGameType) == false)
    {
        event.preventDefault();
    }

    var gameTime = document.getElementById("signupGameTime");
    if(gameTimeChecker(gameTime) == false)
    {
        event.preventDefault();
    }

    var biography = document.getElementById("signupBiography");
    if(biographyChecker(biography) == false)
    {
        event.preventDefault();
    }

    var picture = document.getElementById("signupPic");
    if(pictureChecker(picture) == false)
    {
        event.preventDefault();
    }
}