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

    if (validInput) {
        firstNameErrorMsg.innerHTML = "";
    } else if (!validInput) {
        firstNameErrorMsg.innerHTML = "This is an invalid name";
    }
}

function lastNameChecker(event)
{
    var name = event.currentTarget.value;

    var lastNameErrorMsg = document.getElementById("signupLNameError");

    var validInput = nameValidation(name);

    if (validInput) {
        lastNameErrorMsg.innerHTML = "";
    } else if (!validInput) {
        lastNameErrorMsg.innerHTML = "This is an invalid last name";
    }
}

function emailChecker(event)
{
    var input = event.currentTarget.value;

    var errorMsg = document.getElementById("signupEmailError");

    var validInput = emailValidation(input);

    if (validInput) {
        errorMsg.innerHTML = "";
    } else if (!validInput) {
        errorMsg.innerHTML = "This email is invalid";
    }
}

function screennameChecker(event)
{
    var screename = event.currentTarget.value;

    var errorMsg = document.getElementById("signupScreennameError");

    var validInput = screennameValidation(screename);

    if (validInput) {
        errorMsg.innerHTML = "";
    } else if (!validInput) {
        errorMsg.innerHTML = "This screenname is invalid";
    }
}

function passwordChecker(event)
{
    var input = event.currentTarget.value;

    var errorMsg = document.getElementById("signupPasswordError");

    var validInput = passwordValidation(input);

    if (validInput) {
        errorMsg.innerHTML = "";
    } else if (!validInput) {
        errorMsg.innerHTML = "This password is invalid";
    }
}

function passwordConfirmChecker(event)
{
    var input = event.currentTarget.value;

    var password = document.getElementById("signupPassword").value;

    var errorMsg = document.getElementById("signupPasswordConfirmError");

    var validInput = passwordConfirmValidation(input, password);

    if (validInput) {
        errorMsg.innerHTML = "";
    } else if (!validInput) {
        errorMsg.innerHTML = "Cannot confirm passwords";
    }
}

function birthdayChecker(event)
{
    var input = event.currentTarget.value;

    var errorMsg = document.getElementById("signupBirthdayError");

    var validInput = birthdayValidation(input);

    if (validInput) {
        errorMsg.innerHTML = "";
    } else if (!validInput) {
        errorMsg.innerHTML = "This birthday is invalid";
    }
}

function faveGameChecker(event)
{
    var input = event.currentTarget.value;

    var errorMsg = document.getElementById("signupFavGameError");

    var validInput = faveGameValidation(input);

    if (validInput) {
        errorMsg.innerHTML = "";
    } else if (!validInput) {
        errorMsg.innerHTML = "This input is invalid";
    }
}

function faveGameTypeChecker(event)
{
    var input = event.currentTarget.value;

    var errorMsg = document.getElementById("signupFavGameTypeError");

    var validInput = faveGameTypeValidation(input);

    if (validInput) {
        errorMsg.innerHTML = "";
    } else if (!validInput) {
        errorMsg.innerHTML = "This input is invalid";
    }
}

function gameTimeChecker(event)
{
    var input = event.currentTarget.value;

    var errorMsg = document.getElementById("signupGameTimeError");

    var validInput = gameTimeValidation(input);

    if (validInput) {
        errorMsg.innerHTML = "";
    } else if (!validInput) {
        errorMsg.innerHTML = "This input is invalid";
    }
}

function biographyChecker(event)
{
    var input = event.currentTarget.value;

    var errorMsg = document.getElementById("signupBiographyError");

    var validInput = biographyValidation(input);

    if (validInput) {
        errorMsg.innerHTML = "";
    } else if (!validInput) {
        errorMsg.innerHTML = "This biography is invalid";
    }
}

function pictureChecker(event)
{
    var input = event.currentTarget.value;

    var errorMsg = document.getElementById("signupPicError");

    var validInput = pictureValidation(input);

    if (validInput) {
        errorMsg.innerHTML = "";
    } else if (!validInput) {
        errorMsg.innerHTML = "This picture is invalid";
    }
}

/*
This function is called on submit, it ensures that all inputs on the
page are valid before the form can be submitted
*/
function submit(event)
{
    //Get the error message tag
    var errorMsg = document.getElementById("submitError");

    //Get the input values 
    var firstName = document.getElementById("signupFName").value;
    var lastName = document.getElementById("signupLName").value;
    var email = document.getElementById("signupEmail").value;
    var screenname = document.getElementById("signupScreenname").value;
    var password = document.getElementById("signupPassword").value;
    var passwordConfirm = document.getElementById("signupPasswordConfirm").value;
    var birthday = document.getElementById("signupBirthday").value;
    var faveGame = document.getElementById("signupFavGame").value;
    var faveGameType = document.getElementById("signupFavGameType").value;
    var gameTime = document.getElementById("signupGameTime").value;
    var biography = document.getElementById("signupBiography").value;
    var picture = document.getElementById("signupPic").value;


    if (!(nameValidation(firstName) && nameValidation(lastName) && screennameValidation(screenname) && passwordValidation(password)
        && passwordConfirmValidation(password, passwordConfirm) && birthdayValidation(birthday) && faveGameValidation(faveGame)
        && faveGameTypeValidation(faveGameType) && gameTimeValidation(gameTime) && biographyValidation(biography) && pictureValidation(picture))) {
            errorMsg.innerHTML = "There is an issue with one of the fields above! Please fill out all necessary fields!";
            event.preventDefault();
    }
}