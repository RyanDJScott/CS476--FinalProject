/*
These are functions for the validation of inputs provided by the user
which will be called by wrapper functions. This ensures that these 
functions can be used across many pages. Error messages are page-specific
and displayed by the wrapper functions.
*/

/*
Checks the name given (first and last for user)
- cannot be blank
- cannot be more than 25 characters 
*/
function nameValidation(name)
{
    var validInput = true;

    if(name == "")
    {
        validInput = false;
    }
    if (name.length > 25)
    {
        validInput = false;
    }

    return validInput;
}

/*
Checks any email passed to website
- cannot be blank
- cannot be more than 320 characters (standard format)
- must be a valid email address
*/
function emailValidation(email)
{
    var validInput = true;

    if(email == "")
    {
        validInput = false; 
    }
    if(email.length > 320)
    {
        validInput = false;
    }
    if(!(/^\w+[\w.]*@\w+\.[a-z]{2,3}$/.test(emailInput)))
    {
        validInput = false;
    }

    return validInput;
}

/*
Checks the screenname provided
- cannot be blank
- cannot be more than 50 characters
*/
function screennameValidation(screenname)
{
    var validInput = true;

    if(screenname == "")
    {
        validInput = false;
    }
    if(screenname > 50)
    {
        validInput = false;
    }
    return false;
}

/*
Checks the password
- cannot be empty
- cannot be less than 8 characters
- cannot be more than 25 characters
- must contain one special character
- must contain one upper-case letter
*/
function passwordValidation(password)
{
    var validInput = true;

    if(password == "")
    {
        validInput = false;
    }
    if(password.length < 8)
    {
        validInput = false;
    }
    if(password.length > 25)
    {
        validInput = false;
    }
    //checks for special character
    if((/[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/.test(password)) == false)
    {
        validInput = false;
    }
    //checks for upper-case 
    if((/[A-Z]/.test(password)) == false)
    {
        validInput = false;
    }
    return validInput;
}

/*
confirm password
will need to be given botch the original and the confirmation password
- these must match
*/
function passwordConfirmValidation(password, confirmPassword)
{
    var validInput = true;

    if (password != confirmPassword)
    {
        validInput = false;
    }
    return validInput;
}

/*
checks the birthday
- must not be empty
*/
function birthdayValidation(birthday)
{
    var validInput = true;

    if(birthday == "")
    {
        validInput = false;
    }
    return validInput;
}

/*
Checks the favourite game
- can be blank
- character limit of 60
*/
function faveGameValidation(faveGame)
{
    var validInput = true;

    if(faveGame.length > 60)
    {
        validInput = false;
    }
    return validInput;
}

/*
checks the favourite game type
This is selected from a drop down menu
- cannot be blank
*/
function faveGameTypeValidation(faveGameType)
{
    var validInput = true;

    if(faveGameType == "")
    {
        validInput = false;
    }
    return validInput;
}

/*
checks the game time
This is selected from a drop down menu
- cannot be blank
*/
function gameTimeValidation(gameTime)
{
    var validInput = true;

    if(gameTime == "")
    {
        validInput = false;
    }
    return validInput;
}

/*
checks the user's biography
- can be blank
- character limit of 500
*/
function biographyValidation(biography)
{
    var validInput = true;

    if(biography.length > 500)
    {
        validInput = false;
    }
    return validInput;
}

/*
checks the URL of the picture given
- can be blank
- up to 100 characters
- checks type
*/
function pictureValidation(filePath)
{
    var validInput = true;

    /*
    if there is a picture given, search for the type and make sure it is acceptable
    */
    if(filePath != "")
    {
        var allowedExtensions = (filePathInput.toLowerCase()).search(/((.jpg)|(.jpeg)|(.gif)|(.png))$/);
        if(allowedExtensions == -1)
        {
            validInput = false;
        }
    }
    if(filePath.length > 100)
    {
        validInput = false;
    }
    
    return validInput;
}