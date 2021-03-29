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

    if (validInput) {
        errorMsg.innerHTML = "";
    } else if (!validInput) {
        errorMsg.innerHTML = "This input is invalid";
    }
}

//age
function ageChecker(event)
{
    var input = event.currentTarget.value;

    var errorMsg = document.getElementById("reviewAgeError");

    var validInput = ageValidation(input);

    if (validInput) {
        errorMsg.innerHTML = "";
    } else if (!validInput) {
        errorMsg.innerHTML = "This input is invalid";
    }
}

//playtime
function playtimeChecker(event)
{
    var input = event.currentTarget.value;

    var errorMsg = document.getElementById("reviewPlaytimeError");

    var validInput = playtimeValidation(input);

    if (validInput) {
        errorMsg.innerHTML = "";
    } else if (!validInput) {
        errorMsg.innerHTML = "This input is invalid";
    }
}

//times played
function playedQuantityChecker(event)
{
    var input = event.currentTarget.value;

    var errorMsg = document.getElementById("reviewPlayedQuantityError");

    var validInput = playedQuantityValidation(input);

    if (validInput) {
        errorMsg.innerHTML = "";
    } else if(!validInput) {
        errorMsg.innerHTML = "This input is invalid";
    }
}

//difficulty
function difficultyChecker(event)
{
    var input = event.currentTarget.value;

    var errorMsg = document.getElementById("reviewDifficultyError");

    var validInput = difficultyValidation(input);

    if (validInput ) {
        errorMsg.innerHTML = "";
    } else if (!validInput) {
        errorMsg.innerHTML = "This input is invalid";
    }
}

//description
function reviewDescriptionChecker(event)
{
    var input = event.currentTarget.value;

    var errorMsg = document.getElementById("reviewTextError");

    var validInput = descriptionValidation(input);

    if (validInput) {
        errorMsg.innerHTML = "";
    } else if (!validInput) {
        errorMsg.innerHTML = "This input is invalid";
    }
}

//validates all inputs before submission
//note, this is where "reviewRecommended" is validated
function reviewSubmitChecker(event)
{
    //Get error messages
    var errorMsg = document.getElementById("reviewSubmitError");
    var recError = document.getElementById("reviewRecommendedError");

    //Get input values
    var rating = document.getElementById("reviewRating").value;
    var age = document.getElementById("reviewAge").value;
    var playedQuantity = document.getElementById("reviewPlayedQuantity").value;
    var difficulty = document.getElementById("reviewDifficulty").value;
    var description = document.getElementById("reviewTGTextArea").value;

    //If any one of these fields does not validate, prevent submission
    if (!(ratingValidation(rating) && ageValidation(age) && playtimeValidation(playtime) && playedQuantityValidation(playedQuantity) 
        && difficultyValidation(difficulty) && descriptionValidation(description))) {
            errorMsg.innerHTML = "There is an error in one of the input fields. Please fill out all fields!";
            event.preventDefault();
    }

    //Check the radio buttons separately; throw radio button error if not checked
    if (!(document.getElementById("yes").checked || document.getElementById("no").checked))
    {
        recError.innerHTML = "You must select one of these two options!";
        event.preventDefault();
    }
}