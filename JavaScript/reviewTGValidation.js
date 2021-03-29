/*
functions for validating the inputs when a user is writing a review
for a tabletop game
*/


//ratingChecker
function ratingChecker(event)
{
    var input = event.currentTarget.value;

    var errorMsg = document.getElementById("reviewRatingError");

    var validInput = ratingValidation(input);

    if(validInput == true)
    {
        errorMsg.innerHTML = "";
    }
    if(validInput == false)
    {
        errorMsg.innerHTML = "This input is invalid";
    }
}

//age
function ageChecker(event)
{
    var input = event.currentTarget.value;

    var errorMsg = document.getElementById("reviewAgeError");

    var validInput = ageValidation(input);

    if(validInput == true)
    {
        errorMsg.innerHTML = "";
    }
    if(validInput == false)
    {
        errorMsg.innerHTML = "This input is invalid";
    }
}

//playtime
function playtimeChecker(event)
{
    var input = event.currentTarget.value;

    var errorMsg = document.getElementById("reviewPlaytimeError");

    var validInput = playtimeValidation(input);

    if(validInput == true)
    {
        errorMsg.innerHTML = "";
    }
    if(validInput == false)
    {
        errorMsg.innerHTML = "This input is invalid";
    }
}

//times played
function playedQuantityChecker(event)
{
    var input = event.currentTarget.value;

    var errorMsg = document.getElementById("reviewPlayedQuantityError");

    var validInput = playedQuantityValidation(input);

    if(validInput == true)
    {
        errorMsg.innerHTML = "";
    }
    if(validInput == false)
    {
        errorMsg.innerHTML = "This input is invalid";
    }
}

//difficulty
function difficultyChecker(event)
{
    var input = event.currentTarget.value;

    var errorMsg = document.getElementById("reviewDifficultyError");

    var validInput = difficultyValidation(input);

    if(validInput == true)
    {
        errorMsg.innerHTML = "";
    }
    if(validInput == false)
    {
        errorMsg.innerHTML = "This input is invalid";
    }
}

//description
function reviewDescriptionChecker(event)
{
    var input = event.currentTarget.value;

    var errorMsg = document.getElementById("reviewTextError");

    var validInput = descriptionValidation(input);

    if(validInput == true)
    {
        errorMsg.innerHTML = "";
    }
    if(validInput == false)
    {
        errorMsg.innerHTML = "This input is invalid";
    }
}

//validates all inputs before submission
//note, this is where "reviewRecommended" is validated
function reviewSubmitChecker(event)
{
    //get error message
    var errorMsg = document.getElementById("reviewSubmitError");

    var rating = document.getElementById("reviewRating").value;
    if (ratingValidation(rating) == false)
    {
        errorMsg.innerHTML = "There is an error in one of the input fields. Please fill out all fields!";
        event.preventDefault();
    }

    var recError = document.getElementById("reviewRecommendedError");
    if (!(document.getElementById("yes").checked || document.getElementById("no").checked))
    {
        recError.innerHTML = "You must select one of these two options!";
        event.preventDefault();
    }

    var age = document.getElementById("reviewAge").value;
    if (ageValidation(age) == false)
    {
        errorMsg.innerHTML = "There is an error in one of the input fields. Please fill out all fields!";
        event.preventDefault();
    }

    var playtime = document.getElementById("reviewPlaytime").value;
    if (playtimeValidation(playtime) == false)
    {
        errorMsg.innerHTML = "There is an error in one of the input fields. Please fill out all fields!";
        event.preventDefault();
    }

    var playedQuantity = document.getElementById("reviewPlayedQuantity").value;
    if (playedQuantityValidation(playedQuantity) == false)
    {
        errorMsg.innerHTML = "There is an error in one of the input fields. Please fill out all fields!";
        event.preventDefault();
    }

    var difficulty = document.getElementById("reviewDifficulty").value;
    if (difficultyValidation(difficulty) == false)
    {
        errorMsg.innerHTML = "There is an error in one of the input fields. Please fill out all fields!";
        event.preventDefault();
    }

    var description = document.getElementById("reviewTGTextArea").value;
    if (descriptionValidation(description) == false)
    {
        errorMsg.innerHTML = "There is an error in one of the input fields. Please fill out all fields!";
        event.preventDefault();
    }
}