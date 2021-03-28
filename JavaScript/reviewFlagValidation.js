//makes sure the description box is filled in 

function submissionChecker(event)
{
    //popup box
    if(!confirm("Are you sure?"))
    {
        event.preventDefault();
    }

    var description = document.getElementById("gameFeedback");

    var errorMsg = document.getElementById("reviewFlagDescError");
    var submitErrorMsg = document.getElementById("reviewFlagSubmitError");

    if(reviewFlagDescription(description) == false)
    {
        errorMsg.innerHTML = "Description is needed before submission";
        submitErrorMsg.innerHTML = "Please fix errors";
        event.preventDefault();
    }
    if(reviewFlagDescription(description) == true)
    {
        errorMsg.innerHTML = "";
        submitErrorMsg.innerHTML = "";
    }

}