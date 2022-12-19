function checkInputs(form)
{
    if(!form.name.value)
    {
        alert("The name field is empty.");
        form.name.focus();
        return false;
    }
    if(!form.password.value)
    {
        alert("The password field is empty.");
        form.password.focus();
        return false;
    }
    if(!form.title.value)
    {
        alert("The title field is empty.");
        form.title.focus();
        return false;
    }
    if(!form.content.value)
    {
        alert("The content field is empty.");
        form.content.focus();
        return false;
    }
    return true;
}

function checkPassword(form)
{
    if(!form.password.value)
    {
        alert("The password field is empty.");
        form.password.focus();
        return false;
    }
    return true;
}
