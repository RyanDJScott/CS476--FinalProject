//Checks the name of the game
function TGENameChecker(event)
{
    var gameName = event.currentTarget.value;

    var errorMsg = document.getElementById("submitTGENameError");

    var validInput = TGENameValidation(gameName);

    if (validInput) {
        errorMsg.innerHTML = "";
    } else if (!validInput) {
        errorMsg.innerHTML = "This is an invalid game name";
    }
}

//checks the name of the company that made the game 
function TGECompanyNameChecker(event)
{
    var companyName = event.currentTarget.value;

    var errorMsg = document.getElementById("submitTGECompanyNameError");

    var validInput = TGECompanyNameValidation(companyName);

    if (validInput) {
        errorMsg.innerHTML = "";
    } else if (!validInput) {
        errorMsg.innerHTML = "This is an invalid company name";
    }
}

//checks what the user has submitted for playtime 
function TGEPlaytimeChecker(event)
{
    var playtime = event.currentTarget.value;

    var errorMsg = document.getElementById("submitTGEPlaytimeError");

    var validInput = TGEPlaytimeValidation(playtime);
    
    if (validInput) {
        errorMsg.innerHTML = "";
    } else if (!validInput) {
        errorMsg.innerHTML = "This is an invalid playtime";
    }
}

//checks the age rating
function TGEAgeChecker(event)
{
    var age = event.currentTarget.value;

    var errorMsg = document.getElementById("submitTGEAgeError");

    var validInput = TGEAgeValidation(age);
    
    if (validInput) {
        errorMsg.innerHTML = "";
    } else if (!validInput) {
        errorMsg.innerHTML = "This is an invalid input";
    }
}

//Checks the number of players
function TGEPlayersChecker(event)
{
    var players = event.currentTarget.value;

    var errorMsg = document.getElementById("submitTGEPlayersError");

    var validInput = TGEPlayersValidation(players);
    
    if (validInput) {
        errorMsg.innerHTML = "";
    } else if (!validInput) {
        errorMsg.innerHTML = "This is an invalid input";
    }
}

//checks the number of expansions 
function TGEExpansionsChecker(event)
{
    var expansions = event.currentTarget.value;

    var errorMsg = document.getElementById("submitTGEExpansionsError");

    var validInput = TGEExpansionsValidation(expansions);
    
    if (validInput) {
        errorMsg.innerHTML = "";
    } else if (!validInput) {
        errorMsg.innerHTML = "This is an invalid input";
    }
}

//checks the description 
function descriptionChecker(event)
{
    var description = event.currentTarget.value;

    var errorMsg = document.getElementById("descriptionError");

    var validInput = descriptionValidation(description);
    
    if (validInput) {
        errorMsg.innerHTML = "";
    } else if (!validInput) {
        errorMsg.innerHTML = "This is an invalid input";
    }
}

//checks the files uploaded
function TGEUploadChecker(event)
{
    var upload = event.currentTarget.value;

    var errorMsg = document.getElementById("uploadError");

    var validInput = TGEUploadValidation(upload);
    
    if (validInput) {
        errorMsg.innerHTML = "";
    } else if (!validInput) {
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
    //Get error element
    var errorMsg = document.getElementById("submitError");

    //Get input values
    var gameName = document.getElementById("submitTGEName").value;
    var companyName = document.getElementById("submitTGECompanyName").value;
    var playtime = document.getElementById("submitTGEPlaytime").value;
    var age = document.getElementById("submitTGEAge").value;
    var players = document.getElementById("submitTGEPlayers").value;
    var expansions = document.getElementById("submitTGEExpansions").value;
    var description = document.getElementById("description").value;
    var upload = document.getElementById("submitTGEUpload").value;

    if(!(TGENameValidation(gameName) && TGECompanyNameValidation(companyName) && TGEPlaytimeValidation(playtime) && TGEAgeValidation(age)
        && TGEPlayersValidation(players) && TGEExpansionsValidation(expansions) && descriptionValidation(description) && TGEUploadValidation(upload))) {
            errorMsg.innerHTML = "Invalid input. Please fill in all fields correctly!";
            event.preventDefault();
    }
}