//Event listeners for fields for user information,
// i.e. signup and edit profile

//=======================User Info Listeners====================
//first name
document.getElementById("editFName").addEventListener("blur", firstNameChecker, false);


//last name
document.getElementById("editLName").addEventListener("blur", lastNameChecker, false);


//email
document.getElementById("editEmail").addEventListener("blur", emailChecker, false);


//screenname
document.getElementById("editScreenname").addEventListener("blur", screennameChecker, false);


//password
document.getElementById("editPassword").addEventListener("blur", passwordChecker, false);


//password confirmation
document.getElementById("editPasswordConfirm").addEventListener("blur", passwordConfirmChecker, false);


//birthday
document.getElementById("editBirthday").addEventListener("change", birthdayChecker, false);


//favourite game
document.getElementById("editFavGame").addEventListener("blur", faveGameChecker, false);


//favourite game type
document.getElementById("editFavGameType").addEventListener("change", faveGameTypeChecker, false);


//time playing games
document.getElementById("editGameTime").addEventListener("change", gameTimeChecker, false);


//biography
document.getElementById("editBiography").addEventListener("blur", biographyChecker, false);


//profile picture
document.getElementById("editPic").addEventListener("change", pictureChecker, false);


//=======================Game Listeners ========================

//game name
document.getElementById("submitTGEName").addEventListener("blur", TGENameChecker, false);

//company name
document.getElementById("submitTGECompanyName").addEventListener("blur", TGECompanyNameChecker, false);

//playtime
document.getElementById("submitTGEPlaytime").addEventListener("blur", TGEPlaytimeChecker, false);

//Age rating
document.getElementById("submitTGEAge").addEventListener("blur", TGEAgeChecker, false);

//number of players
document.getElementById("submitTGEPlayers").addEventListener("blur", TGEPlayersChecker, false);

//number of expansions
document.getElementById("submitTGEExpansions").addEventListener("blur", TGEExpansionsChecker, false);

//text description
document.getElementById("description").addEventListener("blur", descriptionChecker,false);

//upload
document.getElementById("submitTGEUpload").addEventListener("change", TGEUploadChecker, false);

//submit button
document.getElementById("").addEventListener("submit", submitChecker, false);


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