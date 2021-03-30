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
    if (name == "")
        return false;
    else if (name.length > 25)
        return false;
    else 
        return true;
}

/*
Checks any email passed to website
- cannot be blank
- cannot be more than 320 characters (standard format)
- must be a valid email address
*/
function emailValidation(email)
{
    if (email == "")
        return false;
    else if (email.length > 320)
        return false;
    else if (!(/^\w+[\w.]*@\w+\.[a-z]{2,3}$/.test(email)))
        return false;
    else
        return true;
}

/*
Checks the screenname provided
- cannot be blank
- cannot be more than 50 characters
*/
function screennameValidation(screenname)
{
    if (screenname == "")
        return false;
    else if (screenname.length > 50)
        return false;
    else
        return true;
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
    if (password == "")
        return false;
    else if (password.length < 8 || password.length > 25)
        return false;
    else if (!(/[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/.test(password)))
        return false;
    else if (!(/[A-Z]/.test(password)))
        return false;
}

/*
confirm password
will need to be given botch the original and the confirmation password
- these must match
*/
function passwordConfirmValidation(password, confirmPassword)
{
    if (password != confirmPassword)
        return false;
    else
        return true;
}

/*
checks the birthday
- must not be empty
*/
function birthdayValidation(birthday)
{
    if (birthday == "")
        return false;
    else
        return true;
}

/*
Checks the favourite game
- can be blank
- character limit of 60
*/
function faveGameValidation(faveGame)
{
    if (faveGame.length > 60)
        return false;
    else
        return true;
}

/*
checks the favourite game type
This is selected from a drop down menu
- cannot be blank
*/
function faveGameTypeValidation(faveGameType)
{
    if (faveGameType == "")
        return false;
    else
        return true;
}

/*
checks the game time
This is selected from a drop down menu
- cannot be blank
*/
function gameTimeValidation(gameTime)
{
    if (gameTime == "")
        return false;
    else
        return true;
}

/*
checks the user's biography
- can be blank
- character limit of 500
*/
function biographyValidation(biography)
{
    if (biography.length > 500)
        return false;
    else
        return true;
}

/*
checks the URL of the picture given
- can be blank
- up to 100 characters
- checks type
*/
function pictureValidation(filePath)
{
    if(filePath != "") {
        var allowedExtensions = (filePath.toString().toLowerCase()).search(/((.jpg)|(.jpeg)|(.gif)|(.png))$/);

        if (allowedExtensions == -1)
            return false;
        else if (filePath.length > 100) 
            return false;
        else 
            return true;
    } else {
        return true;
    }
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
    if (gameName == "")
        return false;
    else if (gameName.length > 60)
        return false;
    else
        return true;
}

/*
Company that produced the game
- can't be blank
- less than 100 characters 
*/
function TGECompanyNameValidation(companyName)
{
    if (companyName == "")
        return false;
    else if (companyName.length > 100)
        return false;
    else
        return true;
}

/*
Amount of time required to play the name
- can't be blank
- floating point
- greater than 0
*/
function TGEPlaytimeValidation(playtime)
{
    if (playtime == "")
        return false;
    else if (playtime <= 0)
        return false;
    else if (isNaN(playtime))
        return false;
    else
        return true;
}

/*
Age rating provided by the game, will be displayed as ("input+ years" i.e. Recommends 3+ years to play)
- can't be blank
- must be a number
- between 0 and 19
*/
function TGEAgeValidation(age)
{
    if (age == "")
        return false;
    if (isNaN(age))
        return false;
    if (age > 19 || age < 0)
        return false;
    else
        return true;
}

/*
(minimum/recommended) Number of players
- can't be blank
- must be a number
- between 0 and 20
*/
function TGEPlayersValidation(players)
{
    if (players == "")
        return false;
    else if (isNaN(players))
        return false;
    else if (players < 0 || players > 20)
        return false; 
    else
        return true;
}


/*
Number of expansions available for the game
- can't be blank
- Number less than 30
*/
function TGEExpansionsValidation(expansions)
{
    if (expansions == "")
        return false;
    if( isNaN(expansions))
        return false;
    if (expansions < 0 || expansions > 30)
        return false; 
    else
        return true;
}


/*
Description of the game as provided by the user
- can't be blank
- there's no limit to the number of characters the description can be
*/
function descriptionValidation(description)
{
    if(description == "")
        return false;
    else
        return true;
}

/*
Checks the uploads for the images that the user can provide
- make sure that at least one photo has been uploaded
- all uploads have to be of a valid filetype
*/
function TGEUploadValidation(filePath)
{
    if(filePath == "") 
        return false; 
    else if (!(pictureValidation(filePath)))
        return false;
    else
        return true;
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
    if (rating == "") 
        return false;
    else if (rating < 0 || rating > 10)
        return false;
    else
        return true;
}

/*
ageValidation
checks the average age of the users
- can't be blank
- greater than 0
*/
function ageValidation(age)
{
    if (age == "")
        return false;
    if (age > 100)
        return false;
    else
        return true;
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
    if (playedQuantity == "")
        return false;
    else if (playedQuantity <= 0)
        return false;
    else
        return true; 
}

/*
difficultyValidation
checks the percived difficulty of the game
- can't be blank
as long as some option is selected, should pass validation
*/
function difficultyValidation(difficulty)
{
    if (difficulty == "") 
        return false; 
    else
        return true;
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
    if (description == "")
        return false;
    else
        return true;
}