/*
Validation for editProfile.php
checks each input as recieved through event listeners. These functions
are responsble for displaying error messages and where all inputs are
verified before submission.
For the sake of readability, these are listed in the order they appear 
on the form
*/

function firstNameChecker(event)
{
    var name = event.currentTarget.value;

    var firstNameErrorMsg = document.getElementById("editFNameError");

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

    var lastNameErrorMsg = document.getElementById("editLNameError");

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

    var errorMsg = document.getElementById("editEmailError");

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

    var errorMsg = document.getElementById("editScreennameError");

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

    var errorMsg = document.getElementById("editPasswordError");

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

    var confirmPassword = document.getElementById("editPasswordConfirm");

    var errorMsg = document.getElementById("editPasswordConfirmError");

    var validInput = passwordConfirmValidation(input, confirmPassword);

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

function birthdayChecker(event)
{
    var input = event.currentTarget.value;

    var errorMsg = document.getElementById("editBirthdayError");

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

    var errorMsg = document.getElementById("editFavGameError");

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

    var errorMsg = document.getElementById("editFavGameTypeError");

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

    var errorMsg = document.getElementById("editGameTimeError");

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

    var errorMsg = document.getElementById("editBiographyError");

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

    var errorMsg = document.getElementById("editPicError");

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
    var firstName = document.getElementById("editFName");
    if (firstNameChecker(firstName) == false)
    {
        event.preventDefault();
    }

    var lastName = document.getElementById("editLName");
    if (lastNameChecker(lastName) == false)
    {
        event.preventDefault();
    }

    var email = document.getElementById("editEmail");
    if(emailChecker(email) == false)
    {
        event.preventDefault();
    }

    var screenname = document.getElementById("editScreenname");
    if(screennameChecker(screenname) == false)
    {
        event.preventDefault();
    }

    var password = document.getElementById("editPassword");
    if(passwordChecker(password) == false)
    {
        event.preventDefault();
    }

    var passwordConfirm = document.getElementById("editPasswordConfirm");
    if(passwordConfirmChecker(passwordConfirm) == false)
    {
        event.preventDefault();
    }

    var birthday = document.getElementById("editBirthday");
    if(birthdayChecker(birthday) == false)
    {
        event.preventDefault();
    }

    var faveGame = document.getElementById("editFavGame");
    if(faveGameChecker(faveGame) == false)
    {
        event.preventDefault();
    }

    var faveGameType = document.getElementById("editFavGameType");
    if(faveGameTypeChecker(faveGameType) == false)
    {
        event.preventDefault();
    }

    var gameTime = document.getElementById("editGameTime");
    if(gameTimeChecker(gameTime) == false)
    {
        event.preventDefault();
    }

    var biography = document.getElementById("editBiography");
    if(biographyChecker(biography) == false)
    {
        event.preventDefault();
    }

    var picture = document.getElementById("editPic");
    if(pictureChecker(picture) == false)
    {
        event.preventDefault();
    }
}