function promoteUser (event)
{
    //popup box
    if(!confirm("Are you sure you wish to promote this user to administrator?"))
    {
        event.preventDefault();
    }
}

function deleteUser (event)
{
    //popup box
    if(!confirm("Are you sure you want to delete this user? This action is not reversible!"))
    {
        event.preventDefault();
    }
}