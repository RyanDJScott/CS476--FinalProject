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

//*****************************************************************************************
//*****************************************************************************************
/*
Validation functions for game-related inputs. These inputs will also
be moderated by admins, so these functions will simply ensure the 
input is within accepted parameters. 
These return a true/false value to the wrapper function, false will
indicate an error message should be displayed and true allows the
input to be passed.
*/

/*
Name function
- can't be blank
- less than 60 characters 
*/ 
function TGENameValidation(gameName)
{
    var validInput = true;

    if (gameName == "")
    {
        validInput = false;
    }
    if (gameName.length > 60)
    {
        validInput = false;
    }

    return validInput;
}

/*
Company that produced the game
- can't be blank
- less than 100 characters 
*/
function TGECompanyNameValidation(companyName)
{
    var validInput = true;

    if (companyName == "")
    {
        validInput = false;
    }
    if (companyName.length > 100)
    {
        validInput = false;
    }

    return validInput;
}

/*
Amount of time required to play the name
- can't be blank
- floating point
- greater than 0
*/
function TGEPlaytimeValidation(playtime)
{
    var validInput = true;

    if(playtime == "")
    {
        validInput = false;
    }
    if(validInput <= 0)
    {
        validInput = false;
    }
    //check if not a number
    if(isNaN(playtime))
    {
        validInput = false;
    }

    return validInput;
}

/*
Age rating provided by the game, will be displayed as ("input+ years" i.e. Recommends 3+ years to play)
- can't be blank
- must be a number
- between 0 and 19
*/
function TGEAgeValidation(age)
{
    var validInput = true;

    if(age == "")
    {
        validInput = false;
    }
    if(isNaN(age))
    {
        validInput = false;
    }
    if(age > 19 || age < 0)
    {
        validInput = false;
    }

    return validInput;
}

/*
(minimum/recommended) Number of players
- can't be blank
- must be a number
- between 0 and 20
*/
function TGEPlayersValidation(players)
{
    var validInput = true;

    if(players == "")
    {
        validInput = false;
    }
    if(isNaN(players))
    {
        validInput = false;
    }
    if(players < 0 || players > 20)
    {
        validInput = false; 
    }

    return validInput;
}


/*
Number of expansions available for the game
- can't be blank
- Number less than 30
*/
function TGEExpansionsValidation(expansions)
{
    var validInput = true;

    if(expansions == "")
    {
        validInput = false;
    }
    if(isNaN(expansions))
    {
        validInput = false;
    }
    if(expansions < 0 || expansions > 30)
    {
        validInput = false; 
    }

    return validInput;
}


/*
Description of the game as provided by the user
- can't be blank
- there's no limit to the number of characters the description can be
*/
function descriptionValidation(description)
{
    var validInput = true;

    if(description == "")
    {
        validInput = false;
    }

    return validInput;
}

/*
Checks the uploads for the images that the user can provide
- make sure that at least one photo has been uploaded
- all uploads have to be of a valid filetype
*/
function TGEUploadValidation(filePath)
{
    var validInput = true;

    if(filePath == "")
    {
        validInput = false; 
    }
    pictureValidation(filePath)
    
    return validInput;
}

//*****************************************************************************************
//*****************************************************************************************
/*
Validation functions for game review-related inputs. These inputs will also
be moderated by admins, so these functions will simply ensure the 
input is within accepted parameters. 
These return a true/false value to the wrapper function, false will
indicate an error message should be displayed and true allows the
input to be passed.
description can be validated with function from other section
line(400)
*/

/*
ratingValidation
checks the rating the user leaves for a game review
- can't be blank
- less than 10
- greater than 0
*/
function ratingValidation(rating)
{
    var validInput = true;

    if(rating > 10)
    {
        validInput = false;
    }
    if(rating < 0)
    {
        validInput = false;
    }

    return validInput;
}

/*
recommendedValidation
checks the input relating to if a game is recommended or not. As these
are radio buttons, this function will only be called when submission
is being verified.
- note: the submission validation will make sure that both are not 
empty. 
Returns true if input is present or false otherwise
*/
function recommendedValidation(userSelection)
{
    var validInput = true;

    if(userSelection == "")
    {
        validInput = false;
    }

    return validInput;
}

/*
ageValidation
checks the average age of the users
- can't be blank
- greater than 0
*/
function ageValidation(age)
{
    var validInput = true;

    if(age == "")
    {
        validInput = false;
    }
    if(age > 19)
    {
        validInput = false;
    }

    return validInput;
}

/*
playtimeValidation
uses input to call TGEplaytimeValidation function (line 295) as 
parameters and requirements are the same. This is seperate for the 
sake of organisation and readability
*/
function playtimeValidation(playtime)
{
    return TGEPlaytimeValidation(playtime);
}

/*
playedQuantityValidation
checks the number of times the reviewer has said they played the
game.
- can't be blank
- greater than 0 
*/
function playedQuantityValidation(playedQuantity)
{
    var validInput = true;

    if(playedQuantity == "")
    {
        validInput = false;
    }
    if(playedQuantity <= 0)
    {
        validInput = false;
    }

    return validInput; 
}

/*
difficultyValidation
checks the percived difficulty of the game
- can't be blank
as long as some option is selected, should pass validation
*/
function difficultyValidation(difficulty)
{
    var validInput = true;

    if(difficulty == "")
    {
        validInput = false; 
    }

    return validInput;
}

//*****************************************************************************************
//*****************************************************************************************
/*
Function(s) for making sure that flagged reviews have a reason given
as well. These functions will return a true/false value based on 
the input given, this value will be returned to the wrapper function
to allow page validation
*/

function reviewFlagDescription(description)
{
    var validInput = true;

    if(description == "")
    {
        validInput = false;
    }

    return validInput;
}