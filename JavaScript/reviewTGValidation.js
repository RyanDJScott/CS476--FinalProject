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

    var validInput = true;

    //get inputs
    var rating = document.getElementById("reviewRating");
    var recommendedYes = document.getElementById("yes");
    var recommendedNo = document.getElementById("no");
    var age = document.getElementById("reviewAge");
    var playtime = document.getElementById("reviewPlaytime");
    var playedQuantity = document.getElementById("reviewPlayedQuantity");
    var difficulty = document.getElementById("reviewDifficulty");
    var description = document.getElementById("reviewTGTextArea");

    //test each input and prevent submission if needed
    
}