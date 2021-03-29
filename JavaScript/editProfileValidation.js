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
        errorMsg.innerHTML = "This email is invalid";
    }
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
        errorMsg.innerHTML = "This screenname is invalid";
    }
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
        errorMsg.innerHTML = "This password is invalid";
    }
}

function passwordConfirmChecker(event)
{
    var input = event.currentTarget.value;

    var password = document.getElementById("editPassword").value;

    var errorMsg = document.getElementById("editPasswordConfirmError");

    var validInput = passwordConfirmValidation(input, password);

    if(validInput == true)
    {
        errorMsg.innerHTML = "";
    }
    if(validInput == false)
    {
        errorMsg.innerHTML = "Cannot confirm passwords!";
    }
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
        errorMsg.innerHTML = "This birthday is invalid";
    }
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
        errorMsg.innerHTML = "This input is invalid";
    }
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
        errorMsg.innerHTML = "This input is invalid";
    }
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
        errorMsg.innerHTML = "This input is invalid";
    }
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
        errorMsg.innerHTML = "This biography is invalid";
    }
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
    var errorMsg = document.getElementById("submitError");

    var firstName = document.getElementById("editFName").value;
    if (nameValidation(firstName) == false)
    {
        errorMsg.innerHTML = "There is an issue with one of the fields above! Please fill out all necessary fields!";
        event.preventDefault();
    }

    var lastName = document.getElementById("editLName").value;
    if (nameValidation(lastName) == false)
    {
        errorMsg.innerHTML = "There is an issue with one of the fields above! Please fill out all necessary fields!";
        event.preventDefault();
    }

    var email = document.getElementById("editEmail").value;
    if(emailValidation(email) == false)
    {
        errorMsg.innerHTML = "There is an issue with one of the fields above! Please fill out all necessary fields!";
        event.preventDefault();
    }

    var screenname = document.getElementById("editScreenname").value;
    if(screennameValidation(screenname) == false)
    {
        errorMsg.innerHTML = "There is an issue with one of the fields above! Please fill out all necessary fields!";
        event.preventDefault();
    }

    var password = document.getElementById("editPassword").value;
    if(password != "" && passwordValidation(password) == false)
    {
        errorMsg.innerHTML = "There is an issue with one of the fields above! Please fill out all necessary fields!";
        event.preventDefault();
    }

    var passwordConfirm = document.getElementById("editPasswordConfirm").value;
    if(passwordConfirmValidation(password, passwordConfirm) == false)
    {
        errorMsg.innerHTML = "There is an issue with one of the fields above! Please fill out all necessary fields!";
        event.preventDefault();
    }

    var birthday = document.getElementById("editBirthday").value;
    if(birthdayValidation(birthday) == false)
    {
        errorMsg.innerHTML = "There is an issue with one of the fields above! Please fill out all necessary fields!";
        event.preventDefault();
    }

    var faveGame = document.getElementById("editFavGame").value;
    if(faveGameValidation(faveGame) == false)
    {
        errorMsg.innerHTML = "There is an issue with one of the fields above! Please fill out all necessary fields!";
        event.preventDefault();
    }

    var faveGameType = document.getElementById("editFavGameType").value;
    if(faveGameTypeValidation(faveGameType) == false)
    {
        errorMsg.innerHTML = "There is an issue with one of the fields above! Please fill out all necessary fields!";
        event.preventDefault();
    }

    var gameTime = document.getElementById("editGameTime").value;
    if(gameTimeValidation(gameTime) == false)
    {
        errorMsg.innerHTML = "There is an issue with one of the fields above! Please fill out all necessary fields!";
        event.preventDefault();
    }

    var biography = document.getElementById("editBiography").value;
    if(biographyValidation(biography) == false)
    {
        errorMsg.innerHTML = "There is an issue with one of the fields above! Please fill out all necessary fields!";
        event.preventDefault();
    }

    var picture = document.getElementById("editPic").value;
    if(pictureValidation(picture) == false)
    {
        errorMsg.innerHTML = "There is an issue with one of the fields above! Please fill out all necessary fields!";
        event.preventDefault();
    }
}