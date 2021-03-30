document.getElementById("submitTGEName").addEventListener("blur", TGENameChecker, false);
document.getElementById("submitTGECompanyName").addEventListener("blur", TGECompanyNameChecker, false);
document.getElementById("submitTGEPlaytime").addEventListener("blur", TGEPlaytimeChecker, false);
document.getElementById("submitTGEAge").addEventListener("blur", TGEAgeChecker, false);
document.getElementById("submitTGEPlayers").addEventListener("blur", TGEPlayersChecker, false);
document.getElementById("submitTGEExpansions").addEventListener("blur", TGEExpansionsChecker, false);
document.getElementById("description").addEventListener("blur", descriptionChecker,false);
document.getElementById("submitTGEUpload").addEventListener("change", TGEUploadChecker, false);
document.getElementById("submitForm").addEventListener("submit", submitChecker, false);