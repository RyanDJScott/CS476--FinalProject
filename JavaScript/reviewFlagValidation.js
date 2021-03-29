//makes sure the description box is filled in 

function approveReview(event)
{
    //popup box
    if(!confirm("This review was flagged for innapropriate content. Are you sure you approve this review?"))
    {
        event.preventDefault();
    }
}

function deleteReview(event)
{
    //popup box
    if(!confirm("This review will be permanently deleted from the website. Are you sure you want to delete it?"))
    {
        event.preventDefault();
    }
}