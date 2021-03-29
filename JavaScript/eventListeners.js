//Event listeners for fields for user information,
// i.e. signup and edit profile

//=======================User Info Listeners====================



//=======================Game Listeners ========================




//==============================reviewing a game listeners=========

//rating
document.getElementById("reviewRating").addEventListener("blur", ratingChecker, false);

//age
document.getElementById("reviewAge").addEventListener("blur", ageChecker, false);

//playtime
document.getElementById("reviewPlaytime").addEventListener("blur", playtimeChecker, false);

//times played
document.getElementById("reviewPlayedQuantity").addEventListener("blur", playedQuantityChecker, false);

//difficulty
document.getElementById("reviewDifficulty").addEventListener("change", difficultyChecker, false);

//description
document.getElementById("reviewTGTextArea").addEventListener("blur", reviewDescriptionChecker, false);

//submission
document.getElementById("reviewSubmitButton").addEventListener("submit", reviewSubmitChecker, false);


//===========================Reviewing a Flag=====================

//
document.getElementById("approveTGE").addEventListener("submit", submissionChecker, false);
document.getElementById("rejectTGE").addEventListener("submit", submissionChecker, false);