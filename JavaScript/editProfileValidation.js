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

    if (validInput) {
        firstNameErrorMsg.innerHTML = "";
    } else if (!validInput) {
        firstNameErrorMsg.innerHTML = "This is an invalid name";
    }
}

function lastNameChecker(event)
{
    var name = event.currentTarget.value;

    var lastNameErrorMsg = document.getElementById("editLNameError");

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

    var errorMsg = document.getElementById("editEmailError");

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

    var errorMsg = document.getElementById("editScreennameError");

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

    var errorMsg = document.getElementById("editPasswordError");

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

    var password = document.getElementById("editPassword").value;

    var errorMsg = document.getElementById("editPasswordConfirmError");

    var validInput = passwordConfirmValidation(input, password);

    if (validInput) {
        errorMsg.innerHTML = "";
    } else if (!validInput) {
        errorMsg.innerHTML = "Cannot confirm passwords!";
    }
}

function birthdayChecker(event)
{
    var input = event.currentTarget.value;

    var errorMsg = document.getElementById("editBirthdayError");

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

    var errorMsg = document.getElementById("editFavGameError");

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

    var errorMsg = document.getElementById("editFavGameTypeError");

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

    var errorMsg = document.getElementById("editGameTimeError");

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

    var errorMsg = document.getElementById("editBiographyError");

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

    var errorMsg = document.getElementById("editPicError");

    var validInput = pictureValidation(input);

    if (validInput) {
        errorMsg.innerHTML = "";
    } else if (!validInput) {
        errorMsg.innerHTML = "This picture is invalid";
    }
}

function deleteProfile(event) 
{
    if(!confirm("Are you sure you want to permanently delete your account?"))
    {
        event.preventDefault();
    }
}

/*
This function is called on submit, it ensures that all inputs on the
page are valid before the form can be submitted
*/
function submit(event)
{
    //Error message on page
    var errorMsg = document.getElementById("submitError");

    //Input values
    var firstName = document.getElementById("editFName").value;
    var lastName = document.getElementById("editLName").value;
    var email = document.getElementById("editEmail").value;
    var screenname = document.getElementById("editScreenname").value;
    var password = document.getElementById("editPassword").value;
    var passwordConfirm = document.getElementById("editPasswordConfirm").value;
    var birthday = document.getElementById("editBirthday").value;
    var faveGame = document.getElementById("editFavGame").value;
    var faveGameType = document.getElementById("editFavGameType").value;
    var gameTime = document.getElementById("editGameTime").value;
    var biography = document.getElementById("editBiography").value;
    var picture = document.getElementById("editPic").value;

    //If any of the one required fields fails validation, prevent submission
    if (!(nameValidation(firstName) && nameValidation(lastName) && emailValidation(email) && screennameValidation(screenname) 
        && birthdayValidation(birthday) && faveGameValidation(faveGame) && faveGameTypeValidation(faveGameType) && gameTimeValidation(gameTime)
        && biographyValidation(biography) && pictureValidation(picture))) {
            errorMsg.innerHTML = "There is an issue with one of the fields above! Please fill out all necessary fields!";
            event.preventDefault();
    }

    //Handle passwords separately; depends if it's being changed
    if(password != "" && passwordValidation(password) == false)
    {
        errorMsg.innerHTML = "There is an issue with one of the fields above! Please fill out all necessary fields!";
        event.preventDefault();
    }
    
    if(passwordConfirmValidation(password, passwordConfirm) == false)
    {
        errorMsg.innerHTML = "There is an issue with one of the fields above! Please fill out all necessary fields!";
        event.preventDefault();
    }
}