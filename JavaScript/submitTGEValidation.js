/*
Wrapper functions for submitting a game, these call the validation
functions made previously and provide errors for the specific page
and input.
Each function follows this pattern:
1. declare a variable based on the value given from the event
    listener
2. get the location for the error message for the related input
3. get the boolean value from the specific input validation function
4. clear/add an error message based on the result of the validation
*/

//Checks the name of the game
function TGENameChecker(event)
{
    var gameName = event.currentTarget.value;

    var errorMsg = document.getElementById("submitTGENameError");

    var validInput = TGENameValidation(gameName);

    if(validInput == true)
    {
        errorMsg.innerHTML = "";
    }
    if(validInput == false)
    {
        errorMsg.innerHTML = "This is an invalid game name";
    }
}

//checks the name of the company that made the game 
function TGECompanyNameChecker(event)
{
    var companyName = event.currentTarget.value;

    var errorMsg = document.getElementById("submitTGECompanyNameError");

    var validInput = TGECompanyNameValidation(companyName);

    if(validInput == true)
    {
        errorMsg.innerHTML = "";
    }
    if(validInput == false)
    {
        errorMsg.innerHTML = "This is an invalid company name";
    }
}

//checks what the user has submitted for playtime 
function TGEPlaytimeChecker(event)
{
    var playtime = event.currentTarget.value;

    var errorMsg = document.getElementById("submitTGEPlaytimeError");

    var validInput = TGEPlaytimeValidation(playtime);
    
    if(validInput == true)
    {
        errorMsg.innerHTML = "";
    }
    if(validInput == false)
    {
        errorMsg.innerHTML = "This is an invalid playtime";
    }
}

//checks the age rating
function TGEAgeChecker(event)
{
    var age = event.currentTarget.value;

    var errorMsg = document.getElementById("submitTGEAgeError");

    var validInput = TGEAgeValidation(age);
    
    if(validInput == true)
    {
        errorMsg.innerHTML = "";
    }
    if(validInput == false)
    {
        errorMsg.innerHTML = "This is an invalid input";
    }
}

//Checks the number of players
function TGEPlayersChecker(event)
{
    var players = event.currentTarget.value;

    var errorMsg = document.getElementById("submitTGEPlayersError");

    var validInput = TGEPlayersValidation(players);
    
    if(validInput == true)
    {
        errorMsg.innerHTML = "";
    }
    if(validInput == false)
    {
        errorMsg.innerHTML = "This is an invalid input";
    }
}

//checks the number of expansions 
function TGEExpansionsChecker(event)
{
    var expansions = event.currentTarget.value;

    var errorMsg = document.getElementById("submitTGEExpansionsError");

    var validInput = TGEExpansionsValidation(expansions);
    
    if(validInput == true)
    {
        errorMsg.innerHTML = "";
    }
    if(validInput == false)
    {
        errorMsg.innerHTML = "This is an invalid input";
    }
}

//checks the description 
function descriptionChecker(event)
{
    var description = event.currentTarget.value;

    var errorMsg = document.getElementById("descriptionError");

    var validInput = descriptionValidation(description);
    
    if(validInput == true)
    {
        errorMsg.innerHTML = "";
    }
    if(validInput == false)
    {
        errorMsg.innerHTML = "This is an invalid input";
    }
}

//checks the files uploaded
function TGEUploadChecker(event)
{
    var upload = event.currentTarget.value;

    var errorMsg = document.getElementById("");

    var validInput = TGEUploadValidation(upload);
    
    if(validInput == true)
    {
        errorMsg.innerHTML = "";
    }
    if(validInput == false)
    {
        errorMsg.innerHTML = "This is picture cannot be uploaded";
    }
}

/*
Final validation before information can be submitted for PHP validation
this has to check all inputs on the page and make sure they are valid
- game name
- company name
- playtime
- age
- players
- expansions
- description
- upload
As these are checked, if any are false the submission is prevented 
and an appropriate error message is added to where it would be for 
any other validation function.
*/
function submitChecker(event)
{
    var gameName = document.getElementById("submitTGEName");
    if(TGENameValidation(gameName) == false)
    {
        var errorMsg = document.getElementById("submitTGENameError");
        errorMsg.innerHTML = "This is an invalid game name";
        event.preventDefault();
    }

    var companyName = document.getElementById("submitTGECompanyName");
    if(TGECompanyNameValidation(companyName) == false)
    {
        var errorMsg = document.getElementById("submitTGECompanyNameError");
        errorMsg.innerHTML = "This is an invalid company name";
        event.preventDefault();
    }

    var playtime = document.getElementById("submitTGEPlaytime");
    if(TGEPlaytimeValidation(playtime) == false)
    {
        var errorMsg = document.getElementById("submitTGEPlaytimeError");
        errorMsg.innerHTML = "This is an invalid playtime";
        event.preventDefault();
    }

    var age = document.getElementById("submitTGEAge");
    if(TGEAgeValidation(age) == false)
    {
        var errorMsg = document.getElementById("submitTGEAgeError");
        errorMsg.innerHTML = "This is an invalid input";
        event.preventDefault();
    }

    var players = document.getElementById("submitTGEPlayers");
    if(TGEPlayersValidation(players) == false)
    {
        var errorMsg = document.getElementById("submitTGEPlayersError");
        errorMsg.innerHTML = "This is an invalid input";
        event.preventDefault();
    }

    var expansions = document.getElementById("submitTGEExpansions");
    if(TGEExpansionsValidation(expansions) == false)
    {
        var errorMsg = document.getElementById("submitTGEExpansionsError");
        errorMsg.innerHTML = "This is an invalid input";
        event.preventDefault();
    }

    var description = document.getElementsByName("description");
    if(descriptionValidation(description) == false)
    {
        var errorMsg = document.getElementById("descriptionError");
        errorMsg.innerHTML = "This is an invalid input";
        event.preventDefault();
    }

    var upload = document.getElementById("submitTGEUpload");
    if(TGEUploadValidation(upload) == false)
    {
        var errorMsg = document.getElementById("");
        errorMsg.innerHTML = "This is an invalid input";
        event.preventDefault();
    }
}