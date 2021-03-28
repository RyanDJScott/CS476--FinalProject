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
        errorMsg.innerHTML = "This email is invalid";
    }
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
        errorMsg.innerHTML = "This screenname is invalid";
    }
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
        errorMsg.innerHTML = "This password is invalid";
    }
}

function passwordConfirmChecker(event)
{
    var input = event.currentTarget.value;

    var password = document.getElementById("signupPassword").value;

    var errorMsg = document.getElementById("signupPasswordConfirmError");

    var validInput = passwordConfirmValidation(input, password);

    if(validInput == true)
    {
        errorMsg.innerHTML = "";
    }
    if(validInput == false)
    {
        errorMsg.innerHTML = "Cannot confirm passwords";
    }
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
        errorMsg.innerHTML = "This birthday is invalid";
    }
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
        errorMsg.innerHTML = "This input is invalid";
    }
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
        errorMsg.innerHTML = "This input is invalid";
    }
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
        errorMsg.innerHTML = "This input is invalid";
    }
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
        errorMsg.innerHTML = "This biography is invalid";
    }
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
        errorMsg.innerHTML = "This picture is invalid";
    }
}

/*
This function is called on submit, it ensures that all inputs on the
page are valid before the form can be submitted
*/
function submit(event)
{
    var errorMsg = document.getElementById("submitError");

    var firstName = document.getElementById("signupFName").value;
    if (nameValidation(firstName) == false)
    {
        errorMsg.innerHTML = "There is an issue with one of the fields above! Please fill out all necessary fields!";
        event.preventDefault();
    }

    var lastName = document.getElementById("signupLName").value;
    if (nameValidation(lastName) == false)
    {
        errorMsg.innerHTML = "There is an issue with one of the fields above! Please fill out all necessary fields!";
        event.preventDefault();
    }

    var email = document.getElementById("signupEmail").value;
    if(emailValidation(email) == false)
    {
        errorMsg.innerHTML = "There is an issue with one of the fields above! Please fill out all necessary fields!";
        event.preventDefault();
    }

    var screenname = document.getElementById("signupScreenname").value;
    if(screennameValidation(screenname) == false)
    {
        errorMsg.innerHTML = "There is an issue with one of the fields above! Please fill out all necessary fields!";
        event.preventDefault();
    }

    var password = document.getElementById("signupPassword").value;
    if(passwordValidation(password) == false)
    {
        errorMsg.innerHTML = "There is an issue with one of the fields above! Please fill out all necessary fields!";
        event.preventDefault();
    }

    var passwordConfirm = document.getElementById("signupPasswordConfirm").value;
    if(passwordConfirmValidation(password, passwordConfirm) == false)
    {
        errorMsg.innerHTML = "There is an issue with one of the fields above! Please fill out all necessary fields!";
        event.preventDefault();
    }

    var birthday = document.getElementById("signupBirthday").value;
    if(birthdayValidation(birthday) == false)
    {
        errorMsg.innerHTML = "There is an issue with one of the fields above! Please fill out all necessary fields!";
        event.preventDefault();
    }

    var faveGame = document.getElementById("signupFavGame").value;
    if(faveGameValidation(faveGame) == false)
    {
        errorMsg.innerHTML = "There is an issue with one of the fields above! Please fill out all necessary fields!";
        event.preventDefault();
    }

    var faveGameType = document.getElementById("signupFavGameType").value;
    if(faveGameTypeValidation(faveGameType) == false)
    {
        errorMsg.innerHTML = "There is an issue with one of the fields above! Please fill out all necessary fields!";
        event.preventDefault();
    }

    var gameTime = document.getElementById("signupGameTime").value;
    if(gameTimeValidation(gameTime) == false)
    {
        errorMsg.innerHTML = "There is an issue with one of the fields above! Please fill out all necessary fields!";
        event.preventDefault();
    }

    var biography = document.getElementById("signupBiography").value;
    if(biographyValidation(biography) == false)
    {
        errorMsg.innerHTML = "There is an issue with one of the fields above! Please fill out all necessary fields!";
        event.preventDefault();
    }

    var picture = document.getElementById("signupPic").value;
    if(pictureValidation(picture) == false)
    {
        errorMsg.innerHTML = "There is an issue with one of the fields above! Please fill out all necessary fields!";
        event.preventDefault();
    }
}