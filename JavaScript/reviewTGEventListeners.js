document.getElementById("reviewRating").addEventListener("blur", ratingChecker, false);
document.getElementById("reviewAge").addEventListener("blur", ageChecker, false);
document.getElementById("reviewPlaytime").addEventListener("blur", playtimeChecker, false);
document.getElementById("reviewPlayedQuantity").addEventListener("blur", playedQuantityChecker, false);
document.getElementById("reviewDifficulty").addEventListener("change", difficultyChecker, false);
document.getElementById("reviewTGTextArea").addEventListener("blur", reviewDescriptionChecker, false);
document.getElementById("submitForm").addEventListener("submit", reviewSubmitChecker, false);