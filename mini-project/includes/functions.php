<?php
function logged_out()
{
    if(!isset($_SESSION['email']) && !isset($_COOKIE['email']))
    return true;
    
    else return false;
}
?>