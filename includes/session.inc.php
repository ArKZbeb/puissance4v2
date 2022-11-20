<?php
function isConnected()
{
    session_start();

    return isset($_SESSION['loggedin']) && $_SESSION['loggedin'];
}
?>