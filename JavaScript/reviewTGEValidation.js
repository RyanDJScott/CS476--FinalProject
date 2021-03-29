function checkReason(event)
{
    var reason = event.currentTarget.value;

    var errorMsg = document.getElementById("reviewTGEDescError");

    if (!reviewFlagDescription(reason)) {
        errorMsg.innerHTML = "You must provide a reason as to why you are accepting or rejecting this description.";
    } else {
        errorMsg.innerHTML = "";
    }
}

function approveTGE (event)
{
    //popup box
    if(!confirm("Are you sure you wish to pubish this tabletop game description to the website?"))
    {
        event.preventDefault();
    }
}

function rejectTGE (event)
{
    //popup box
    if(!confirm("Are you sure you want to reject this tabletop game description from the website?"))
    {
        event.preventDefault();
    }
}

function submitForm (event)
{
    var reason = document.getElementById("gameFeedback").value;

    if (!reviewFlagDescription(reason))
    {
        event.preventDefault();
    }
}